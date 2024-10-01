<?php

namespace Modules\Sale\DataTables\TableView;

use Illuminate\Support\Carbon;
use Modules\Sale\Entities\Sale;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class SaleDataTable extends DataTable
{

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('actions', function ($data) {
                $actions = '<div class="d-inline-block text-nowrap">';
                if (user()->isAbleTo('update-sale')) {
                    $actions .= '<a href="' . route('admin.sales.edit', $data->id) . '" class="btn btn-sm btn-icon"><i class="ti ti-edit"></i></a>';
                }
                if (user()->isAbleTo('delete-sale')) {
                    $actions .= '<button class="btn btn-sm btn-icon editor-delete"><i class="ti ti-trash"></i></button>';
                }
                $actions .= '</div>';
                return $actions;
            })
            ->setRowId('id')

            ->editColumn('product_sale_day', function ($data) {
                if ($data->product_sale_day && !empty($data->product_sale_day)) {
                    $productSaleDay = Carbon::createFromFormat('Y-m-d H:i:s', $data->product_sale_day);
                    return $productSaleDay->format('y-m-d H:i');
                }
                return '-';
            })

            ->addColumn('company', function ($data) {
                return optional($data->product->company)->name ?? 'N/A';
            })
            ->filterColumn('company', function ($query, $keyword) {
                $query->whereHas('product', function ($query) use ($keyword) {
                    $query->whereHas('company', function ($query) use ($keyword) {
                        $query->where('name', 'like', '%' . $keyword . '%');
                    });
                });
            })->orderColumn('company', function ($query, $order) {
                $query->join('products', 'products.id', '=', 'sales.product_id')
                ->join('product_companies', 'products.company_id', '=', 'product_companies.id')
                ->orderBy('product_companies.name', $order);
            })
            ->addColumn('product_name', function ($data) {
                return ($data->product) ? $data->product->product_name : 'N/A';
            })->orderColumn('product_name', function ($query, $order) {
                $query->join('products', 'products.id', '=', 'sales.product_id')
                ->orderBy('products.product_name', $order);
            })
            ->filterColumn('product_name', function ($query, $keyword) {
                $query->whereHas('product', function ($query) use ($keyword) {
                    $query->where('product_name', 'like', '%' . $keyword . '%');
                });
            })
            ->addColumn('product_code', function ($data) {
                return $data->product?->code;
            })
            ->filterColumn('product_code', function ($query, $keyword) {
                $query->whereHas('product', function ($query) use ($keyword) {
                    $query->where('code', 'like', '%' . $keyword . '%');
                });
            })->orderColumn('product_code', function ($query, $order) {
                $query->join('products', 'products.id', '=', 'sales.product_id')->orderBy('products.code', $order);
            })
            ->editColumn('fee_type', function ($data) {
                return trans('sale::sale.' . $data->fee_type);
            })
            ->editColumn('product_price', function ($data) {
                return $data->product_price ? $data->product_price : '-';
            })
            ->editColumn('remark', function ($data) {
                return $data->remark;
            })
            ->editColumn('sales_price', function ($data) {
                return $data->sales_price ? $data->sales_price : '-';
            })
            ->filterColumn('sales_price', function ($query, $keyword) {
                $query->where('sales_price', 'LIKE', "%{$keyword}%");
            })
            ->editColumn('take', function ($data) {
                return $data->fee ? $data->fee : '-';
            })
            ->editColumn('number_of_sales', function ($data) {
                return $data->number_of_sales ? $data->number_of_sales : '-';
            })
            ->editColumn('sales_information', function ($data) {
                return $data->sales_information;
            })
            //            ->editColumn('operating_income', function ($data) {
            //                return $data->operating_income;
            //            })
            ->editColumn('created_at', function ($data) {
                return $data->created_at ? date_format($data->created_at, setting('date_format_php', 'Y-m-d')) : '-';
            })
            ->editColumn('seller', function ($data) {
                $seller = $data->seller;
                $name = $seller?->first_name . ' ' . $seller?->last_name;
                $company = $seller?->company?->name ?? 'null';
                $role = $seller?->roles?->pluck('display_name')->implode(', ');
                $code = $seller?->code ?? 'null';
                return $name . '/' . $company . '/' . $role . '/' . $code;
            })
            ->filterColumn('seller', function ($query, $keyword) {
                // $query->whereHas('seller', function ($query) use ($keyword) {
                //     $query->where('first_name', 'like', '%' . $keyword . '%');
                // });
            })
            ->editColumn('fees', function ($data) {
                return "<button class='btn btn-primary button-contract' onclick=\"openBHModal('" . $data->product_id . "', '" . $data->take . "')\">" . trans('sale::sale.view') . "</button>";
            })
            ->filterColumn('fees', function ($query, $keyword) {
            })

            ->editColumn('modified_date', function ($data) {
                return $data->updated_at ? date_format($data->updated_at, setting('date_format_php', 'Y-m-d')) : '-';
            })
            ->orderColumn('modified_date', function ($query, $orderDirection) {
                $query->orderBy('updated_at', $orderDirection);
            }, 'modified_date')
            ->filterColumn('modified_date', function ($query, $keyword) {
                $query->where('sales.updated_at', 'LIKE', "%{$keyword}%");
            })
            ->editColumn('sales_entry', function ($data) {
                return $data?->seller?->first_name . ' ' . $data?->seller?->last_name . ' ' . $data?->seller?->code;
            })
            ->filterColumn('sales_entry', function ($query, $keyword) {
                $query->whereHas('seller', function ($query) use ($keyword) {
                    $query->where(function ($query) use ($keyword) {
                        $query->where('first_name', 'like', "%{$keyword}%")
                            ->orWhere('last_name', 'like', "%{$keyword}%")
                            ->orWhere('code', 'like', "%{$keyword}%");
                    });
                });
            })
            ->addColumn('product_sales_status', function ($data) {
                $product = $data->product?->sale_status;
                if ($product == 'normal') {
                    $get_status = '<button class="btn-label-info custom-btn">' . trans('product::product.normal') . '</button>';
                } else if ($product == 'pause') {
                    $get_status = '<button class="btn-label-warning custom-btn">' . trans('product::product.pause') . '</button>';
                } else if ($product == 'stop-selling') {
                    $get_status = '<button class="btn-label-danger custom-btn">' . trans('product::product.sales-discontinued') . '</button>';
                } else if ($product == 'onetime-sell') {
                    $get_status = '<button class="btn-label-success custom-btn">' . trans('product::product.one-time-registration') . '</button>';
                }
                return $get_status;
            })
            ->filterColumn('product_sales_status', function ($query, $keyword) {
                $query->whereHas('product', function ($query) use ($keyword) {
                    $query->where('sale_status', 'LIKE', "%{$keyword}%");
                });
            })

            ->editColumn('sales_status', function ($data) {
                if ($data->sales_status == 'confirmed') {
                    $get_status = "<button type='button' class='btn-label-info custom-btn' >" . trans('sale::sale.' . $data->sales_status) . "</button>";
                } else if ($data->sales_status == 'proceeding') {
                    $get_status = "<button type='button' class='btn-label-success custom-btn' >" . trans('sale::sale.' . $data->sales_status) . "</button>";
                } else if ($data->sales_status == 'cancellation') {
                    $get_status = "<button type='button' class='btn-label-warning custom-btn' >" . trans('sale::sale.' . $data->sales_status) . "</button>";
                } else if ($data->sales_status == 'refund') {
                    $get_status = "<button type='button' class='btn-label-danger custom-btn' >" . trans('sale::sale.' . $data->sales_status) . "</button>";
                }
                return $get_status;
            })
            ->filterColumn('sales_status', function ($query, $keyword) {
                $query->where('sales_status', 'LIKE', "%{$keyword}%");
            })

            ->addColumn('sales_code', function ($data) {
                return $data->code ? $data->code : 'N/A';
            })->orderColumn('sales_code', function ($query, $order) {
                $query->orderBy('code', $order);
            })
            ->rawColumns(['actions', 'product_sale_day', 'company', 'product_name', 'fees', 'product_code', 'product_sales_status', 'sales_status', 'seller', 'sales_price']);
    }


    /**
     * Get query source of dataTable.
     *
     * @param \Modules\Sale\Entities\Sale $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Sale $model)
    {
        return $model->newQuery()->with('company', 'seller');

        /*auth()->user()->hasRole('developer') ?
            $model->newQuery()->with('contacts') :
            $model->newQuery()->with('contacts')->WhereDoesntHave('roles', function ($q) {
                $q->where('name', '=', 'developer');
            });*/
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     * @throws \Exception
     */
    public function html()
    {
        // dd(Company::all()->sortBy('name')->pluck('id', 'name')->toArray());
        return $this->builder()
            ->setTableId('sale-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row px-4'<'col-sm-12 col-md-4 d-flex justify-content-start'f><'col-sm-12 col-md-8 d-flex align-items-center justify-content-end'lB>>" .
            "<'row'<'col-sm-12'tr>>" .
            "<'row'<'col-sm-12 col-md-12 d-flex align-item-center justify-content-center'p>>")
            ->language(["search" => "", "lengthMenu" => "_MENU_", "searchPlaceholder" => trans('core::table.search')])
            ->orderBy(2, 'ASC')
            ->scrollX('true')
            ->pageLength(10)
            ->parameters([
                'buttons' => [
                    user()->isAbleTo('export-sale-information') ? [
                        'extend'    => 'collection',
                        "className" => 'btn btn-secondary dropdown-toggle waves-effect waves-light',
                        "text"      => '<i class="ti ti-download me-1"></i> <span class="only-pc">' . trans('sale::sale.export').'</span>',
                        "buttons"   => [
                            [
                                [
                                    'extend'        => 'print',
                                    'text'          => '<i class="ti ti-printer me-2"></i>' . trans('sale::sale.print'),
                                    'className'     => 'dropdown-item',
                                    'exportOptions' => ['columns' => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 12, 13, 14, 15]],
                                ],
                                [
                                    'extend'    => 'excel',
                                    'text'      => '<i class="ti ti-file-text me-2"></i>' . trans('sale::sale.excel'),
                                    'className' => 'dropdown-item',
                                ],
                            ]
                        ]
                    ] : []
                ]
            ])
            ->buttons(
                Button::make('create')->attr(['id' => 'createButton', 'onclick' => 'window.location.href="' . route('admin.sales.create') . '"'])
                    ->className('btn btn-primary')->text('<i class="ti ti-plus"></i> <span class="only-pc">' . trans('sale::sale.new').'</span>')
            );
    }



    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('sales_code')->style('min-width:100px;')->title(trans('sale::sale.sale-code')),
            Column::make('product_sale_day')->style('min-width:150px;')->title(trans('sale::sale.product-sale-day')),
            Column::make('company')->style('min-width:150px;')->title(trans('sale::sale.company')),
            Column::make('product_name')->style('min-width:200px;')->title(trans('sale::sale.product-name')),
            Column::make('product_code')->style('min-width:160px;')->title(trans('sale::sale.product-code')),
            Column::make('fee_type')->style('min-width:120px;')->title(trans('sale::sale.fee-type')),
            Column::make('product_price')->style('min-width:160px;')->title(trans('sale::sale.product-price')),
            Column::make('remark')->style('min-width:350px;')->title(trans('sale::sale.remark')),
            Column::make('seller')->style('min-width:350px;')->title(trans('sale::sale.seller'))->orderable(false),
            Column::make('sales_price')->style('min-width:160px;')->title(trans('sale::sale.sales-amount')),
            Column::make('number_of_sales')->style('min-width:100px;')->title(trans('sale::sale.number-of-sales')),
            Column::make('sales_information')->style('min-width:150px;')->title(trans('sale::sale.sales-information')),
            Column::make('fees')->style('min-width:100px;')->title(trans('sale::sale.fees'))->orderable(false),
            //Column::make('operating_income')->style('min-width:160px;')->title(trans('sale::sale.operating-income')),
            Column::make('product_sales_status')->style('min-width:110px;')->title(trans('product::product.sales-status')),
            Column::make('sales_status')->style('min-width:110px;')->title(trans('sale::sale.sales-situation')),
            Column::make('sales_entry')->style('min-width:110px;')->title(trans('sale::sale.sales-entery'))->orderable(false),
            Column::make('modified_date')->style('min-width:150px;')->title(trans('sale::sale.modified-date')),
            Column::make('actions')->title(trans('sale::sale.action'))->visible(user()->isAbleTo('update-sale|delete-sale'))->searchable(false)->orderable(false),

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Sale_' . date('YmdHis');
    }
}

<?php

namespace Modules\Product\DataTables\TableView;

use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Modules\Product\Entities\Product;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Html\Editor\Fields\Text;

class ProductDataTable extends DataTable
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
            ->setRowId('id')
            ->addColumn('order', function ($data) {
                static $i = 1;
                return $i++;
            })
            ->addColumn('product_price', function ($data) {
                return $data->product_price ? $data->product_price : '-';
            })->orderColumn('product_price', function ($query, $order) {
                $query->orderBy('product_price', $order);
            })
            ->addColumn('product_description', function ($data) {
                return $data->product_description ?: '-';
            })->orderColumn('product_description', function ($query, $order) {
                $query->orderBy('product_description', $order);
            })
            ->addColumn('fee_form', function ($data) {
                return trans('product::commission-type.' . $data->commission_type);
            })->orderColumn('fee_form', function ($query, $order) {
                $query->orderBy('commission_type', $order);
            })
            ->addColumn('main_url', function ($data) {
                return $data->main_url ?: '-';
            })
            ->addColumn('sale_rights', function ($data) {
                if ($data->sale_rights_disclosure === "full") {
                    return '<span class="badge p-0 text-dark my-1">' . trans('product::sale-rights.full-disclosure') . '</span><br>';
                } else {
                    $companies = $data->saleRights;
                    $html = '';
                    foreach ($companies as $company) {
                        $html .= '<span class="badge p-0 text-dark my-1">' . $company->name . '</span><br>';
                    }
                    return $html ?: 'N/A';
                }
            })
            ->addColumn('approval_rights', function ($data) {
                if ($data->approval_rights_disclosure === "full") {
                    return '<span class="badge p-0 text-dark my-1">' . trans('product::sale-rights.full-disclosure') . '</span><br>';
                } else {
                    $users = $data->approvalRights;
                    $html = '';
                    foreach ($users as $user) {
                        $html .= '<span class="badge p-0 text-dark my-1">' . $user->first_name . ' ' . $user->last_name . '</span><br>';
                    }
                    return $html ?: 'N/A';
                }
            })

            ->addColumn('sale_status', function ($data) {
                if ($data->sale_status == 'normal') {
                    $get_status = '<button class="button1">' . trans('product::product.normal') . '</button>';
                } else if ($data->sale_status == 'pause') {
                    $get_status = '<button class="button2">' . trans('product::product.pause') . '</button>';
                } else if ($data->sale_status == 'stop-selling') {
                    $get_status = '<button class="button3">' . trans('product::product.sales-discontinued') . '</button>';
                } else if ($data->sale_status == 'onetime-sell') {
                    $get_status = '<button class="button4">' . trans('product::product.one-time-registration') . '</button>';
                }
                return $get_status;
            })
            ->addColumn('contact_notification', function ($data) {
                return $data->contact_notifications ? "On" : "Off";
            })
            ->addColumn('actions', function ($data) {
                $actions = '<div class="d-inline-block text-nowrap">';
                if (user()->isAbleTo('update-product')) {
                    $actions .= '<button class="btn btn-sm btn-icon" onclick="window.location.href =\'' . route('admin.products.edit', $data->id) . '\'"><i class="ti ti-edit"></i></button>';
                }
                if (user()->isAbleTo('delete-product')) {
                    $actions .= '<button class="btn btn-sm btn-icon editor-delete" data-url="' . $data->id . '"><i class="ti ti-trash"></i></button>';
                }
                $actions .= '</div>';
                return $actions;
            })
            ->addColumn('charge', function ($data) {
                return '<button class="btn btn-primary charge_btn" onclick="getCommissionChargeDetails(' . $data->id . ')">' . trans('product::product.look') . '</button>';
            })
            //            ->addColumn('bh_operating_profit', function ($data) {
            //                return $data->bh_operating_profit ? $data->bh_operating_profit : '-';
            //            })
            ->addColumn('manager', function ($data) {
                return '<button class="btn btn-primary manager_btn" onclick="getManagerDetails(' . $data->id . ')">' . trans('product::product.look') . '</button>';
            })
            ->addColumn('link', function ($data) {
                $validator = Validator::make(['url' => $data->main_url], [
                    'url' => 'url',
                ]);

                $url = null;
                if ($validator->passes()) {
                    $url = parse_url($data->main_url)['host'];
                } else {
                    $url = $data->main_url;
                }

                return  '<a href=' . $data->main_url . ' target="_blank"  class="btn" style="text-color:#111; !important;" data-toggle="tooltip" data-placement="top" title="' . $data->main_url . '">' . $url . '</a>';
            })
            ->addColumn('banner', function ($data) {
                return '<button class="btn btn-primary banner_btn" data-url=' . $data->banner() . '>'  . trans('product::product.look') . '</button>';
            })
            ->addColumn('first_registration_date_and_time', function ($data) {
                return $data->created_at ? date_format($data->created_at, setting('date_format_php', 'Y-m-d')) : '-';
            })
            ->addColumn('last_modified_date', function ($data) {
                return $data->updated_at ? date_format($data->updated_at, setting('date_format_php', 'Y-m-d')) : '-';
            })
            ->rawColumns([
                'order', 'product_price', 'product_description',
                'commission_type', 'main_url', 'sale_rights', 'approval_rights',
                'sale_status', 'contact_notifications', 'actions', 'fee_form', 'charge',
                // 'bh_operating_profit',
                'manager', 'link', 'banner', 'first_registration_date_and_time', 'last_modified_date'
            ]);
    }


    /**
     * Get query source of dataTable.
     *
     * @param \Modules\Company\Entities\Company $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Product $model)
    {
        if (user()->isAdmin() || user()->isProAdmin()) {
            return $model->newQuery()->with(['company']);
        } else {
            if (user()->productRights()->exists()) {
                $userRightProd = user()->company->productRights()->pluck('id')->toArray();
                return $model->newQuery()->with(['company'])->whereIn('id', $userRightProd);
            } else {
                return $model->newQuery()->whereNull('id');
            }
        }
    }



    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     * @throws \Exception
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('product-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row px-4'<'col-sm-12 col-md-4 d-flex justify-content-start'f><'col-sm-12 col-md-8 d-flex align-items-center justify-content-end'lB>>" .
            "<'row'<'col-sm-12'tr>>" .
            "<'row'<'col-sm-12 col-md-12 d-flex align-item-center justify-content-center'p>>")
            ->language(["search" => "", "lengthMenu" => "_MENU_", "searchPlaceholder" => trans('core::table.search')])
            ->orderBy(0, 'ASC')
            ->scrollX('true')
            ->pageLength(10)
            ->columnDefs([
                'className' => 'dt-center',
                'targets'   => 'all'
            ])
            ->parameters([
                'buttons' => [
                    user()->isAbleTo('export-product-information') ? [
                        'extend'    => 'collection',
                        "className" => 'btn btn-secondary dropdown-toggle waves-effect waves-light',
                        "text"      => '<i class="ti ti-download me-1"></i> <span class="only-pc">' . trans('product::product.export').'</span>',
                        "buttons"   => [
                            [
                                [
                                    'extend'        => 'print',
                                    'text'          => '<i class="ti ti-printer me-2"></i>' . trans('product::product.print'),
                                    'className'     => 'dropdown-item',
                                    'exportOptions' => ['columns' => [0, 1, 2, 3, 4, 5, 6, 7, 8, 11, 12, 13, 15, 16]],
                                ],
                                [
                                    'extend'    => 'excel',
                                    'text'      => '<i class="ti ti-file-text me-2"></i>' . trans('product::product.excel'),
                                    'className' => 'dropdown-item',
                                ],
                            ]
                        ]
                    ] : []
                ]
            ])
            ->buttons(
                Button::make()
                    ->className('btn btn-primary')->text('<i class="ti ti-plus"></i> <span class="only-pc">' . trans('company::table.new').'</span>')
                    ->authorized(user()->isAbleTo('create-company'))
                    ->action('function(e, dt, node, config) { let url = \'' . route('admin.products.create') . '\'; window.location.href = url; }'),
            )->editor(
                Editor::make()
                    ->fields([
                        Text::make('order')->label(trans('product::product.order')),
                        Text::make('code')->label(trans('product::product.product-code')),
                        Text::make('product_name')->label(trans('product::product.product-name')),
                        Text::make('productcompany')->label(trans('product::product.productcompany')),
                        Text::make('sale_rights')->label(trans('product::product.sales-authority')),
                        Text::make('approval_rights')->label(trans('product::product.approval-authority')),
                        Text::make('fee_form')->label(trans('product::product.fee-form')),
                        Text::make('product_price')->label(trans('product::product.product-price')),
                        Text::make('product_description')->label(trans('product::product.product-description')),
                        Text::make('charge')->label(trans('product::product.charge')),
                        //Text::make('bh_operating_profit')->label(trans('product::product.bh-operating-profit')),
                        Text::make('manager')->label(trans('product::product.manager')),
                        Text::make('contact_notification')->label(trans('product::product.contact-notification')),
                        Text::make('sale_status')->label(trans('product::product.sales-status')),
                        Text::make('link')->label(trans('product::product.link')),
                        Text::make('banner')->label(trans('product::product.banner')),
                        Text::make('bh_sale_commissions')->label(trans('product::product.bh_sale_commissions')),
                        Text::make('first_registration_date_and_time')->label(trans('product::product.first-registration-date-and-time')),
                        Text::make('last_modified_date')->label(trans('product::product.last-modified-date'))
                            ->default(1),
                    ])->onUploadXhrSuccess('function(e, json, data) {
                        setTimeout(() => {
                            if (document.querySelector(".clearValue .btn-outline-secondary").textContent !=="") {
                                document.querySelector(".clearValue").style.display = "";
                            }
                        }, 300)
                    }')
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
            Column::make('order')->title(trans('product::product.order'))->orderable(false),
            Column::make('code')->title(trans('product::product.product-code')),
            Column::make('product_name')->title(trans('product::product.product-name')),
            Column::make('company.name')->title(trans('product::product.productcompany'))->data('company.name')->orderable(false),
            Column::make('sale_rights')->title(trans('product::product.sale-rights'))->visible(user()->isAdmin() || user()->hasRole('HO'))->orderable(false),
            Column::make('approval_rights')->title(trans('product::product.approval-rights'))->orderable(false)->visible(user()->isAdmin() || user()->hasRole('HO')),
            Column::make('fee_form')->title(trans('product::product.fee-form')),
            Column::make('product_price')->title(trans('product::product.product-price')),
            Column::make('product_description')->title(trans('product::product.product-description')),
            Column::make('charge')->title(trans('product::product.charge'))->orderable(false),
            //Column::make('bh_operating_profit')->title(trans('product::product.bh-operating-profit'))->orderable(false),
            Column::make('manager')->title(trans('product::product.manager'))->orderable(false),
            Column::make('contact_notification')->title(trans('product::product.contact-notification'))->orderable(false)->visible(user()->isAdmin()),
            Column::make('sale_status')->title(trans('product::product.sales-status'))->orderable(false),
            Column::make('link')->title(trans('product::product.link'))->orderable(false),
            Column::make('banner')->title(trans('product::product.banner'))->orderable(false),
            Column::make('first_registration_date_and_time')->title(trans('product::product.first-registration-date-and-time'))->orderable(false),
            Column::make('last_modified_date')->title(trans('product::product.last-modified-date'))->orderable(false),
            Column::make('actions')->title(trans('core::general.edit-delete'))->orderable(false)->visible(user()->isAbleTo('update-product|delete-product')),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Company_' . date('YmdHis');
    }
}

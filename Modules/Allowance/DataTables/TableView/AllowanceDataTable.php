<?php

namespace Modules\Allowance\DataTables\TableView;

use Modules\Allowance\Entities\Allowance;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class AllowanceDataTable extends DataTable
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
                return '<div class="d-inline-block text-nowrap">
                <a href="' . route('admin.allowances.edit', $data->id) . '" class="btn btn-sm btn-icon"><i class="ti ti-edit"></i></a>
                 <button class="btn btn-sm btn-icon allowance_delete" data-url="' . $data->id . '"><i class="ti ti-trash"></i></button>
                </div>';
            })
            ->setRowId('id')
            ->addColumn('member_name', function ($data) {
                return $data?->member?->first_name . ' ' . $data?->member?->last_name;
            })->filterColumn('member_name', function ($query, $keyword) {
                $query->whereHas('member', function ($query) use ($keyword) {
                    $query->where('first_name', 'like', '%' . $keyword . '%');
                });
            })
            ->editColumn('payment_month', function($data){
                return trans('core::month.'.strtolower($data->payment_month));
            })
            ->editColumn('total_before_tax', function($data){
                return $data->total_before_tax ? $data->total_before_tax : '-';
            })
            ->editColumn('income_tax', function($data){
                return $data->income_tax ? $data->income_tax : '-';
            })
            ->editColumn('resident_tax', function($data){
                return $data->resident_tax ? $data->resident_tax : '-';
            })
            ->editColumn('year_end_settlement', function($data){
                return $data->year_end_settlement ? $data->year_end_settlement : '-';
            })
            ->editColumn('other_deductions_1', function($data){
                return $data->other_deductions_1 ? $data->other_deductions_1 : '-';
            })
            ->editColumn('other_deductions_2', function($data){
                return $data->other_deductions_2 ? $data->other_deductions_2 : '-';
            })
            ->editColumn('total_deduction', function($data){
                return $data->total_deduction ? $data->total_deduction : '-';
            })
            ->editColumn('deducted_amount_received', function($data){
                return $data->deducted_amount_received ? $data->deducted_amount_received : '-';
            })
            ->addColumn('job_title', function ($data) {
                if (isset($data->member_id)) {
                    return (isset($data->member->roles) && $data->member->roles->isNotEmpty()) ? $data->member->roles->first()->name : 'N/A';
                } else {
                    return 'N/A';
                }
            })->filterColumn('job_title', function ($query, $keyword) {
                $query->whereHas('member', function ($query) use ($keyword) {
                    $query->whereHas('roles', function ($query) use ($keyword) {
                        $query->where('name', 'like', '%' . $keyword . '%');
                    });
                });
            })
            ->addColumn('member_code', function ($data) {
                return isset($data->member) ? $data->member->code : "N/A";
            })->filterColumn('member_code', function ($query, $keyword) {
                $query->whereHas('member', function ($query) use ($keyword) {
                    $query->where('code', 'like', '%' . $keyword . '%');
                });
            })
            ->addColumn('allowance', function ($data) {
                return '<button class="btn btn-primary allowance_look_btn"
                        data-headquarters_representative="' . $data->headquarters_representative_allowance . '"
                        data-organizational_division="' . $data->organization_division_allowance . '"
                        data-policy="' . $data->policy_allowance . '"
                        data-other="' . $data->other_allowances . '">' . trans('allowance::allowance.look') . '</button>';
            })
            ->editColumn('created_at', function ($data) {
               return $data->created_at ? date_format($data->created_at, setting('date_format_php', 'Y-m-d')) : '-';
            })

            ->editColumn('updated_at', function ($data) {
                $modified_date =  $data->updated_at ? date_format($data->updated_at, setting('date_format_php', 'Y-m-d')) : '-';
                return $modified_date;
            })
            ->addColumn('commission', function ($data) {
                return $data->commission ? $data->commission : '-';
            })
            ->addColumn('referral_bonus', function ($data) {
                return $data->referral_bonus ? $data->referral_bonus : '-';
            })
            ->rawColumns(['actions', 'allowance']);
    }


    /**
     * Get query source of dataTable.
     *
     * @param \Modules\Allowance\Entities\Allowance $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Allowance $model)
    {
        return $model->newQuery()->latest()->with('member');

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
        return $this->builder()
            ->setTableId('allowance-table')
            ->columns($this->getColumns())
            ->ajax([
                'url' => route('admin.users.index'),
                'data' => 'function(d) {
                    d.date_range = $("#date_range").val();
                }',
            ])
            ->ajax([
                'url' => route('admin.users.index'),
                'data' => 'function(d) {
                    d.date_range = $("#date_range").val();
                }',
            ])
            ->minifiedAjax()
            ->dom("<'row px-4'<'col-sm-12 col-md-4 d-flex justify-content-start'f><'col-sm-12 col-md-8 d-flex align-items-center justify-content-end'lB>>" .
            "<'row'<'col-sm-12'tr>>" .
            "<'row'<'col-sm-12 col-md-12 d-flex align-item-center justify-content-center'p>>")
            ->language(["search" => "", "lengthMenu" => "_MENU_", "searchPlaceholder" => trans('core::table.search')])
            ->orderBy(2, 'ASC')
            ->scrollX(true)
            ->columnDefs([
                'className' => 'dt-center',
                'targets'   => 'all'
            ])
            ->pageLength(10)

            ->parameters([
                'buttons' => [
                   user()->isAbleTo('export-allowance') ? [
                        'extend'    => 'collection',
                        "className" => 'btn btn-secondary dropdown-toggle waves-effect waves-light my-0',
                        "text"      => '<i class="ti ti-download me-1"></i> <span class="only-pc">' . trans('core::general.export').'</span>',
                        "buttons"   => [
                            [
                                [
                                    'extend'        => 'print',
                                    'text'          => '<i class="ti ti-printer me-2"></i>' . trans('core::general.print'),
                                    'className'     => 'dropdown-item',
                                    'exportOptions' => ['columns' => [0, 1, 2, 3, 4, 5]],
                                ],
                                [
                                    'extend'    => 'excel',
                                    'text'      => '<i class="ti ti-file-text me-2"></i>' . trans('core::general.excel'),
                                    'className' => 'dropdown-item',
                                ],
                            ]
                        ]
                    ] : [],
                ]
                            ])
            ->buttons(
                Button::make()->authorized(user()->isAbleTo('import-allowance'))->attr(['id' => 'import'])
                    ->className('btn btn-primary')->text('<i></i> ' . trans('allowance::allowance.import')),

                Button::make('create')->authorized(user()->isAbleTo('create-allowance'))
                    ->attr(['id' => 'createButton', 'onclick' => 'window.location.href="' . route('admin.allowances.create') . '"'])
                    ->className('btn btn-primary')->text('<i class="ti ti-plus"></i> <span class="only-pc">' . trans('allowance::allowance.new').'</span>')
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
            Column::make('id')->style('min-width:70px;')->title(trans('allowance::allowance.order'))->searchable(false),
            Column::make('member_code')->style('min-width:70px;')->title(trans('allowance::allowance.member-code')),
            Column::make('member_name')->style('min-width:70px;')->title(trans('allowance::allowance.member-name')),
            Column::make('job_title')->style('min-width:70px;')->title(trans('allowance::allowance.position')),
            Column::make('payment_month')->style('min-width:80px;')->title(trans('allowance::allowance.payment-month'))->searchable(false),
            Column::make('commission')->style('min-width:80px;')->title(trans('allowance::allowance.commission'))->searchable(false),
            Column::make('referral_bonus')->style('min-width:80px;')->title(trans('allowance::allowance.referral-bonus'))->searchable(false),
            column::make('allowance')->style('min-width:80px;')->title(trans('allowance::allowance.allowance-data'))->searchable(false),
            Column::make('total_before_tax')->style('min-width:80px;')->title(trans('allowance::allowance.total-before-tax'))->searchable(false),
            Column::make('income_tax')->style('min-width:80px;')->title(trans('allowance::allowance.income-tax'))->searchable(false),
            Column::make('resident_tax')->style('min-width:80px;')->title(trans('allowance::allowance.resident-tax'))->searchable(false),
            Column::make('year_end_settlement')->style('min-width:80px;')->title(trans('allowance::allowance.year-end-settlement'))->searchable(false),
            Column::make('other_deductions_1')->style('min-width:80px;')->title(trans('allowance::allowance.other-deductions-one'))->searchable(false),
            Column::make('other_deductions_2')->style('min-width:80px;')->title(trans('allowance::allowance.other-deductions-two'))->searchable(false),
            Column::make('total_deduction')->style('min-width:80px;')->title(trans('allowance::allowance.total-deduction'))->searchable(false),
            Column::make('deducted_amount_received')->style('min-width:80px;')->title(trans('allowance::allowance.deducted-amount-received'))->searchable(false),
            Column::make('created_at')->style('min-width:80px;')->title(trans('allowance::allowance.first-registration-date'))->searchable(false),
            Column::make('updated_at')->style('min-width:80px;')->title(trans('allowance::allowance.last-modified-date'))->searchable(false),
            Column::make('actions')->title(trans('allowance::allowance.action'))->style('min-width:70px;')->searchable(false),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Allowance_' . date('YmdHis');
    }
}

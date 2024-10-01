<?php

namespace Modules\User\DataTables\TableView;

use Modules\User\Entities\User;
use Yajra\DataTables\Html\Column;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\Services\DataTable;

class ReferralDataTable extends DataTable
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
            ->collection($query)
            ->addColumn('actions', function ($data) {
                if ($data->isLeaf()) {
                    return '';
                }
                $url = route('admin.referrals.view', $data->id);
                return '<div class="d-inline-block text-nowrap">
                    <button class="btn btn-primary" onclick="window.location.href=\'' . $url . '\'">'.
                        trans('user::referral.view-genealogy-tree')
                    .'</button>
                </div>';
            })
            ->setRowId('id')
            ->editColumn('name', function ($data) {
                return $data->full_name;
            })
            ->editColumn('step', function ($data) {
                return $data->isChildOf(Auth::user()) ? '다이렉트' : '인다이렉트 ' . $data->depth-1;
            })
            ->editColumn('position', function ($data) {
                return $data->roles->isNotEmpty() ? $data->roles->first()->name : 'N/A';
            })
            ->editColumn('children', function ($data) {
                return $data->descendants()->count();
            })
            ->editColumn('belong', function ($data) {
                return $data->company->name ?? '';
            })
            ->rawColumns(['actions']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param User $model
     * @return Builder
     */
    public function query(User $model)
    {
        if (user()->isAdmin()) {
            return $model::withDepth()->hasChildren()->get();
        }
        return $model::withDepth()->descendantsOf(Auth::user()->id);
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
            ->setTableId('referral-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row px-4'<'col-sm-12 col-md-4 d-flex justify-content-start'f><'col-sm-12 col-md-8 d-flex align-items-center justify-content-end'lB>>" .
            "<'row'<'col-sm-12'tr>>" .
            "<'row'<'col-sm-12 col-md-12 d-flex align-item-center justify-content-center'p>>")
            ->language(["search"=> "","lengthMenu"=>"_MENU_","searchPlaceholder"=> trans('core::table.search')])
            ->orderBy(2, 'ASC')
            ->scrollX('true')
            ->pageLength(10)
            ->columnDefs([
                'className' => 'dt-center',
                'targets' => 'all'
            ])
            ->parameters([
                'buttons' => [
                    user()->isAbleTo('export-referral-information') ? [
                        'extend'    => 'collection',
                        "className" => 'btn btn-secondary dropdown-toggle waves-effect waves-light',
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
                    ] : []
                ]
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            // 이름, Name
            Column::make('name')
                ->style('min-width:64px;')
                ->title(trans('user::user.name'))
                ->orderable(false)
                ->defaultContent('N/A'),
            // 직책, Position
            Column::make('position')
                ->style('min-width:89px;')
                ->title(trans('user::user.division'))
                ->data('position')
                ->orderable(false)
                ->defaultContent('N/A'),
            // 코드, Code
            Column::make('code')
                ->style('min-width:68px;')
                ->title(trans('user::user.code'))
                ->data('code')
                ->defaultContent('N/A'),
            // 단계, Step
            Column::make('step')
                ->style('min-width:82px;')
                ->title(trans('user::referral.step'))
                ->data('step')
                ->orderable(false),
            // 소속, Belong
            Column::make('belong')
                ->style('min-width:95px;')
                ->title(trans('user::referral.belong'))
                ->data('belong')
                ->orderable(false)
                ->defaultContent('N/A'),
            // 추천인수, No. of Recommendations
            Column::make('children')
                ->style('min-width:76px;')
                ->title(trans('user::referral.recommendations-count'))
                ->data('children')
                ->orderable(false)
                ->defaultContent('N/A'),
            // 계보도, Genealogy
            Column::make('actions')
                ->style('min-width:127px;')
                ->title(trans('user::referral.genealogy'))
                ->exportable(false)
                ->printable(false)
                ->orderable(false)
                ->visible(user()->isAbleTo('view-referral-detail')),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Referral_' . date('YmdHis');
    }
}

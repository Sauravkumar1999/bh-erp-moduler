<?php

namespace Modules\ActivityLog\DataTables\TableView;

use Carbon\Carbon;
use Modules\ActivityLog\Entities\ActivityLog;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ActivityLogDataTable extends DataTable
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
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                return '<button class="btn btn-primary activity-view-btn" data-toggle="modal" data-target="#logModal'.$data->id.'">View</button>';
            })
            ->editColumn('created_at', function ($data) {
                return $data->formattedDate;
            })
            ->editColumn('subject.first_name', function ($data) {
                return $data->subject ? $data->subject->first_name . ' ' . $data->subject->last_name : 'N/A';
            })
            ->editColumn('causer.first_name', function ($data) {
                return $data->causer ? $data->causer->first_name . ' ' . $data->causer->last_name : 'N/A';
            })
            ->rawColumns(['action']);
    }


    /**
     * Get query source of dataTable.
     *
     * @param \Modules\ActivityLog\Entities\ActivityLog $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ActivityLog $model)
    {
        return $model->newQuery()->with(['subject', 'causer']);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('activity-log-table')
            ->columns($this->getColumns())
            ->dom("<'row px-4'<'col-sm-12 col-md-4 d-flex justify-content-start'f><'col-sm-12 col-md-8 d-flex align-items-center justify-content-end'l>>")
            ->language(["search" => "", "lengthMenu" => "_MENU_", "searchPlaceholder" => trans('core::table.search')])
            ->orderBy(2, 'ASC')
            ->scrollX('true')
            ->minifiedAjax()
            ->pageLength(10)
            ->buttons(
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
            Column::make('DT_RowIndex')->title('No')->orderable(false)->searchable(false),  // This is the new serial number column
            Column::make('subject.first_name')->title('Subject Name'),
            Column::make('causer.first_name')->title('Causer Name'),
            Column::make('created_at')->title('Date'),
            Column::make('action')->title('Logs')->exportable(false)->printable(false),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'ActivityLog_' . date('YmdHis');
    }
}
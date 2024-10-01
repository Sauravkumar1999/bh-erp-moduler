<?php

namespace Modules\PushNotification\DataTables\TableView;

use Carbon\Carbon;
use Modules\PushNotification\Entities\PushNotification;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields\Select;
use Yajra\DataTables\Html\Editor\Fields\Select2;
use Yajra\DataTables\Html\Editor\Fields\Checkbox;
use Yajra\DataTables\Html\Editor\Fields\Radio;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields\Text;
use Yajra\DataTables\Html\Editor\Fields\TextArea;

class PushNotificationDataTable extends DataTable
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
            ->addColumn('receivers', function ($data) {
                return '<button class="btn btn-primary button-contract" onclick="showReceivers('.$data->id.')">Show Receivers</button>';
            })
            ->editColumn('created_at', function ($data) {
                $datetime = Carbon::parse($data->created_at);
                return $datetime->format(setting('date_format_php'));
            })
            ->setRowId('id')
            ->rawColumns(['receivers']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \Modules\PushNotification\Entities\PushNotification $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(PushNotification $model)
    {
        return $model->newQuery();
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
            ->setTableId('push-notification-table')
            ->columns($this->getColumns())
            ->dom("<'row px-4'<'col-sm-12 col-md-4 d-flex justify-content-start'f><'col-sm-12 col-md-8 d-flex align-items-center justify-content-end'lB>>" .
            "<'row'<'col-sm-12'tr>>" .
            "<'row'<'col-sm-12 col-md-12 d-flex align-item-center justify-content-center'p>>")
            ->language(["search" => "", "lengthMenu" => "_MENU_", "searchPlaceholder" => trans('core::table.search')])
            ->orderBy(2, 'ASC')
            ->scrollX('true')
            ->pageLength(10)
            ->buttons(
                Button::make('create')->className('btn btn-primary')
                    ->text('<i class="ti ti-plus"></i> <span class="only-pc">' . trans('core::table.new').'</span>')->editor('editor'),
            )->editor(
                Editor::make()->fields([
                    Text::make('title')->label(trans('pushnotification::pushnotification.title'))->attr(['id' => 'form', 'placeholder' => trans('pushnotification::pushnotification.title')]),
                    TextArea::make('contents')->label(trans('pushnotification::pushnotification.contents'))->attr(['id' => 'detail', 'placeholder' => trans('pushnotification::pushnotification.contents')]),
                    Radio::make('receiver_type')
                    ->label(trans('pushnotification::pushnotification.receiver'))
                    ->attr(['id' => 'receiverType', 'class' => 'receiverType'])
                    ->options([
                        [
                            'label' => trans('pushnotification::pushnotification.role-receiver'),
                            'value' => 1
                        ],
                        [
                            'label' => trans('pushnotification::pushnotification.user-receiver'),
                            'value' => 2
                        ],
                    ])
                    ->default(1),
                    Select2::make('receivers')->label(trans('pushnotification::pushnotification.receiver'))->attr(['multiple' => 'multiple', 'class' => 'receiverSelect2'])->options($this->getAllRoleDropDown())->id('receiverSelect2'),
                ])->onOpen("function(e, mode, action) {
                    if(action === 'create') {

                       $('.datemask').inputmask('datetime', {
                           inputFormat: '" . setting('date_format_js') . "',
                           min: '1900-01-01',
                           max: '2999-01-01'
                       });
                    }
               }")
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
            Column::make('id')->visible(false),
            Column::make('title')->title(trans('pushnotification::pushnotification.title')),
            Column::make('contents')->title(trans('pushnotification::pushnotification.contents')),
            Column::make('receivers')->title(trans('pushnotification::pushnotification.receiver')),
            Column::make('created_at')->title(trans('pushnotification::pushnotification.send-date')),
        ];
    }

    protected function getAllRoleDropDown()
    {
       return collect(userRole())->mapWithKeys(function ($role) {
          return [$role['display_name'] => $role['id']];
       })->toArray();
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'PushNotification_' . date('YmdHis');
    }
}

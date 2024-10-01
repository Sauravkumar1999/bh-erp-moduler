<?php

namespace Modules\Core\DataTables\TableView;

use Modules\Core\Entities\Setting;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields\Select;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields\Text;

class SettingsDataTable extends DataTable
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
            ->addColumn('action', function ($data) {
                return '<div class="d-inline-block text-nowrap">
                <button class="btn btn-sm btn-icon editor-edit" title="edit"><i class="ti ti-edit"></i></button>
                <button class="btn btn-sm btn-icon editor-delete" title="delete"><i class="ti ti-trash"></i></button>
            </div>';
            })
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \Modules\Core\Entities\Setting $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Setting $model)
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
            ->setTableId('settings-table')
            ->columns($this->getColumns())
            ->dom("<'row px-4'<'col-sm-12 col-md-4 d-flex justify-content-start'f><'col-sm-12 col-md-8 d-flex align-items-center justify-content-end'lB>>" .
            "<'row'<'col-sm-12'tr>>" .
            "<'row'<'col-sm-12 col-md-12 d-flex align-item-center justify-content-center'p>>")
            ->language(["search" => "", "lengthMenu" => "_MENU_", "searchPlaceholder" => trans('core::table.search')])
            ->orderBy(1)
            ->responsive()
            ->pageLength(10)
            ->addAction(['width' => '100px'])
            ->buttons(
                Button::make('create')->className('btn btn-primary')
                    ->text('<i class="ti ti-plus"></i> <span class="only-pc">' . trans('core::table.new').'</span>')->editor('editor'),
//                Button::make('')->text('<i class="ti ti-refresh"></i> '.trans('core::core.refresh'))
//                    ->className('btn btn-info')
//                    ->action('function(e, dt, node, config){ dt.draw(false); }')
            )->editor(
                Editor::make()->fields([
                    Text::make('key'),
                    Text::make('value'),
                    Select::make('is_doc')->label('Tbl Doc management')
                        ->options([
                            trans('core::core.no')  => 0,
                            trans('core::core.yes') => 1,
                        ])->default(0)
                ])
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
            Column::make('key'),
            Column::make('value')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Settings_' . date('YmdHis');
    }
}

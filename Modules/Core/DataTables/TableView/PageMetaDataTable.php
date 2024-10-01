<?php

namespace Modules\Core\DataTables\TableView;

use Modules\Core\Entities\PageMeta;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields\Text;
use Yajra\DataTables\Html\Editor\Fields\Radio;
use Yajra\DataTables\Html\Editor\Fields\File;

class PageMetaDataTable extends DataTable
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
                <button class="btn btn-sm btn-icon editor-edit" data-id="' . $data->id . '" title="edit"><i class="ti ti-edit"></i></button>
                <button class="btn btn-sm btn-icon editor-delete" data-id="' . $data->id . '" title="delete"><i class="ti ti-trash"></i></button>
            </div>';
            })
            ->addColumn('status', function ($data) {
                if ($data->status) {
                    return '<span class="badge bg-label-success">' . trans('core::page-meta.status-active') . '</span>';
                } else {
                    return '<span class="badge bg-label-danger">' . trans('core::page-meta.status-inactive') . '</span>';
                }
            })
            ->setRowId('id')->rawColumns(['status', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \Modules\Core\Entities\Setting $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(PageMeta $model)
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
            ->setTableId('page-meta-table')
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
                Button::make()
                    ->className('btn btn-primary')->text('<i class="ti ti-plus"></i> <span class="only-pc">' . trans('core::table.new').'</span>')
                    ->action('function(e, dt, node, config) { let url = \'' . route('admin.page-meta-tags.create') . '\'; window.location.href = url; }'),
//                Button::make('')->text('<i class="ti ti-refresh"></i>')
//                    ->className('btn btn-info')
//                    ->action('function(e, dt, node, config){ dt.draw(false); }')
            )->editor(
                Editor::make()->fields([
                    Text::make('page_url'),
                    Radio::make('status')->label(trans('core::page-meta.status'))
                        ->options([
                            [
                                'label' => trans('core::page-meta.status-active'),
                                'value' => 'active'
                            ],
                            [
                                'label' => trans('core::page-meta.status-inactive'),
                                'value' => 'inactive'
                            ],
                        ])
                        ->default('active'),
                    File::make('og_image')->label(trans('core::page-meta.og-image'))
                        ->display("function (file_id) {
                        if(!file_id.includes('img')) {
                            let fileURL = '" . route('media.file.display', ':file') . "';
                            fileURL = fileURL.replace(':file', file_id);
                            return fileURL ? '<img src=\"'+fileURL+'\" />' : null ;
                        } else {
                            return file_id;
                        }
                    }"),
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
            Column::make('page_url')->title(trans('core::page-meta.page-url')),
            Column::make('status')->title(trans('core::page-meta.status')),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'PageMeta_' . date('YmdHis');
    }
}

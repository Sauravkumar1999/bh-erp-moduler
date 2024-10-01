<?php

namespace Modules\Translation\Datatables\TableView;

use Carbon\Carbon;
use Modules\Translation\Entities\TranslationLanguage;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields\Text;
use Yajra\DataTables\Services\DataTable;

class TranslationLanguageDataTable extends DataTable
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
            ->addColumn('created_at', function ($data) {
                return Carbon::parse($data->created_at)->format(setting('date_format_php', 'Y-m-d'));
            })
            ->addColumn('actions', function ($data) {
                return '<div class="d-inline-block text-nowrap">
                    <button class="btn btn-sm btn-icon editor-edit"><i class="ti ti-edit"></i></button>
                    <button class="btn btn-sm btn-icon editor-delete"><i class="ti ti-trash"></i></button>
                    <a class="btn btn-sm btn-icon" href="'.route('admin.translations.index', ['lang' => $data->slug]).'"><i class="ti ti-language"></i></a>
                </div>';
            })
            ->rawColumns(['created_at','actions']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \Modules\Translation\Entities\TranslationLanguage
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(TranslationLanguage $model)
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
            ->setTableId('translation-languages-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row px-4'<'col-sm-12 col-md-4 d-flex justify-content-start'f><'col-sm-12 col-md-8 d-flex align-items-center justify-content-end'lB>>" .
            "<'row'<'col-sm-12'tr>>" .
            "<'row'<'col-sm-12 col-md-12 d-flex align-item-center justify-content-center'p>>")
            ->language(["search" => "", "lengthMenu" => "_MENU_", "searchPlaceholder" => trans('core::table.search')])
            ->orderBy(1, 'ASC')
            ->scrollX('true')
            ->pageLength(10)
            ->columnDefs([
                'className' => 'dt-center',
                'targets'   => 'all'
            ])
            ->buttons(
                Button::make('create')
                ->className('btn btn-primary')
                ->text('<i class="fas fa-plus"></i>  <span class="only-pc">'.trans('translation::table.new').'</span>')
                ->editor('editor'),
            )->editor(
                Editor::make()->fields([
                    Text::make('lang_name')->label('Language'),
                    Text::make('slug')->id('slug'),
                ])->onOpen('function(){ $("#slug").attr("onkeyup", "this.value=this.value.replace(/[^a-z]/g,\'\');"); }')
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
            Column::make('lang_name')->title(trans('translation::language.language')),
            Column::make('slug')->title(trans('translation::language.slug')),
            Column::make('created_at')->title(trans('translation::language.created-at')),
            Column::make('actions')->title(trans('translation::language.action')),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'TranslationLanguage_' . date('YmdHis');
    }
}

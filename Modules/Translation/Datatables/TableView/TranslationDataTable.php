<?php

namespace Modules\Translation\Datatables\TableView;

use Modules\Core\Contracts\ModuleUtilityContract;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields\Hidden;
use Yajra\DataTables\Html\Editor\Fields\Select;
use Yajra\DataTables\Html\Editor\Fields\Text;
use Yajra\DataTables\Html\Editor\Fields\TextArea;
use Yajra\DataTables\Services\DataTable;
use Modules\Translation\Entities\Translation;

class TranslationDataTable extends DataTable
{

    private $muc;

    /**
     * PermissionDataTable constructor.
     * @param ModuleUtilityContract $muc
     */
    public function __construct(ModuleUtilityContract $muc)
    {
        $this->muc = $muc;
    }


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
            ->editColumn('namespace', function ($data) {
                return ucfirst($data->namespace);
            })
            ->editColumn('key', function ($data) {
                $cur_lang = $this->currentLang();
                return $cur_lang === default_language() ? $data->key : $data->text[default_language()];
            })
            ->editColumn('text', function ($data) {
                return isset($data->text[$this->currentLang()]) ? $data->text[$this->currentLang()] : '';
            })
            ->addColumn('actions', function ($data) {

                $delete = $this->currentLang() === default_language() ? '<button class="btn btn-sm btn-icon editor-delete"><i class="ti ti-trash"></i></button>' : '';

                return '<div class="d-inline-block text-nowrap">
                    <button class="btn btn-sm btn-icon editor-edit"><i class="ti ti-edit" data-url="' . $data->id . '" data-status="' . $data->status . '"></i></button>
                    '.$delete.'
                </div>';
            })
            ->rawColumns(['actions']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \Modules\Translation\Entities\Translation
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Translation $model)
    {
        return $model->newQuery()->orderBy('namespace');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     * @throws \Exception
     */
    public function html()
    {
        $cur_lang = $this->currentLang();

        $fields = [
            Select::make('namespace')->options($this->muc->modulesDropdown())->label(trans('translation::table.module'))->id('namespace-select'),
            Text::make('group')->label(trans('translation::table.group'))->id('group'),
            Text::make('key')->label($cur_lang == default_language() ? trans('translation::table.key') : default_language(true)->lang_name)->id('key'),
            TextArea::make('text')->label($cur_lang == default_language() ? default_language(true)->lang_name : trans('translation::language.'.$cur_lang)),
            Hidden::make('lang')->default($this->currentLang()),
        ];

        $buttons = [
            Button::make('create')->editor('editor')->className('btn btn-primary')
                ->text('<i class="fas fa-plus"></i>  <span class="only-pc">' . trans('translation::table.new').'</span>'),
        ];

        if ($cur_lang != default_language()) {
            array_splice($fields, 0, 1);
            array_splice($buttons, 0, 1);
        }

        $readOnly = $cur_lang != default_language();

        return $this->builder()
            ->setTableId('translations-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row px-4'<'col-sm-12 col-md-4 d-flex justify-content-start'f><'col-sm-12 col-md-8 d-flex align-items-center justify-content-end'l" . (!empty($buttons) ? 'B' : '') . ">>" .
                "<'row'<'col-sm-12'tr>>" .
                "<'row'<'col-sm-12 col-md-12 d-flex align-item-center justify-content-center'p>>")
            ->language(["search" => "", "lengthMenu" => "_MENU_", "searchPlaceholder" => trans('core::table.search')])
            ->rowGroup(['dataSrc' => 'namespace'])
            ->scrollX('true')
            ->pageLength(10)
            ->buttons(...$buttons)
            ->editor(
                Editor::make()
                    ->fields($fields)
                    ->onOpen('function(){ $("#group").attr("onkeyup", "this.value=this.value.replace(/[^a-z -]/g,\'\');");
                     if("' . !$readOnly . '") { $("#key").attr("onkeyup", "this.value=this.value.replace(/[^a-z -]/g,\'\');"); } $("#key").attr("readonly", ' . $readOnly . '); }')
                    ->onInitEdit('function(e, node, data) { e.currentTarget.on("open", function() { $("#namespace-select").val(data.namespace.toLowerCase()); }); }')
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
            Column::make('namespace')->title(trans('translation::table.module')),
            Column::make('group')->title(trans('translation::table.group')),
            Column::make('key')->title($this->currentLang() == default_language() ? trans('translation::table.key') : default_language(true)->lang_name),
            Column::make('text')->title($this->currentLang() == default_language() ? default_language(true)->lang_name : $this->currentLang()),
            Column::make('actions')->title(trans('translation::table.action')),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Translation_' . date('YmdHis');
    }

    /**
     * Get currently editing language from url
     *
     * @return string
     */
    private function currentLang()
    {
        return request()->segment(3, 'en');
    }
}

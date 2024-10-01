<?php

namespace Modules\Faq\DataTables\TableView;

use Modules\Faq\Entities\Faq;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields\Text;
use Yajra\DataTables\Html\Editor\Fields\TextArea;
use Yajra\DataTables\Html\Editor\Fields\Radio;

class FaqDataTable extends DataTable
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
            ->addColumn('status_html', function ($data) {
                $label = $data->status ? 'success' : 'warning';
                $text = $data->status ? trans('core::faq.enable') : trans('core::faq.disable');
                return '<span class="badge  bg-label-' . $label . '" data-status="' . $data->status . '">' . $text . '</span>';
            })
            ->addColumn('actions', function ($data) {
                return sanitize_output(view('faq::templates._faq-actions', ['data' => $data])->render());
            })
            ->addColumn('description', function ($data) {
                return $data->description;
            })
            ->rawColumns(['status_html', 'description', 'actions']);
    }


    /**
     * Get query source of dataTable.
     *
     * @param \Modules\Faq\Entities\Faq $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Faq $model)
    {
        return $model->newQuery()->orderBy('id');
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
            ->setTableId('faq-table')
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
            ->buttons(
                Button::make('create')->authorized(user()->isAbleTo('create-faq'))
                    ->className('btn btn-primary')
                    ->text('<i class="ti ti-plus"></i> ' . trans('faq::table.new'))
                    ->editor('editor'),
            )->editor(
                Editor::make('editor')
                    ->fields([
                        Text::make('title')
                            ->label(trans('faq::faq.title'))
                            ->attr(['placeholder' => trans('faq::faq.title')]),
                        TextArea::make('description')
                            ->label(trans('faq::faq.description'))
                            ->attr(['id' => 'quill-editor', 'placeholder' => trans('faq::faq.description')]),
                        Radio::make('status')
                            ->label(trans('core::general.status'))
                            ->options([
                                [
                                    'label' => trans('core::faq.enable'),
                                    'value' => 1
                                ],
                                [
                                    'label' => trans('core::general.disable'),
                                    'value' => 0
                                ],
                            ])
                            ->default(1)
                    ])->onOpen("function() {
                        $(document).ready(function () {
                            $('#quill-editor').nextAll().remove();
                            var el = $('#quill-editor'), id = 'quilleditor', val = el.val(), editor_height = 100;
                            console.log(el);
                            var div = $('<div/>').attr('id', id).css('height', editor_height + 'px').html(val);
                            el.addClass('d-none');
                            el.parent().append(div);

                            var quill = new Quill('#' + id, {
                                modules: {
                                    formula: true,
                                    toolbar: true
                                    },
                                theme: 'snow'
                            });
                            quill.on('text-change', function() {
                                var quillContent = quill.root.innerHTML;
                                $('#quill-editor').val(quillContent);
                            });
                        });
                    }")->onInitEdit(
                        "function(){
                            $(document).ready(function () {
                                $('#quill-editor').nextAll().remove(); // remove quill editor box when the user exit so that it won't be duplicated

                                var el = $('#quill-editor'), id = 'quilleditor', val = editor.field('description').get(), editor_height = 100;
                                console.log(el);
                                var div = $('<div/>').attr('id', id).css('height', editor_height + 'px').html(val);
                                el.addClass('d-none');
                                el.parent().append(div);

                                var quill = new Quill('#' + id, {
                                    modules: {
                                        formula: true,
                                        toolbar: true
                                        },
                                    theme: 'snow'
                                });
                                quill.on('text-change', function() {
                                    editor.field('description').set(quill.getText());
                                });
                            });
                        }"
                    )
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
            Column::make('id')->title(trans('core::general.id')),
            Column::make('title')
                ->title(trans('faq::faq.title')),
            Column::make('description')->title(trans('faq::faq.description')),
            Column::make('status_html')
                ->title(trans('core::general.status'))
                ->orderable(false)
                ->searchable(false),
            Column::make('actions')->visible(user()->isAbleTo('update-faq|delete-faq'))
                ->style('min-width:90px;')
                ->title(trans('core::general.edit-delete'))
                ->orderable(false)
                ->searchable(false),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Faq_' . date('YmdHis');
    }
}

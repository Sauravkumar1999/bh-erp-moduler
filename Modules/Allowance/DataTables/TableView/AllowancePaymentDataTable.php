<?php

namespace Modules\Allowance\DataTables\TableView;

use Illuminate\Support\HtmlString;
use Modules\Allowance\Entities\AllowancePayment;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields\File;
use Yajra\DataTables\Html\Editor\Fields\Text;
use Yajra\DataTables\Html\Editor\Fields\TextArea;
use Illuminate\Support\Str;

class AllowancePaymentDataTable extends DataTable
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
                    <button class="btn btn-sm btn-icon editor-edit"><i class="ti ti-edit"></i></button>
                    <button class="btn btn-sm btn-icon editor-delete"><i class="ti ti-trash"></i></button>
                </div>';
            })
            ->setRowId('id')
            ->addColumn('order', function ($data) {
                static $i = 1;
                return $i++;
            })
            ->addColumn('attachment', function ($data) {
                if (Str::contains($data->attachment(), url('media/image'))) {
                    return $data->attachment();
                }
            })
            ->addColumn('writer', function ($data) {
                return $data->writer ? $data->writer->first_name : 'N/A';
            })
            ->filterColumn('writer', function ($query, $keyword) {
                $query->whereHas('writer', function($q) use ($keyword) {
                    $q->where('first_name', 'LIKE', "%{$keyword}%");
                });
            })
            ->orderColumn('writer', function ($query, $orderDirection) {
                $query->join('users', 'users.id', '=', 'allowance_payments.user_id')
                      ->orderBy('users.first_name', $orderDirection);
            })
            ->editColumn('created_at', function ($data) {
                $registration = $data->created_at ? date_format($data->created_at, setting('date_format_php', 'Y-m-d')) : '-';
                return $registration ?: '-';
            })->filterColumn('created_at', function ($query, $keyword) {
                $query->where('allowance_payments.created_at', 'LIKE', "%{$keyword}%");
            })->orderColumn('created_at', function ($query, $orderDirection) {
                $query->orderBy('allowance_payments.created_at', $orderDirection);
            })
            ->addColumn('updated_at', function ($data) {
                $lastModification = $data->updated_at ? date_format($data->updated_at, setting('date_format_php', 'Y-m-d')) : '-';
                return $lastModification ?: '-';
            })->filterColumn('updated_at', function ($query, $keyword) {
                $query->where('allowance_payments.updated_at', 'LIKE', "%{$keyword}%");
            })
            ->addColumn('detail_page', function ($data) {
                return new HtmlString('<a href="' . route('admin.allowance-payments.show', $data->id) . '" class="text-black">' . $data->title . '</a>');
            })->filterColumn('detail_page', function ($query, $keyword) {
                $query->where('title', 'LIKE', "%{$keyword}%");
            })->orderColumn('detail_page', function ($query, $orderDirection) {
                $query->orderBy('title', $orderDirection);
            })
            ->rawColumns(['actions', 'detail_page', 'attachment']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \Modules\Allowance\Entities\AllowancePayment $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(AllowancePayment $model)
    {
        return $model->newQuery();
            // ->join('users', 'users.id', '=', 'allowance_payments.user_id')
            // ->leftJoin('mediables', function ($join) {
            //     $join->on('mediables.mediable_id', '=', 'allowance_payments.id')
            //         ->where('mediables.mediable_type', '=', 'Modules\Allowance\Entities\AllowancePayment');
            // })
            // ->leftJoin('media', 'media.id', '=', 'mediables.media_id');
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
            ->setTableId('allowance-payments-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row px-4'<'col-sm-12 col-md-4 d-flex justify-content-start'f><'col-sm-12 col-md-8 d-flex align-items-center justify-content-end'lB>>" .
                "<'row'<'col-sm-12'tr>>" .
                "<'row'<'col-sm-12 col-md-12 d-flex align-item-center justify-content-center'p>>")
            ->language([
                'lengthMenu' => '_MENU_',
                'info'       => 'Showing _START_ to _END_ of _TOTAL_ records',
                'search'     => ''
            ])
            ->parameters(['order' => [4, 'desc']])
            ->scrollX('true')
            ->pageLength(10)
            ->columnDefs([
                'className' => 'dt-center',
                'targets'   => 'all'
            ])
            ->buttons(
                Button::make('create')
                    ->authorized(user()->isAbleTo('create-allowance-payment'))
                    ->attr(['id' => 'createButton'])
                    ->className('btn btn-primary')
                    ->text('<i class="ti ti-plus"></i> <span class="only-pc">' . trans('allowance::allowance.new') . '</span>')
                    ->editor('editor')
            )
            ->editor(
                Editor::make()->fields([
                    Text::make('title')->label(trans('allowance::allowance.title')),
                    TextArea::make('detail')
                        ->attr(['id' => 'quill-editor', 'placeholder' => trans('allowance::allowance.detail')])
                        ->label(trans('allowance::allowance.detail')),
                    File::make('attachment')->label(trans('allowance::allowance.attachment'))
                        ->display("function (file_id) {
                            console.log(file_id);
                            var urlPattern = /^(?:\w+:)?\/\/([^\s\.]+\.\S{2}|localhost[\:?\d]*)\S*$/;
                            if (urlPattern.test(file_id)) {
                                return '<img src=\"' + file_id + '\" />';
                            }
                            if (file_id.toLowerCase().endsWith('.pdf')) {
                                let fileURL = '" . route('media.file.display', ':file') . "';
                                fileURL = fileURL.replace(':file', file_id);
                                return '<a href=\"' + fileURL + '\" target=\"_blank\">View PDF</a>';
                            } else {
                                let fileURL = '" . route('media.file.display', ':file') . "';
                                fileURL = fileURL.replace(':file', file_id);
                                return fileURL ? '<img src=\"' + fileURL + '\" />' : null;
                            }
                        }"),
                ])->onOpen("function(e, node, action) {
                    if (action === 'create') {
                        editor.title('" . trans('allowance::allowance.create-new') . "');
                        editor.buttons([
                              {
                                 text: '" . trans('core::modal.cancellation') . "',
                                 action: function() {
                                     editor.close();
                                 }
                              },
                              {
                                 text: '" . trans('allowance::allowance.new') . "',
                                 action: function() {
                                     editor.submit();
                                 }
                              }
                        ]);
                    }
                    $(document).ready(function () {
                        $('#quill-editor').nextAll().remove();
                        var el = $('#quill-editor'), id = 'quilleditor', val = el.val(), editor_height = 100;
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
                            $('#quill-editor').nextAll().remove(); // remove quill editor box when the user exits so that it won't be duplicated
                            var el = $('#quill-editor'), id = 'quilleditor', val = editor.field('detail').get(), editor_height = 100;
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
                                editor.field('detail').set(quill.getText());
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
            Column::make('order')->style('min-width:62px;')->title(trans('allowance::allowance.order')),
            Column::make('detail_page')->style('min-width:113px;')->title(trans('allowance::allowance.title')),
            Column::make('writer')->style('min-width:63px;')->title(trans('allowance::allowance.writer')),
            Column::make('created_at')->style('min-width:89px;')->title(trans('allowance::allowance.first-registration-date')),
            Column::make('updated_at')->style('min-width:89px;')->title(trans('allowance::allowance.last-modified-date')),
            Column::make('actions')->visible(user()->isAbleTo('delete-allowance-payment|update-allowance-payment'))
                ->style('min-width:90px;')->title(trans('allowance::allowance.action'))->title(trans('allowance::allowance.action')),
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

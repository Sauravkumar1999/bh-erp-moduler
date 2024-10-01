<?php

namespace Modules\Bulletin\DataTables\TableView;


use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\Bulletin\Entities\Bulletin;
use Modules\User\Entities\Role;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields\Checkbox;
use Yajra\DataTables\Html\Editor\Fields\File;
use Yajra\DataTables\Html\Editor\Fields\Radio;
use Yajra\DataTables\Html\Editor\Fields\Text;
use Yajra\DataTables\Html\Editor\Fields\TextArea;
use Illuminate\Support\Str;

class BulletinDataTable extends DataTable
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
                return sanitize_output(view('bulletin::bulletin.templates._bulletin-actions', ['data' => $data])->render());
            })
            ->editColumn('distinguish', function ($data) {
                if ($data->distinguish === 'important') {
                    return '<span class="important-label">' . trans('bulletin::msg.' . $data->distinguish) . '</span>' . '<input type="hidden" class="status-input" value="' . $data->distinguish . '">';
                }
                return trans('bulletin::msg.' . $data->distinguish) . '<input type="hidden" class="status-input" value="' . $data->distinguish . '">';
            })
            ->setRowId('id')
            ->editColumn('created_at', function ($data) {
                return Carbon::parse($data->created_at)->format(setting('date_format_php', 'Y-m-d'));
            })->orderColumn('created_at', function ($query, $order) {
                $query->orderBy('created_at', $order);
            })
            ->editColumn('title', function ($data) {
                return '<a href="' . url('admin/manage-bulletin/show/' . $data->id) . '" class="text-black">' . $data->title . '</a>';
            })->orderColumn('title', function ($query, $order) {
                $query->orderBy('title', $order);
            })
            ->editColumn('permission', function ($data) {
                if (user()->isAdmin()) {
                    $roleIds = json_decode($data->permission);
                    $roles = DB::table('roles')->whereIn('id', $roleIds)->pluck('display_name')->toArray();
                    $roleNames = implode(', ', $roles);
                    return $roleNames . "<input type='hidden' class='permissions' value='$data->permission'>";
                }
                return '';
            })
            // column for contract image preview for edit and create
            ->addColumn('attachment', function ($data){
                if (Str::contains($data->bulletin(), url('media/image'))) {
                    return '<img style="width:80px;" src="' . $data->bulletin() . '"/>';
                }
            })
            ->addColumn('views', function () {
                return '0';
            })
            ->editColumn('content', function ($data) {
                return strip_tags($data->content);
            })
            ->editColumn('views', function ($data) {
                return $data->view_count;
            })
            ->rawColumns(['actions', 'checkbox', 'title', 'distinguish', 'permission']);
    }


    /**
     * Get query source of dataTable.
     *
     * @param \Modules\User\Entities\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Bulletin $model)
    {
        if (user()->isAdmin()) {
            return $model->orderByRaw("FIELD(distinguish, 'important') DESC");
        }
        $authRoleId = user()->roles->pluck('id')->toArray();
        $authRoleId = array_map('strval', $authRoleId);

        return $model->whereJsonContains('permission', $authRoleId)
            ->orderByRaw("FIELD(distinguish, 'important') DESC")->newQuery();

    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     * @throws \Exception
     */
    public function html()
    {
        $roles = Role::all();

        $checkboxOptions = $roles->map(function ($role) {
            return [
                'label' => $role->display_name,
                'value' => $role->id,
            ];
        })->toArray();

        return $this->builder()
            ->setTableId('bulletin-table')
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
            ->parameters(['order' => [ user()->isAdmin() ? 4 : 3,'desc']])
            ->scrollX('true')
            ->pageLength(10)
            ->columnDefs([
                'className' => 'dt-center',
                'targets'   => 'all'
            ])
            ->buttons(
                Button::make('create')
                    ->authorized(user()->isAbleTo('create-bulletin'))
                    ->attr(['id' => 'createButton'])
                    ->className('btn btn-primary')
                    ->text('<i class="ti ti-plus"></i> <span class="only-pc">' . trans('bulletin::msg.create').'</span>')
                    ->editor('editor')
            )
            ->editor(
                Editor::make()->fields([
                    Text::make('title')->label(trans('bulletin::msg.title'))->attr(['value' => '']),
                    Radio::make('distinguish')->label(trans('bulletin::msg.distinguish'))
                        ->options([
                            [
                                'label' => trans('bulletin::msg.general'),
                                'value' => 'general'
                            ],
                            [
                                'label' => trans('bulletin::msg.important'),
                                'value' => 'important'
                            ],
                        ])
                        ->default('general'),
                    File::make('attachment')->label(trans('bulletin::msg.attachment'))
                        ->display("function (file_id) {
                        if(!file_id.includes('img')) {
                            let fileURL = '" . route('media.file.display', ':file') . "';
                            fileURL = fileURL.replace(':file', file_id);
                            return fileURL ? '<img src=\"'+fileURL+'\" />' : null ;
                        } else {
                            return file_id;
                        }
                    }"),
                    Checkbox::make('permission')->label(trans('bulletin::msg.permission'))
                        ->options($checkboxOptions),
                    TextArea::make('content')
                        ->attr(['id' => 'quill-editor', 'placeholder' => trans('bulletin::msg.content')])
                        ->label(trans('user::roles.description'))
                ])->onOpen("function(e, node, action) {
                $('.DTE_Field_Name_permission .DTE_Field_InputControl div:first').addClass('row');
                $('.modal').addClass('modal-sm');
                if(action === 'create') {
                    editor.title('" . trans('bulletin::msg.create') . "');
                    editor.buttons([
                          {
                             text: '" . trans('core::modal.cancellation') . "',
                             action: function() {
                                 editor.close();
                             }
                          },
                          {
                             text: '" . trans('core::modal.save') . "',
                             action: function() {
                                 editor.submit();
                             }
                          }
                    ]);

                }
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
            )
            ->scrollX(false);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        $columns = [
            Column::make('distinguish')->title(trans('bulletin::msg.distinguish'))->orderable(false),
            Column::make('title')->title(trans('bulletin::msg.title')),
            user()->isAdmin() ? Column::make('permission')->title(trans('bulletin::msg.permission'))->orderable(false) : null,
            Column::make('views')->title(trans('bulletin::msg.views'))->orderable(false),
            Column::make('created_at')->title(trans('bulletin::msg.registration-date')),
            user()->isAdmin() ? Column::make('actions')->title(trans('bulletin::msg.action'))->orderable(false) : null,
        ];
        $columns = array_filter($columns);
        return $columns;
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Bulletin_' . date('YmdHis');
    }
}

<?php

namespace Modules\User\DataTables\TableView;

use Carbon\Carbon;
use Modules\Core\View\Components\Form\CheckBox;
use Modules\User\Entities\Role;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields\Text;
use Yajra\DataTables\Html\Editor\Fields\TextArea;
use Yajra\DataTables\Html\Editor\Fields\Field;

class RoleDataTable extends DataTable
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
            ->addColumn('user_count', function ($data) {
                return $data->users()->count() . '명';
            })
            ->addColumn('actions', function ($data) {
                return '<div class="d-inline-block text-nowrap">
                <button class="btn btn-sm btn-icon editor-edit"><i class="ti ti-edit"></i></button>
                <button onclick="window.livewire.emit(\'openModal\', \'' . $data->id . '\'); loading();"
                class="btn btn-sm btn-icon editor-permission"><i class="fa-solid fa-user-secret"></i></button>
                <button class="btn btn-sm btn-icon editor-delete"><i class="ti ti-trash"></i></button>
                </div>';
            })
            // ->editColumn('action', function ($data){
            //     return '<div class="d-inline-block text-nowrap">
            //     <a class="btn btn-sm btn-icon" title="edit" href="'.route('admin.roles.edit', $data->id).'"><i class="ti ti-edit"></i></a>
            //     <button class="btn btn-sm btn-icon editor-delete" title="delete"><i class="ti ti-trash"></i></button>
            // </div>';
            // })
            ->setRowId('id')
            ->editColumn('created_at', function ($data) {
                return Carbon::parse($data->created_at)->format(setting('date_format_php', 'Y-m-d'));
            })->rawColumns(['actions']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \Modules\User\Entities\Role $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Role $model)
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
            ->setTableId('role-table')
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
                'targets'   => 'all',
            ])
            ->buttons(
                Button::make('create')->editor('editor')->className('btn btn-primary')
                    ->text('<i class="ti ti-plus"></i> <span class="only-pc">' . trans('user::role.new').'</span>')
                    ->authorized(user()->isAbleTo('create-user-role')),
            )
            ->editor(
                Editor::make()->fields([
                    Text::make('name')->label(trans('user::role.name'))->attr(['placeholder' => trans('user::role.name-placeholder')]),
                    Text::make('display_name')->label(trans('user::role.display-name'))->attr(['placeholder' => trans('user::role.display-name-placeholder')]),
                    Text::make('order')->label(trans('user::role.order'))->attr(['placeholder' => trans('user::role.order-placeholder')]),
                    Text::make('list_1')->label('<span class="marker">번호가 낮을수록 앞에 나옴</span>'),
                    Text::make('list_2')->label('<span class="marker">음수입력 가능</span>'),
                    TextArea::make('description')
                        ->attr(['id' => 'quill-editor', 'placeholder' => trans('user::role.description-placeholder')])
                        ->label(trans('user::role.description'))
                ])->onOpen("function(e, mode, action) {
                        $('#quill-editor').nextAll().remove(); // remove quill editor box when the user exit so that it won't be duplicated

                        var el = $('#quill-editor'), id = 'quilleditor', val = el.val(), editor_height = 100;
                        var div = $('<div/>').attr('id', id).css('height', editor_height + 'px').html(val);
                        el.addClass('d-none');
                        el.parent().append(div);

                        var quill = new Quill('#' + id, {
                            modules: {
                                formula: true,
                                toolbar: false
                                },
                            theme: 'snow'
                        });
                        quill.on('text-change', function() {
                            editor.field('description').set(quill.getText());
                        });

                        if(action === 'create') {
                          editor.title('".trans('user::role.new')."');
                          editor.field('order').set(".$this->getNextOrder().");
                          editor.buttons([
                              {
                                 text: '".trans('user::role.cancellation')."',
                                 action: function() {
                                     editor.close();
                                 }
                              },
                              {
                                 text: '".trans('user::role.save')."',
                                 action: function() {
                                     editor.submit();
                                 }
                              }
                          ]);

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
            Column::make('order')->title(trans('core::general.order'))->searchable(false),
            Column::make('name')->title(trans('user::role.name')),
            Column::make('display_name')->title(trans('user::role.display-name')),
            Column::make('description')->title(trans('user::role.description')),
            //  Column::make('created_at')->title(trans('user::role.create-at')),
            Column::make('user_count')->title(trans('company::company.personnel'))->orderable(false)->searchable(false),
            Column::make('actions')->title(trans('user::role.action'))->orderable(false)->searchable(false),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Role_' . date('YmdHis');
    }

    private function getNextOrder()
    {
        $latest = Role::latest('id');

        return $latest->exists() ? $latest->first()->order + 1 : 1;
    }
}

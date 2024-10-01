<?php

namespace Modules\User\DataTables\TableView;

use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Modules\User\Entities\Permission;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields\Text;
use Yajra\DataTables\Html\Editor\Fields\Select2;
use Yajra\DataTables\Html\Editor\Fields\TextArea;
use Modules\Core\Contracts\ModuleUtilityContract;

class PermissionDataTable extends DataTable
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
            ->addColumn('action', function ($data){
                return '<div class="d-inline-block text-nowrap">
                <button class="btn btn-sm btn-icon editor-edit" title="edit"><i class="ti ti-edit"></i></button>
                <button class="btn btn-sm btn-icon editor-delete" title="delete"><i class="ti ti-trash"></i></button>
            </div>';
            })
            ->editColumn('created_at', function ($data) {
                return Carbon::parse($data->created_at)->format(setting('date_format_php', 'Y-m-d'));
            })->editColumn('ltpm', function ($data) {
                return substr(strrchr(rtrim($data->ltpm, '\\'), '\\'), 1);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \Modules\User\Entities\Permission $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Permission $model)
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
            ->setTableId('permission-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row px-4'<'col-sm-12 col-md-4 d-flex justify-content-start'f><'col-sm-12 col-md-8 d-flex align-items-center justify-content-end'lB>>" .
            "<'row'<'col-sm-12'tr>>" .
            "<'row'<'col-sm-12 col-md-12 d-flex align-item-center justify-content-center'p>>")
            ->language(["search"=> "","lengthMenu"=>"_MENU_","searchPlaceholder"=> trans('core::table.search')])
            ->orderBy([4, 'asc'])
            ->rowGroup(['dataSrc' => 'ltpm'])
            ->pageLength(10)
            ->columnDefs([
                'className' => 'dt-center',
                'targets' => 'all'
            ])
            ->scrollX('true')
            ->addAction(['width' => '100px'])
            ->buttons(
                Button::make('create')->className('btn btn-primary')->text('<i class="ti ti-plus"></i> <span class="only-pc">'.trans('user::permission.new').'</span>')->editor('editor')->authorized(user()->isAbleTo('create-permission')),
            )->editor(
                Editor::make()->fields([
                    Text::make('name')->id('name'),
                    Text::make('display_name'),
                    TextArea::make('description'),
                    Select2::make('ltpm', 'Related Model')->options($this->muc->getAllEntities()),
                ])->onOpen('function(){ $("#name").attr("onkeyup", "this.value=this.value.replace(/[^a-z -]/g,\'\');"); }')
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
            //Column::make('id'),
            Column::make('name')->title(trans('user::permission.name')),
            Column::make('display_name')->title(trans('user::permission.display-name')),
            Column::make('description')->title(trans('user::permission.description')),
            Column::make('ltpm')->visible(false),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Permission_' . date('YmdHis');
    }
}

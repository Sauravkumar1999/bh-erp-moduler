<?php

namespace Modules\Slider\DataTables\TableView;

use Modules\Slider\Entities\Slider;
use Rmunate\Utilities\SpellNumber;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields\Text;
use Yajra\DataTables\Html\Editor\Fields\Radio;
use Yajra\DataTables\Html\Editor\Fields\File;
use Illuminate\Support\Str;

class SliderDataTable extends DataTable
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
            ->addColumn('status', function ($data) {
                if ($data->status) {
                    return '<span class="badge bg-label-success">' . trans('slider::slider.enable') . '</span>';
                }
                return '<span class="badge bg-label-danger">' . trans('slider::slider.disable') . '</span>';
            })
            ->addColumn('actions', function ($data) {
                return sanitize_output(view('slider::templates._slider-actions', ['data' => $data])->render());
            })
            ->rawColumns(['status', 'items', 'actions']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \Modules\Company\Entities\Company $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Slider $model)
    {
        return $model->select()->orderBy('created_at');
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
            ->setTableId('slider-table')
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
                Button::make()
                    ->className('btn btn-primary')->text('<i class="ti ti-plus"></i> <span class="only-pc">' . trans('core::table.new').'</span>')
                    ->authorized(user()->isAbleTo('create-slider'))
                    ->action('function(e, dt, node, config) { let url = \'' . route('admin.slider.create') . '\'; window.location.href = url; }'),
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
            Column::make('name')->style('min-width:110px;')->title(trans('slider::slider.name')),
            Column::make('slug')->title(trans('slider::slider.slug'))->orderable(false),
            Column::make('description')->style('min-width:150px;')->title(trans('slider::slider.description'))->orderable(false),
            Column::make('status')->title(trans('slider::slider.status')),
            Column::make('actions')->style('min-width:90px;')->title(trans('slider::slider.action'))->orderable(false)
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Slider_' . date('YmdHis');
    }
}

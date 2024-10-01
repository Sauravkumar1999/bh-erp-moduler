<?php

namespace Modules\Company\DataTables\TableView;

use Modules\Company\Entities\Company;
use Rmunate\Utilities\SpellNumber;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields\Text;
use Yajra\DataTables\Html\Editor\Fields\Radio;
use Yajra\DataTables\Html\Editor\Fields\File;
use Illuminate\Support\Str;

class CompanyDataTable extends DataTable
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
            ->addColumn('select_company', function ($data) {
                return '<input type="checkbox" class="select-checkbox form-check" >';
            })
            ->addColumn('contracts', function ($data) {
                return $data->hasMedia('contract') ? "<button class='btn btn-primary button-contract' onclick=\"openContractModal('".$data->firstMedia('contract')->basename."')\">" . trans('company::company.look') . "</button>" : 'N/A';
            })
            // column for contract image preview for edit and create
            ->addColumn('contract', function ($data) {
                if (Str::contains($data->contract(), url('media/image'))) {
                    return '<img style="width:80px;" src="' . $data->contract() . '"/>';
                }
            })
            ->addColumn('status_html', function ($data) {
                $label = '';

                switch ($data->status) {
                    case 1:
                        $label = 'success';
                        break;
                    case 2:
                        $label = 'warning';
                        break;
                    case 3:
                        $label = 'secondary';
                        break;
                    default :
                        break;

                }

                return '<span class="badge  bg-label-'.$label.'" data-status="' . $data->status . '">' . trans('company::company.option-' . SpellNumber::value($data->status)->toLetters()) . '</span>';
            })
            ->addColumn('logo', function ($data) {
                return ($data->logo() == null) ? 'N/A' : '<img style="width:80px;" src="' . $data->logo() . '"/>';
            })

            ->addColumn('registration_date', function ($data) {
                return formatDate($data->created_at);
            })
            ->addColumn('personnel', function ($data) {
                return $data->users()->count() . trans('company::company.count-suffix');
            })
            ->addColumn('actions', function ($data) {
                return sanitize_output(view('company::templates._company-actions', ['data' => $data])->render());
            })
            ->rawColumns(['select_company', 'contracts', 'logo', 'status_html', 'actions']);
    }


    /**
     * Get query source of dataTable.
     *
     * @param \Modules\Company\Entities\Company $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Company $model)
    {
        return $model->with('media')->select();
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
            ->setTableId('company-table')
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
                    ->text('<i class="ti ti-plus"></i> <span class="only-pc">' . trans('company::table.new').'</span>')
                    ->editor('editor')
                    ->authorized(user()->isAbleTo('create-company')),
            )->editor(
                Editor::make('editor')
                    ->fields([
                        Text::make('name')->label(trans('company::company.organization-name'))->attr(['placeholder' => trans('조직명 입력')]),
                        Text::make('representative_name')->label(trans('company::company.representative-name'))->attr(['placeholder' => trans('대표자명 입력')]),
                        File::make('logo')->label(trans('company::company.logo'))
                            ->display("function (file_id) {
                                if (!file_id) {
                                    return null;
                                }
                            if(!file_id.includes('img')) {
                                let fileURL = '" . route('media.file.display', ':file') . "';
                                fileURL = fileURL.replace(':file', file_id);
                                return fileURL ? '<img src=\"'+fileURL+'\" />' : null ;
                            } else {
                                return file_id;
                            }
                        }"),

                        Text::make('registration_number')->label(trans('company::company.license-number'))->attr(['placeholder' => trans('숫자 입력')]),
                        Text::make('address')->label(trans('company::company.address'))->attr(['placeholder' => trans('주소 입력')]),
                        File::make('contract')->label(trans('company::company.contracts'))
                            ->display("function (file_id) {
                                if (!file_id) {
                                    return null;
                                }
                            if (file_id.toLowerCase().endsWith('.pdf')) {
                                let fileURL = '" . route('media.file.display', ':file') . "';
                                fileURL = fileURL.replace(':file', file_id);
                                return '<a href=\"' + fileURL + '\" target=\"_blank\">View PDF</a>';
                            } else if (!file_id.includes('img')) {
                                // Display image for other non-image files
                                let fileURL = '" . route('media.file.display', ':file') . "';
                                fileURL = fileURL.replace(':file', file_id);
                                return fileURL ? '<img src=\"' + fileURL + '\" />' : null;
                            } else {
                                // Display the file_id as is (assuming it's an image)
                                return file_id;
                            }
                        }"),

                        Radio::make('status')
                            ->label(trans('company::company.status'))
                            ->options([
                                [
                                    'label' => trans('company::company.option-one'),
                                    'value' => 1
                                ],
                                [
                                    'label' => trans('company::company.option-two'),
                                    'value' => 2
                                ],
                                [
                                    'label' => trans('company::company.option-three'),
                                    'value' => 3
                                ]
                            ])
                            ->default(1)
                    ])->onOpen("function(e, mode, action) {
                        $('.modal-dialog').addClass('modal-sm');
                        $('.col-form-label').removeClass('col-lg-4');
                        $('.col-form-label').addClass('col-lg-12');
                        $('[data-dte-e=\'input\']').removeClass('col-lg-8');
                        $('[data-dte-e=\'input\']').addClass('col-lg-12');

                        if(action === 'create') {
                            editor.title('".trans('company::company.create')."');
                            editor.buttons([
                                  {
                                     text: '".trans('core::modal.cancellation')."',
                                     action: function() {
                                         editor.close();
                                     }
                                  },
                                  {
                                     text: '".trans('core::modal.save')."',
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
//            Column::make('select_company')
//                ->title('<input type="checkbox" name="select_company">')
//                // ->className('select-checkbox')
//                ->orderable(false),
            Column::make('code')->style('min-width:90px;')->title(trans('company::company.code')),
            Column::make('name')->style('min-width:110px;')->title(trans('company::company.organization-name')),
            Column::make('logo')->title(trans('company::company.logo'))->orderable(false),

            /*Column::make('business_name')
               ->render('function (data, type, row) { return data ? "<span class=\'business_name_button\'> "+data+"</span>" : "N/A"; }')
               ->style('min-width:120px;')->title(trans('company::company.business-name')),*/

               Column::make('contracts')->style('min-width:100px;')->title(trans('company::company.contract'))->orderable(false),
            Column::make('status_html')->title(trans('company::company.status')),
            Column::make('registration_date')->style('min-width:100px;')->title(trans('company::company.registration-date')),
            Column::make('personnel')->style('min-width:90px;')->title(trans('company::company.personnel'))->orderable(false),
            Column::make('actions')->style('min-width:90px;')->title(trans('core::general.edit-delete'))->orderable(false)
                ->visible(user()->isAbleTo('update-company|delete-company')),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Company_' . date('YmdHis');
    }
}

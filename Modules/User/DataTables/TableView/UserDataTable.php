<?php

namespace Modules\User\DataTables\TableView;

use Illuminate\Support\Carbon;
use App\DataTables\ChunkedDatatableExportHandler;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Modules\User\Entities\User;
use Modules\User\Traits\UserSequenceManager;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields\Text;
use Yajra\DataTables\Html\Editor\Fields\TextArea;
use Yajra\DataTables\Html\Editor\Fields\Select;
use Yajra\DataTables\Html\Editor\Fields\Radio;
use Yajra\DataTables\Html\Editor\Fields\File;
use Illuminate\Support\Str;

class UserDataTable extends DataTable
{
    use UserSequenceManager;
    protected $exportClass = ChunkedDatatableExportHandler::class;


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
            ->addColumn('actions', function ($data) {
                return sanitize_output(view('user::users.templates._user-actions', ['data' => $data])->render());
            })
            // Update the UserDataTable class
            ->addColumn('idCardWithBankbook', function ($data) {
                return '<div class="CardWithBankbook">
                    <a href="javascript:void(0)" onclick="openImageDataModal(\'' . $data->idCard() . '\', \'idCard\')">' . trans('user::user.id-card') . '</a>
                    <a href="javascript:void(0)" onclick="openImageDataModal(\'' . $data->bankbook() . '\', \'bankbook\')">' . trans('user::user.bankbook') . '</a>
                    </div>';
            })
            // two columns for idCard and bankbook image preview for edit and create
            ->addColumn('idCard', function ($data) {
                if (Str::contains($data->idCard(), url('media/image'))) {
                    return '<img style="width:80px;" src="' . $data->idCard() . '"/>';
                }
            })
            ->addColumn('bankbook', function ($data) {
                if (Str::contains($data->bankbook(), url('media/image'))) {
                    return '<img style="width:80px;" src="' . $data->bankbook() . '"/>';
                }
            })
            // ->editColumn('status', function ($data) {
            //     return ($data->status) ? '<span class="badge rounded bg-label-success">' . trans('user::user.active') . '</span>' : '<span class="badge rounded bg-label-warning">' . trans('user::user.deactivated') . '</span>';
            // })
            ->editColumn('company_id', function ($data) {
                return $data->company ? $data->company->name : "N/A";
            })
            ->filterColumn('company_id', function ($query, $keyword) {
                $query->whereHas('company', function ($query) use ($keyword) {
                    $query->where('name', 'like', "%{$keyword}%");
                });
            })
            ->addColumn('role', function ($data) {
                return $data->roles->isNotEmpty() ? $data->roles->first()->name : 'N/A';
            })
            ->addColumn('registration_final_confirmation', function ($data) {
                $registration = $data->created_at ? date_format($data->created_at, setting('date_format_php', 'Y-m-d')) : '-';
                $confirmation = $data->final_confirmation ? date_format($data->final_confirmation, setting('date_format_php', 'Y-m-d')) : '-';
                return $registration . ' / ' . $confirmation;
            })->orderColumn('registration_final_confirmation', function ($query, $order) {
                $query->orderBy('created_at', $order);
            })
            ->editColumn('final_confirmation', function ($data) {
                return $data->final_confirmation ? date_format($data->final_confirmation, setting('date_format_php', 'Y-m-d')) : '-';
            })
            ->editColumn('dob', function ($data) {
                return $data->dob ? Carbon::parse($data->dob)->format(setting('date_format_php', 'Y-m-d')) : 'N/A';
            })
            ->editColumn('last_login', function ($data) {
                return $data->created_at ? Carbon::parse($data->created_at)->format(setting('date_format_php', 'Y-m-d')) : 'N/A';
            })
            ->filterColumn('user_type', function ($query, $keyword) {
                $query->where("user_type", "like", "%{$keyword}%");
            })
            ->addColumn('name', function ($data) {
                return $data->first_name;
            })->orderColumn('name', function ($query, $order) {
                $query->orderBy('first_name', $order);
            })->filterColumn('name', function ($query, $keyword) {
                $query->where('first_name', 'LIKE', "%{$keyword}%")
                    ->orWhere('last_name', 'LIKE', "%{$keyword}%");
            })
            ->addColumn('telephone_1', function ($data) {
                return $data->contacts()->exists() ? arrange_telephone($data->contacts->first()->telephone_1) : 'N/A';
            })->orderColumn('telephone_1', function ($query, $order) {
                $query->orderBy('telephone_1', $order);
            })->filterColumn('telephone_1', function ($query, $keyword) {
                $query->whereHas('contacts', function ($query) use ($keyword) {
                    $query->whereRaw("replace(telephone_1, '-', '') LIKE ? ", ["%{$keyword}%"]);
                });
            })
            ->addColumn('address', function ($data) {
                return $data->contacts()->exists() ? $data->contacts->first()->address : 'N/A';
            })->orderColumn('address', function ($query, $order) {
                $query->orderBy('address', $order);
            })->filterColumn('address', function ($query, $keyword) {
                $query->whereHas('contacts', function ($query) use ($keyword) {
                    $query->where("address", "like", "%{$keyword}%");
                });
            })->filterColumn('role', function ($query, $keyword) {
                $query->whereHas('roles', function ($query) use ($keyword) {
                    $query->where("display_name", "LIKE", "%{$keyword}%")
                        ->orWhere("name", "LIKE", "%{$keyword}%");
                });
            })
            ->editColumn('parent_id', function ($data) {
                if ($data->parent) {
                    $recommender = $data->parent;
                    return ($recommender && $recommender->code) ? $recommender->code : '';
                } else {
                    return '';
                }
            })
            ->addColumn('recommender', function ($data) {
                if ($data->parent) {
                    $recommender = $data->parent;
                    return ($recommender && $recommender->code) ? '<span>' . $recommender->first_name . '</span> <br> <span> (' . $recommender->code . ')</span>' : 'N/A';
                } else {
                    return 'N/A';
                }
            })
            ->addColumn('recommender_contact', function ($data) {
                $recommender = $data->parent;
                if ($recommender) {
                    $contact = $recommender->contacts->first();
                    if ($contact) {
                    return ($contact && $contact->telephone_1) ? $contact->telephone_1 : 'N/A' ;
                    }
                }
                return 'N/A';
            })
            ->filter(function ($query) {
                if (request()->has('date_range') && request()->date_range != null) {
                    $date = explode(' to ', request()->date_range);

                    $start = Carbon::parse($date[0])->startOfDay(); // Start of the day
                    $end = Carbon::parse($date[1])->endOfDay(); // End of the day


                    $query->whereBetween('final_confirmation', [$start, $end]);
                }
            }, true)
            ->addColumn('product_setting', function ($data) {
                return '<button class="btn btn-primary" onclick="productSetting(' . $data->id . ')" >' . trans('product::product.look') . '</button>';
            })
            ->addColumn('submitted_date', function ($data) {
                return $data->submitted_date ? Carbon::parse($data->submitted_date)->format(setting('date_format_php', 'Y-m-d')) : '';
            })
            ->filterColumn('submitted_date', function ($query, $keyword) {
                if (Carbon::hasFormat($keyword, 'Y-m-d')) {
                    $parsedDate = Carbon::parse($keyword)->format('Y-m-d');
                    $query->whereDate('submitted_date', $parsedDate);
                }
                if(request()->has('membership') && request()->membership)
                {
                    if(request()->membership === 'waiting'){
                        $query->whereNotNull('submitted_date')
                        ->where(function ($query) {
                            $query->whereNull('end_date')
                                ->orWhere('end_date', '<=', now()->toDateString())
                                ->Where('submitted_date', '>', DB::raw('COALESCE(end_date, NOW())'));
                        });
                    }
                    if(request()->membership === 'approval'){
                        $query->where(function ($query) {
                            $query->Where('start_date', '<=', now()->toDateString())
                            ->Where('end_date', '>=', now()->toDateString());
                        });
                    }
                }
            })
            ->orderColumn('submitted_date', function ($query, $order) {
                $query->orderBy('submitted_date', $order);
            })
            ->addColumn('deposit_date', function ($data) {
                return $data->deposit_date ? Carbon::parse($data->deposit_date)->format(setting('date_format_php', 'Y-m-d')) : '';
            })
            ->filterColumn('deposit_date', function ($query, $keyword) {
                if (Carbon::hasFormat($keyword, 'Y-m-d')) {
                    $parsedDate = Carbon::parse($keyword)->format('Y-m-d');
                    $query->whereDate('deposit_date', $parsedDate);
                }
            })
            ->orderColumn('deposit_date', function ($query, $order) {
                $query->orderBy('deposit_date', $order);
            })
            ->addColumn('start_date', function ($data) {
                return $data->start_date ? Carbon::parse($data->start_date)->format(setting('date_format_php', 'Y-m-d')) : '';
            })
            ->filterColumn('start_date', function ($query, $keyword) {
                if (Carbon::hasFormat($keyword, 'Y-m-d')) {
                    $parsedDate = Carbon::parse($keyword)->format('Y-m-d');
                    $query->whereDate('start_date', $parsedDate);
                }
            })
            ->orderColumn('start_date', function ($query, $order) {
                $query->orderBy('start_date', $order);
            })

            ->addColumn('end_date', function ($data) {
                return $data->end_date ? Carbon::parse($data->end_date)->format(setting('date_format_php', 'Y-m-d')) : '';
            })
            ->filterColumn('end_date', function ($query, $keyword) {
                if (Carbon::hasFormat($keyword, 'Y-m-d')) {
                    $parsedDate = Carbon::parse($keyword)->format('Y-m-d');
                    $query->whereDate('end_date', $parsedDate);
                }
            })
            ->orderColumn('end_date', function ($query, $order) {
                $query->orderBy('end_date', $order);
            })
            ->addColumn('royal_member_application', function ($data) {
                $currentDate = now();
                $startDate = $data->start_date;
                $endDate = $data->end_date;
                if ($currentDate >= $startDate && $currentDate <= $endDate) {
                    return 'Royal';
                } else {
                    return 'N';
                }
            })
            ->filterColumn('royal_member_application', function ($query, $keyword) {
                if (!is_numeric($keyword)) {
                    $lowercaseKeyword = strtolower($keyword);
                    if ($lowercaseKeyword === 'royal') {
                        $query->whereRaw('? BETWEEN start_date AND end_date', [now()]);
                    } elseif ($lowercaseKeyword === 'n') {
                        $query->where(function ($query) {
                            $query->where('start_date', '>', now())
                                ->orWhere('end_date', '<', now());
                        });
                    }
                }
            })
            ->orderColumn('royal_member_application', function ($query, $order) {
                if ($order === 'asc') {
                    $query->orderByRaw('CASE WHEN ? BETWEEN start_date AND end_date THEN 0 ELSE 1 END', [now()]);
                } elseif ($order === 'desc') {
                    $query->orderByRaw('CASE WHEN ? BETWEEN start_date AND end_date THEN 1 ELSE 0 END', [now()]);
                }
            })
            ->rawColumns(['selectUser', 'product_setting', 'actions', 'status', 'recommender', 'idCardWithBankbook']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \Modules\User\Entities\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery()->with('contacts', 'company', 'roles')
            ->join('contacts', 'contacts.user_id', '=', 'users.id')
            ->select('users.*', 'contacts.id AS contact_id', 'contacts.telephone_1', 'contacts.address');
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
            ->setTableId('user-table')
            ->columns($this->getColumns())
            ->ajax([
                'url' => route('admin.users.index'),
                'data' => 'function(d) {
                    d.date_range = $("#date_range").val();
                    d.membership = $("#membershipDropdown").val();
                }',
            ])
            ->dom("<'row px-4'<'col-sm-12 col-md-4'f><'col-sm-12 col-md-8 d-flex align-items-center justify-content-end'lB>>" .
                "<'row'<'col-sm-12'tr>>" .
                "<'row'<'col-sm-12 col-md-12 d-flex align-item-center justify-content-center'p>>")

            ->initComplete("function(settings, json) {
            if ($(window).width() < 768) {
                $('#user-table_length').addClass('d-block addRelative');
            }
            else {
                $('#user-table_length').removeClass('d-none addRelative');
            }
        }")
            ->language(["search" => "", "lengthMenu" => "_MENU_", "searchPlaceholder" => trans('core::table.search')])
            ->orderBy(12, 'desc')
            ->scrollX('true')
            ->columnDefs([
                'className' => 'dt-center',
                'targets'   => 'all'
            ])
            ->pageLength(10)
            ->parameters([
                'buttons' => [
                    user()->isAbleTo('import-user') ? [
                        'extend'    => 'collection',
                        "className" => 'btn btn-secondary dropdown-toggle waves-effect waves-light my-sm-2 my-0',
                        "text"      => '<i class="ti ti-download me-1"></i> <span class="only-pc">' . trans('core::general.export').'</span>',
                        "buttons"   => [
                            [
                                [
                                    'extend'        => 'print',
                                    'text'          => '<i class="ti ti-printer me-2"></i>' . trans('core::general.print'),
                                    'className'     => 'dropdown-item',
                                    'exportOptions' => ['columns' => [0, 1, 2, 3, 4, 5]],
                                ],
                                [
                                    'extend'    => 'excel',
                                    'text'      => '<i class="ti ti-file-text me-2"></i>' . trans('core::general.excel'),
                                    'className' => 'dropdown-item',
                                ]
                            ]
                        ]
                    ] : [],
                    // New button for bulk user import via Excel
                    user()->isAbleTo('import-user') ? [
                        'extend'    => 'collection',
                        "className" => 'btn btn-secondary dropdown-toggle waves-effect waves-light my-sm-2 my-0',
                        "text"      => '<i class="ti ti-upload me-2"></i> <span class="only-pc">' . trans('core::general.import').'</span>',
                        "buttons"   => [
                            [
                                [
                                    'text'      => '<i class="ti ti-file-text me-2"></i>' . trans('core::general.excel'),
                                    'className' => 'dropdown-item',
                                    'action'    => "function (e, dt, node, config) {
                
                                        let token = $('meta[name=\"csrf-token\"]').attr('content');
                                        let formData = new FormData();
                                        let inputFile = $('<input type=\"file\" name=\"user_excel\">');
                                        inputFile.on('change', function() {
                                            formData.append('user_excel', inputFile.prop('files')[0]);
                                        });
                                        inputFile.click();
                                        inputFile.on('change', function() {
                                            $.ajax({
                                                url: '/user/import',
                                                type: 'POST',
                                                headers: {
                                                    'X-CSRF-TOKEN': token
                                                },
                                                data: formData,
                                                processData: false,
                                                contentType: false,
                                                success: function(response) {
                                                    // Handle the success response
                                                    // console.log(response);
                                                    Swal.fire({
                                                        position: 'center',
                                                        icon: 'success',
                                                        title: 'Success!',
                                                        text: response.details.message,
                                                        showConfirmButton: false,
                                                        timer: 5000,
                                                        timerProgressBar: true
                                                    }).then(() => {
                                                        // Download the log file for failed insertions
                                                        if (response.download_link) {
                                                            const link = document.createElement('a');
                                                            link.href = response.download_link;
                                                            link.setAttribute('download', 'failed_records.xlsx');
                                                            document.body.appendChild(link);
                                                            link.click();
                                                            document.body.removeChild(link);
                                                        }
                                                    });
                                                },
                                                error: function(xhr, status, error) {
                                                    // Handle the error response
                                                    console.log(error);
                                                    Swal.fire({
                                                        position: 'center',
                                                        icon: 'error',
                                                        title: 'Error!',
                                                        text: 'Import failed',
                                                        showConfirmButton: false,
                                                        timer: 5000,
                                                        timerProgressBar: true
                                                    });
                                                }
                                            });
                                        });
                                    }"
                                ],
                                [
                                    'text'      => '<i class="ti ti-file-text me-2"></i>' . trans('core::general.download_template'),
                                    'className' => 'dropdown-item',
                                    'action'    => "function (e, dt, node, config) {
                                        window.location.href = '".route('user.download-template')."';
                                    }"
                                ],
                            ]
                        ]
                    ] : [],
                ]
            ])->buttons(
                Button::make('')
                    ->action('function(e, dt, node, config) {
                          e.preventDefault();
                          editor.create({
                                title: "' . trans('user::user.create-member') . '",
                                buttons: [
                                    {
                                        text: "' . trans('user::user.cancellation') . '",
                                        action: function() {
                                            editor.close();
                                        }
                                    },
                                    {
                                        text: "' . trans('user::user.save') . '",
                                        action: function() {
                                            editor.submit();
                                        }
                                    }
                                ]
                          });

                     }')
                    ->className('btn btn-primary  my-sm-2 my-0 add_new_class')
               ->text('<i class="ti ti-plus"></i> <span class="only-pc">' . trans('user::table.new').'<span>')
                    ->authorized(user()->isAbleTo('create-user')),
            )
            ->editor(
                Editor::make()->fields([
                    Select::make('status')
                        ->label(trans('user::user.status'))
                        ->options([
                            trans('user::user.approval') => 1,
                            trans('user::user.waiting')  => 0,
                        ])->attr(['id' => 'userMemberStatus']),
                    Select::make('user_type')
                        ->label(trans('user::user.user-type'))
                        ->options([
                            trans('user::user.agency') => 'agency',
                            trans('user::user.member') => 'member',
                        ])->attr(['id' => 'userType']),
                    Text::make('code')->label(trans('user::user.code'))
                        ->attr(['id' => 'userMemberCode', 'readonly' => 'readonly']),
                    Select::make('company_id')
                        ->label(trans('user::user.company-name'))
                        ->options($this->getCompaniesDropdown())->id('user_company_id'),
                    Select::make('role')->label(trans('user::user.role-type'))->options($this->getUserRoleDropDown())->id('user_role'),
                    Text::make('name')->label(trans('user::user.name'))->attr(['placeholder' => trans('user::user.name')]),
                    // Text::make('last_name')->label(trans('user::user.last_name'))->attr(['placeholder' => trans('user::user.last_name')]),
                    // Select::make('countryCode')->options(
                    //     $this->getCountryCodeDropdown()
                    // )->label(trans('user::user.contact'))->attr(['id' => 'countryCode']),
                    Text::make('telephone_1')->label(trans('user::user.contact'))->attr(['id' => 'mobile-no-txt', 'placeholder' => trans('user::user.contact')]),
                    Text::make('dob')->label(trans('user::user.dob'))->attr(['id' => 'dob', 'class' => 'datemask', 'placeholder' => setting('date_format_js')]),
                    Radio::make('gender')
                        ->label(trans('user::user.gender'))
                        ->options([
                            ['label' => trans('user::user.male'), 'value' => 'male'],
                            ['label' => trans('user::user.female'), 'value' => 'female'],
                        ])->default('male'),
                    Text::make('email')->label(trans('user::user.email'))->attr(['id' => 'email', 'placeholder' => trans('user::user.email')]),
                    Text::make('password')->label(trans('user::user.password'))
                        ->attr(['id' => 'password', 'readonly' => 'readonly', 'placeholder' => trans('user::user.password'), 'disabled' => true, 'class' => 'password-field']),
                    TextArea::make('address')->label(trans('user::user.address'))->attr(['id' => 'address', 'placeholder' => trans('user::user.address')]),
                    Text::make('registration_final_confirmation')->label(trans('user::user.final-confirmation'))->attr(['id' => 'final_confirmation', 'class' => 'calendar', 'disabled' => true, 'placeholder' => trans('user::user.final-confirmation')]),
                    Text::make('parent_id')->label(trans('user::user.recommender')),
                    File::make('idCard')->label(trans('user::user.id-card'))
                        ->display("function (file_id) {  if(!file_id.includes('img')) { let fileURL = '" . route('media.file.display', ':file') . "';  fileURL = fileURL.replace(':file', file_id); return fileURL ? '<img src=\"'+fileURL+'\" />' : null ;   } else { return file_id; } }"),
                    File::make('bankbook')->label(trans('user::user.bankbook'))
                        ->display("function (file_id) {  if(!file_id.includes('img')) { let fileURL = '" . route('media.file.display', ':file') . "';  fileURL = fileURL.replace(':file', file_id); return fileURL ? '<img src=\"'+fileURL+'\" />' : null ;   } else { return file_id; } }"),
               Text::make('member_management')->label(trans('user::user.royal-member-management'))->attr(['class'=>'d-none'])->labelAttr(['class' => 'your-label-class']),
                    Text::make('submitted_date')->label(trans('user::user.royal-member-application-date')),
                    Text::make('deposit_date')->label(trans('user::user.royal-member-deposite-date'))->attr(['id' => "deposite-datepicker"]),
                    Text::make('start_date')->label(trans('user::user.start-date'))->attr(['id' => "start-datepicker"]),
                    Text::make('end_date')->label(trans('user::user.end-date'))->attr(['id' => "end-datepicker"]),
               Text::make('royal_member_application')->label(trans('user::user.royal-member-application'))->attr(['id' => "member-application",'disabled' => true])
                ])->onOpen("function(e, mode, action) {
                           $('body').addClass('deposite-datepicker');
                           $('#deposite-datepicker').datepicker({
                              format: 'yyyy-mm-dd',
                              autoclose: true,
                           })
                           $('#DTE_Field_submitted_date').datepicker({
                              format: 'yyyy-mm-dd',
                              autoclose: true,
                           }).on('changeDate', function(selected) {
                              var minDate = new Date(selected.date.valueOf());
                              $('#deposite-datepicker').datepicker('setStartDate', minDate);
                          });
                          $('#end-datepicker').datepicker({
                           format: 'yyyy-mm-dd',
                           autoclose: true,
                           })
                           $('#start-datepicker').datepicker({
                              format: 'yyyy-mm-dd',
                              autoclose: true,
                           }).on('changeDate', function(selected) {
                              var minDate = new Date(selected.date.valueOf());
                              $('#end-datepicker').datepicker('setStartDate', minDate);
                          });

                         if(action === 'create') {
                            editor.field('user_type').set('member');
                            // editor.field('code').set('" . $this->getNextUserCode() . "');
                            editor.buttons([
                                  {
                                     text: '" . trans('user::user.cancellation') . "',
                                     action: function() {
                                         editor.close();
                                     }
                                  },
                                  {
                                     text: '" . trans('user::user.save') . "',
                                     action: function() {
                                         editor.submit();
                                     }
                                  }
                            ]);
                         }

                         if(action === 'edit') {
                            let data = grid.row(editor.modifier()).data();
                            if(data.submitted_date){
                                var minDate = new Date(data.submitted_date);
                                $('#deposite-datepicker').datepicker('setStartDate', minDate);
                            }

                             editor.field('user_type').set(data.user_type);
                             editor.field('code').set(data.code);
                             $('#user_role option[value='+ data.roles[0]?.id +' ]').prop('selected', true);
                             $('#user_company_id option[value='+ data.company?.id +' ]').prop('selected', true);
                         }
                         $('#mobile-no-txt').on('input', function() {
                            editor.field('telephone_1').input().inputmask('mask', { 'mask' : '" . setting('telephone_format') . "'});
                            var telephoneValue = $(this).val().replace(/\D/g, '');
                            $('#userMemberCode').val(telephoneValue);
                         });
                         $('#deposite-datepicker').on('change',function(){
                           var selectedDate = $(this).val();
                           if(selectedDate && selectedDate != 'N/A'){
                              $('#start-datepicker').datepicker('setStartDate', new Date(selectedDate));
                              // Set the selected date to start-datepicker
                              $('#start-datepicker').val(selectedDate);

                              var endDate = new Date(selectedDate);
                              endDate.setFullYear(endDate.getFullYear() + 1);
                              endDate.setDate(endDate.getDate() - 1);
                              // Format the end date as yyyy-mm-dd
                              if (endDate instanceof Date && !isNaN(endDate)) {
                                 var formattedEndDate = endDate.toISOString().slice(0, 10);
                                 // Set the formatted end date to end-datepicker
                                 $('#end-datepicker').val(formattedEndDate);
                                 var currentDate = new Date();

                                 if (currentDate <= endDate && currentDate >= new Date(selectedDate)) {
                                    $('#member-application').val('Royal');
                                 }else{
                                    $('#member-application').val('N');
                                 }
                               }

                           }
                         })
                         $('#start-datepicker,#end-datepicker').on('change',function(){
                           var selectedDate = $('#start-datepicker').val();
                           var endDate = $('#end-datepicker').val();
                           var currentDate = new Date();
                           if (currentDate <= new Date(endDate) && currentDate >= new Date(selectedDate)) {
                              $('#member-application').val('Royal');
                           }else{
                              $('#member-application').val('N');
                           }
                         })
                         if(action === 'create' || action === 'edit') {

                            

                            $('.datemask').inputmask('datetime', {
                                inputFormat: '" . setting('date_format_js') . "',
                                min: '1900-01-01',
                                max: '2999-01-01'
                            });

                            editor.field('status').input().change(function (e) {
                                e.preventDefault();
                                var selectedValue = $(this).val();
                                if (selectedValue == '0') {
                                    $(this).css('color', 'orange');
                                } else{
                                    $(this).css('color', 'green');
                                }
                            });
                            generate_password_html();
                            generate_reject_button();
                         }
                    }")
            );
    }

    protected function getCompaniesDropdown()
    {
        return collect(companies())->mapWithKeys(function ($company) {
            return [$company['name'] => $company['id']];
        })->toArray();
    }


    protected function getUserRoleDropDown()
    {
        return collect(userRole())->mapWithKeys(function ($role) {
            return [$role['display_name'] => $role['id']];
        })->toArray();
    }
    // protected function getUsertypesDropdown()
    // {
    //     return [trans('user::user.agency'), trans('user::user.member')];
    //     /*$roles = roles();
    //    /return collect($roles)->mapWithKeys(function ($name, $id) {
    //         return [$name => $id];
    //     })->toArray();*/
    // }

    protected function getCountryCodeDropdown()
    {
        $jsonFilePath = public_path('vendor/countryCode/selectCountrycode.json');
        $jsonContent = file_get_contents($jsonFilePath);
        $countryjsonData = json_decode($jsonContent, true);
        if ($countryjsonData === null && json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception('Error decoding JSON file');
        } else {
            return collect($countryjsonData)->mapWithKeys(function ($data) {
                return [$data['name'] => $data['dial_code']];
            })->toArray();
        }
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        $columns = [
            Column::make('status')->render('function (data, type, row) {
                return data ? "<span class=\"badge rounded bg-label-success\">' . trans("user::user.active") . '</span>" : "<span class=\"badge rounded bg-label-warning\">' . trans("user::user.waiting") . '</span>";
            }')->style('min-width:120px;')->title(trans('user::user.status')),
            Column::make('user_type')->title(trans('user::user.user-type'))
                ->render('function (data, type, row) { return data ? (data == "member" ? "' . trans('user::user.member') . '" : "' . trans('user::user.agency') . '" ) : "N/A"; }'),
            Column::make('code')->style('min-width:80px;')->title(trans('user::user.code')),
            Column::make('company_id')->title(trans('user::user.company')),
            Column::make('role')->title(trans('user::user.role-type'))->orderable(false),
            Column::make('name')->title(trans('user::user.name')),
            Column::make('telephone_1')->title(trans('user::user.contact')),
            Column::make('dob')->style('min-width:100px;')->title(trans('user::user.dob')),
            Column::make('gender')->style('min-width:40px;')->title(trans('user::user.gender'))
                ->render('function (data, type, row) {
                    if(data) {
                        let gender = "";
                        if(data == "male") {
                            gender =  "' . trans('user::user.male') . '";
                        } else if(data == "female") {
                            gender =  "' . trans('user::user.female') . '";
                        }
                        return gender;
                    } else {
                        return "N/A";
                    }
             }'),
            Column::make('email')->title(trans('user::user.email')),
            Column::make('address')->style('min-width:100px;')->title(trans('user::user.address')),
            Column::make('registration_final_confirmation')->style('min-width:100px;')->title(trans('user::user.created-at')),
            Column::make('created_at')->data('created_at')->visible(false),
            Column::make('recommender')->style('min-width:70px;')->title(trans('user::user.recommender')),
            Column::make('recommender_contact')->style('min-width:70px;')->title(trans('user::user.recommender-contact')),
            Column::make('idCardWithBankbook')->title(trans('user::user.id-or-bankbook')),
            Column::make('product_setting')->title(trans('product::product.setting'))->orderable(false)->visible(user()->isAdmin()),
        ];

        //Royal membership columns
        if (setting('royal_membership_active', 1)) {
            $royalMembershipColumns = [
                Column::make('submitted_date')->title(trans('user::user.royal-member-application-date')),
                Column::make('deposit_date')->title(trans('user::user.royal-member-deposite-date')),
                Column::make('start_date')->title(trans('user::user.start-date')),
                Column::make('end_date')->title(trans('user::user.end-date')),
                Column::make('royal_member_application')->title(trans('user::user.royal-member-application')),
            ];

            $columns = array_merge($columns, $royalMembershipColumns);
        }
        //actions column
        $columns[] = Column::make('actions')->title(trans('user::user.action'))->visible(user()->isAbleTo('update-user|delete-user|update-user-permission'));

        return $columns;
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'User_' . date('YmdHis');
    }


    protected function buildExcelFile()
    {
        $query = app()->call([$this, 'query']);
        $query = $this->applyScopes($query);
        $dataTable = app()->call([$this, 'dataTable'], compact('query'));
        $dataTable->skipPaging();
        $data_query = $dataTable->getFilteredQuery();
        $columns = collect($this->exportColumns());
        $columns = $columns->map(function ($item) {
            if($item->name !== 'created_at')
                return $item->title;
        })->filter();

        return new $this->exportClass($data_query, $columns);
    }
}

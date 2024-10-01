@extends('adminlte::page')
@section('title', 'Activity Log')

@section('content_header')
    <x-core-content-header :title="__('Activity Log')" :breadcrumbs="$breadcrumbs" />
@endsection

@section('content')

    <x-adminlte-card theme="primary" theme-mode="outline">
        {!! $dataTable->table() !!}
    </x-adminlte-card>

    <!-- Optional: Include modal if needed for displaying details -->
    <div class="modal fade" id="activityDetailsModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header custom_modal-header">
                    <h5 class="modal-title" id="modalTitle">Activity Details</h5>
                    <button type="button" class="close-modal-button btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body custom_modal-body">
                    <div id="activityDetailsContent"><!-- Content populated by JavaScript --></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')

<link rel="stylesheet" href="https://cdn.datatables.net/select/1.7.0/css/select.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/rowgroup/1.1.2/css/rowGroup.dataTables.min.css">
<link rel="stylesheet" href="{{ asset('/vendor/datatables/dt-editor/css/editor.bootstrap5.min.css') }}">

<style>

.modal-dialog {
    display: flex;
    align-items: center;
    min-height: calc(100% - (.5rem * 2));
}

.modal {
    overflow-y: auto;
}

.changed-key {
    margin-bottom: 5px;
}

.modal-title {
    width: 100%;
    text-align: center;
    font-size: 24px;
    font-family: Pretendard;
    font-weight: 600;
    line-height: 28.64px;
    color: #2B2B2B;
}
#modal-title {
    text-transform: capitalize;
}

</style>
@endsection

@section('js')
<script type="text/javascript" src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/rowgroup/1.4.1/js/dataTables.rowGroup.min.js"></script>
<script type="text/javascript" src="{{ asset('/vendor/datatables/dt-editor/js/dataTables.editor.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/vendor/datatables/dt-editor/js/editor.bootstrap5.min.js') }}"></script>

     {!! $dataTable->scripts() !!}

    <script>
        $(document).ready(function() {
           
            // Retrieve the DataTable instance
            let tableId = "{!! $dataTable->getTableAttribute('id') !!}";
            let grid = window.LaravelDataTables[tableId];

            $(document).on('click', '.activity-view-btn', function() {
                // console.log('Button clicked');
                let data = grid.row($(this).closest('tr')).data();
                $('#activityDetailsContent').html('Details for Activity ID: ' + data.id);
                $('#activityDetailsModal').modal('show');


                let properties = data.properties ? $("<div/>").html(data.properties).text() : {old: {}, attributes: {}};
                properties = JSON.parse(properties);
                let propertiesHtml = '';
                for (const [key, value] of Object.entries(properties.old)) {
                    let newValue = properties.attributes[key] || 'N/A';
                    if (key === 'company_id') {
                        fetchCompanyName(`${value},${newValue}`, function(company_name) {
                            let oldCompanyName = company_name[value];
                            let newCompanyName = company_name[newValue];
                            propertiesHtml += `<p class='changed-key'><strong>Company Name</strong></p><p> ${oldCompanyName} → ${newCompanyName}</p>`;
                            updateUI(propertiesHtml, data);
                        });
                    } else {
                        propertiesHtml += `<p class='changed-key'><strong>${key}</strong></p><p> ${value} → ${newValue}</p>`;
                    }
                }

                // Set the content in the modal
                $('#activityDetailsContent').html(`
                    <p><strong>Event:</strong> ${data.description}</p>
                    ${propertiesHtml}
                `);

                // Show the modal
                $('#activityDetailsModal').modal('show');
      
            });

            $('.close-modal-button').click(function () {
                closeModal();
            });

            function closeModal() {
                $('#activityDetailsModal').modal('hide');
            }

            function fetchCompanyName(companyId, callback) {
                $.ajax({
                    url: `/api/get-company-names/${companyId}`,
                    type: 'GET',
                    success: function(response) {
                        if (callback) {
                            callback(response); // Pass the response to the callback function
                        }
                    },
                    error: function() {
                        console.log('Error fetching company name');
                    }
                });
            }

            function updateUI(propertiesHtml, data) {
                // Update the UI with the final propertiesHtml
                $('#activityDetailsContent').html(`<p><strong>Event:</strong> ${data.description}</p>
                    ${propertiesHtml}`);
                
            }
        });
    </script>
@endsection
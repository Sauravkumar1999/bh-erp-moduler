<div class="d-inline-block text-nowrap">
    @permission('update-user')
        <button class="btn btn-sm btn-icon editor-edit"><i class="ti ti-edit"></i></button>
    @endpermission
    @permission('update-user-permission')
        <button onclick="window.livewire.emit('openModal', '{{ $data->id  }}'); loading();" class="btn btn-sm btn-icon editor-permission"><i class="fa-solid fa-user-secret"></i></button>
    @endpermission
    @permission('delete-user')
        <button class="btn btn-sm btn-icon editor-delete"><i class="ti ti-trash"></i></button>
    @endpermission
</div>

<div class="d-inline-block text-nowrap">
    @permission('update-bulletin')
    <button class="btn btn-sm btn-icon editor-edit"><i class="ti ti-edit" data-title="{{ $data->title }}" data-permission="{{ $data->permission }}"></i></button>
    @endpermission

    @permission('delete-bulletin')
    <button class="btn btn-sm btn-icon editor-delete"><i class="ti ti-trash"></i></button>
    @endpermission
</div>

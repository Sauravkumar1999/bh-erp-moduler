<div class="d-inline-block text-nowrap">
    @permission('update-productcompany')
    <button class="btn btn-sm btn-icon editor-edit"><i class="ti ti-edit" data-url="{{ $data->contract() }}" data-status="{{ $data->status }}"></i></button>
    @endpermission

    @permission('delete-productcompany')
    <button class="btn btn-sm btn-icon editor-delete"><i class="ti ti-trash"></i></button>
    @endpermission
</div>
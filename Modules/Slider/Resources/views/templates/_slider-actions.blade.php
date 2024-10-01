<div class="d-inline-block text-nowrap">
    @permission('update-slider')
        <button class="btn btn-sm btn-icon editor-edit"
            onclick="window.location.href='{{ route('admin.slider.edit', $data) }}'"><i class="ti ti-edit"></i></button>
    @endpermission

    @permission('delete-slider')
        <button class="btn btn-sm btn-icon editor-delete" data-url="{{ $data->id }}"><i class="ti ti-trash"></i></button>
    @endpermission
</div>

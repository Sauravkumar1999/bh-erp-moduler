<div>
    <div class="modal DTED fade @if ($isOpen === true) show @endif"
        style="display: @if ($isOpen === true) block @else none @endif;" id="myModal" tabindex="-1"
        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Role Permissions</h5>
                    <button wire:click="closeModal" type="button" onclick="loading()" class="btn-close btn-raw"></button>
                </div>
                @if (isset($role))
                    <form class="form-horizontal" wire:submit.prevent="update">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <hr>
                                    <!-- Your modal content goes here -->
                                    {{-- do the template --}}
                                    @foreach ($perm_names as $name)
                                        <div class="mb-3 row">
                                            <label class="form-label col-3">
                                                {{ $name }}
                                            </label>

                                            <div class="checkbox col-3">
                                                <label for="select_all_{{ $name }}">
                                                <input id="select_all_{{ $name }}" value="{{ boolval(true) }}" wire:model="permission_containers.{{ $name }}" type="checkbox" autocomplete="off" class="form-check-input select_all_checkbox" onchange="selectPermissions(this, '{{ $name }}')"> Select All</label>
                                            </div>

                                            <div id="chk_list_{{ $name }}" class="col-6">
                                                @foreach ($data[$name] as $key => $item)
                                                    <div class="form-check ">
                                                        <input id="permission_{{ $item['id'] }}"
                                                            type="checkbox" class="form-check-input" value="{{ intval($item['id']) }}"
                                                            wire:model="existing_perm_ids.perm_{{ $item['id'] }}"
                                                            onchange="selectOnePermission(this, '{{ $name }}')"
                                                            >

                                                        <label for="permission_{{ $item['id'] }}"
                                                            class="form-check-label">
                                                            {{ $item['name'] }}
                                                        </label>

                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        <hr>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button wire:click="closeModal" onclick="loading()" type="button" class="btn btn-secondary"
                                data-dismiss="modal">Close</button>
                            <!-- Add Livewire method to handle modal dismissal -->
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                        <form>
                @endif
            </div>
        </div>
    </div>

</div>

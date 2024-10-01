<?php

namespace Modules\User\Http\Livewire\Auth;

use Livewire\Component;
use Livewire\WithFileUploads;
use Modules\Core\Http\Livewire\AlertTrait;
use Modules\User\Entities\User;
use Illuminate\Support\Facades\Hash;
use Modules\Media\Traits\MediaHandler;
use Modules\User\Entities\Permission;
use Modules\User\Entities\Role;

class EditRole extends Component
{
    use AlertTrait;
    public $isOpen = false;
    public Role $role;
    public $data;
    public $existing_perm_ids;
    public $perm_names = array();
    public $permission_containers = array();

    protected $listeners = ['openModal' => 'openModal', 'checkboxChecked' => 'checkboxChecked', 'checkboxUnChecked' => 'checkboxUnChecked', 'uncheckContainer' => 'uncheckContainer', 'checkContainer' => 'checkContainer'];

    public function render()
    {
        return view('user::livewire.auth.edit-role');
    }

    public function mount()
    {

        $this->isOpen = false;
    }

    // Method to open the modal
    public function openModal(Role $role)
    {
        $this->existing_perm_ids = $role->permissions->pluck('id')->mapWithKeys(function ($id) {
            return ['perm_' . $id => $id];
        })->toArray();

        //get all permission lists
        $permissions = Permission::all();
        $this->perm_names = array_unique(Permission::pluck('ltpm')->map(function ($perm) {
            return strtolower(substr(strrchr(rtrim($perm, '\\'), '\\'), 1));
        })->toArray());

        $this->data = $permissions->mapToGroups(function ($perm) {
            return [strtolower(substr(strrchr(rtrim($perm->ltpm, '\\'), '\\'), 1)) => ['name' => $perm->display_name, 'id' => $perm->id]];
        })->toArray();


        foreach ($this->data as $pname => $pvalues) {
            $psize = count($pvalues);
            $pallocated = 0;

            foreach ($pvalues as $key => $pvalue) {
                if(in_array($pvalue['id'], $this->existing_perm_ids)){
                    $pallocated += 1;
                }
            }

            if ($psize == $pallocated) {
                $this->permission_containers[$pname] = true;
            }else{
                $this->permission_containers[$pname] = false;
            }
        }

        // dd($this->perm_names, $this->data, $permissions, $this->existing_perm_ids, $this->permission_containers);


        $this->role = $role;
        $this->isOpen = true;
        $this->dispatchBrowserEvent('modal-loaded');
    }

    // Method to close the modal
    public function closeModal()
    {
        $this->isOpen = false;
        $this->dispatchBrowserEvent('modal-closed');
    }

    public function update()
    {


        $data = array_filter(array_values($this->existing_perm_ids));
        $trimmedArray = array_map(function($value) {
            return intval(trim($value));
        }, $data);


      // if (role()->isAbleTo('create-user-role')) {
            $this->role->syncPermissions($trimmedArray);
    //    }

        $this->closeModal();
        $this->showSuccessToast("Role Permission updated successfully !");
    }
    function checkboxChecked($id)
    {
        $this->existing_perm_ids['perm_' . $id] = trim($id);
    }
    function checkboxUnChecked($id)
    {
        $this->existing_perm_ids['perm_' . $id] = false;
    }

    function uncheckContainer($name)
    {
        $this->permission_containers[$name] = false;
    }

    function checkContainer($name)
    {
        $this->permission_containers[$name] = true;
    }
}

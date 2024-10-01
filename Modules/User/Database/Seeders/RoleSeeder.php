<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\User\Entities\Role;
use Modules\User\Entities\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $roles = [
            ['name' => 'developer', 'display_name' => 'Developer', 'description' => 'System developer'],
            ['name' => 'admin', 'display_name' => 'Admin', 'description' => 'System Admin'],
            ['name' => 'BA', 'display_name' => '지사대표(BA)', 'description' => '지사대표(BA)'],
            ['name' => 'BP', 'display_name' => '지사대표 (BP)', 'description' => '지사대표 (BP)'],
            ['name' => 'IBP', 'display_name' => '독립 지사대표 (IBP)', 'description' => '독립 지사대표 (IBP)'],
            ['name' => 'PMD', 'display_name' => '본부대표(PMD)', 'description' => '본부대표(PMD)'],
            ['name' => 'MD', 'display_name' => '본부대표 (MD)', 'description' => '본부대표 (MD)'],
            ['name' => 'EMD', 'display_name' => '수석본부대표 (EMD)', 'description' => '수석본부대표 (EMD)'],
            ['name' => 'HO', 'display_name' => '본사 스텝 (HO)', 'description' => '본사 스텝 (HO)'],
            ['name' => 'Chief', 'display_name' => '최고책임자(Chief)', 'description' => '최고책임자(Chief)'],
        ];
        $permissions = Permission::pluck('id', 'id')->all();

        foreach ($roles as $role) {
            if(!Role::where('name', $role['name'])->exists()) {
                $createdRole = Role::create($role);
                if ($role['name'] === 'developer') {
                    $createdRole->permissions()->attach($permissions);
                }
            }
        }
    }
}

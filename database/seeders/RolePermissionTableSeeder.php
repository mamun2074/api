<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use KawsarJoy\RolePermission\Models\Role;
use KawsarJoy\RolePermission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //users
        $usersP = Permission::create(['name' => 'users_label', 'description' => 'Users', 'parent_id' => NULL, 'order' => 1]);
        Permission::create(['name' => 'users.index', 'description' => 'List', 'parent_id' => $usersP->id, 'order' => 1]);
        Permission::create(['name' => 'users.show', 'description' => 'Show', 'parent_id' => $usersP->id, 'order' => 1]);
        


        //create Role and assign permission to first admin
        $user = User::orderBy('id', 'asc')->first();
        $saRole = Role::updateOrCreate(['name' => 'super-admin'], ['name' => 'super-admin', 'description' => 'Super Admin']);
        $user->roles()->sync([$saRole->id]);
        $saRole->permissions()->sync(Permission::all()->pluck('id')->toArray());
    }
}

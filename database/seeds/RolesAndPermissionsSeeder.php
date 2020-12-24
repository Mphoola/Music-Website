<?php

use App\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role as ModelsRole;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = ModelsRole::create(['guard_name' => 'admin', 'name' => 'admin']);
        $role = ModelsRole::create(['guard_name' => 'admin', 'name' => 'writer']);
        $role = ModelsRole::create(['guard_name' => 'admin', 'name' => 'superAdmn']);

        $permission = Permission::create(['guard_name' => 'admin', 'name' => 'see posts']);
        $permission = Permission::create(['guard_name' => 'admin', 'name' => 'publish blog post']);
        $permission = Permission::create(['guard_name' => 'admin', 'name' => 'delete blog post']);
        $permission = Permission::create(['guard_name' => 'admin', 'name' => 'edit blog post']);
        $permission = Permission::create(['guard_name' => 'admin', 'name' => 'create blog post']);

        $permission = Permission::create(['guard_name' => 'admin', 'name' => 'see users']);
        $permission = Permission::create(['guard_name' => 'admin', 'name' => 'add new user']);
        $permission = Permission::create(['guard_name' => 'admin', 'name' => 'delete user']);

        $permission = Permission::create(['guard_name' => 'admin', 'name' => 'see admins']);
        $permission = Permission::create(['guard_name' => 'admin', 'name' => 'add new admin']);
        $permission = Permission::create(['guard_name' => 'admin', 'name' => 'delete admin']);

        $permission = Permission::create(['guard_name' => 'admin', 'name' => 'see permissions']);
        $permission = Permission::create(['guard_name' => 'admin', 'name' => 'add permissions']);
        $permission = Permission::create(['guard_name' => 'admin', 'name' => 'edit permissions']);
        $permission = Permission::create(['guard_name' => 'admin', 'name' => 'revolke permissions']);

        $permission = Permission::create(['guard_name' => 'admin', 'name' => 'see settings']);
        $permission = Permission::create(['guard_name' => 'admin', 'name' => 'change settings']);

        $permission = Permission::create(['guard_name' => 'admin', 'name' => 'add songs']);
        $permission = Permission::create(['guard_name' => 'admin', 'name' => 'edit songs']);

        $permission = Permission::create(['guard_name' => 'admin', 'name' => 'edit beats']);
        $permission = Permission::create(['guard_name' => 'admin', 'name' => 'add beats']);

        $permission = Permission::create(['guard_name' => 'admin', 'name' => 'add video']);
        $permission = Permission::create(['guard_name' => 'admin', 'name' => 'delete video']);
        $permission = Permission::create(['guard_name' => 'admin', 'name' => 'approve video']);

        $permission = Permission::create(['guard_name' => 'admin', 'name' => 'create category']);
        $permission = Permission::create(['guard_name' => 'admin', 'name' => 'edit category']);
        $permission = Permission::create(['guard_name' => 'admin', 'name' => 'delete category']);

        $permission = Permission::create(['guard_name' => 'admin', 'name' => 'create advert']);
        $permission = Permission::create(['guard_name' => 'admin', 'name' => 'delete advert']);

        $permission = Permission::create(['guard_name' => 'admin', 'name' => 'see sales']);
        $permission = Permission::create(['guard_name' => 'admin', 'name' => 'delete old sales']);


        $permission = Permission::create(['guard_name' => 'admin', 'name' => 'see logs']);
        $permission = Permission::create(['guard_name' => 'admin', 'name' => 'clear logs']);

        $a = Permission::all();
        Admin::where('email', 'promisemphoola2@gmail.com')->firstOrFail()->syncPermissions($a);
        
    }
}

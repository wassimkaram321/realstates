<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::findOrCreate('group_permission');
        Permission::findOrCreate('roles_permission');
        Permission::findOrCreate('city_permission');
        Permission::findOrCreate('user_permission');
        Permission::findOrCreate('country_permission');
        Permission::findOrCreate('state_permission');
        Permission::findOrCreate('category_permission');
        Permission::findOrCreate('subcategory_permission');
        Permission::findOrCreate('childcategory_permission');

        

        // // this can be done as separate statements
        // Role::findOrCreate('customer');

        $role = Role::findOrCreate('Admin');

        $role->givePermissionTo(Permission::all());
    
    }
}

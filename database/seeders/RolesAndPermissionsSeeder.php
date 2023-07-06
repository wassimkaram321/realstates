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

        // Permission::findOrCreate('group_permission');
        // Permission::findOrCreate('roles_permission');
        // Permission::findOrCreate('city_permission');
        // Permission::findOrCreate('user_permission');
        // Permission::findOrCreate('country_permission');
        // Permission::findOrCreate('state_permission');
        // Permission::findOrCreate('category_permission');
        // Permission::findOrCreate('subcategory_permission');
        // Permission::findOrCreate('childcategory_permission');
        Permission::findOrCreate('Category.view');
        Permission::findOrCreate('Category.create');
        Permission::findOrCreate('Category.update');
        Permission::findOrCreate('Category.delete');
        Permission::findOrCreate('Sub Category.view');
        Permission::findOrCreate('Sub Category.create');
        Permission::findOrCreate('Sub Category.update');
        Permission::findOrCreate('Sub Category.delete');
        Permission::findOrCreate('Partial Category.view');
        Permission::findOrCreate('Partial Category.create');
        Permission::findOrCreate('Partial Category.update');
        Permission::findOrCreate('Partial Category.delete');
        Permission::findOrCreate('Company.view');
        Permission::findOrCreate('Company.create');
        Permission::findOrCreate('Company.update');
        Permission::findOrCreate('Company.delete');
        Permission::findOrCreate('Tag.view');
        Permission::findOrCreate('Tag.create');
        Permission::findOrCreate('Tag.update');
        Permission::findOrCreate('Tag.delete');
        Permission::findOrCreate('City.view');
        Permission::findOrCreate('City.create');
        Permission::findOrCreate('City.update');
        Permission::findOrCreate('City.delete');
        Permission::findOrCreate('State.view');
        Permission::findOrCreate('State.create');
        Permission::findOrCreate('State.update');
        Permission::findOrCreate('State.delete');
        Permission::findOrCreate('Role.view');
        Permission::findOrCreate('Role.create');
        Permission::findOrCreate('Role.update');
        Permission::findOrCreate('Role.delete');
        Permission::findOrCreate('Users.view');
        Permission::findOrCreate('Users.create');
        Permission::findOrCreate('Users.update');
        Permission::findOrCreate('Users.delete');
        Permission::findOrCreate('Attributes.view');
        Permission::findOrCreate('Attributes.create');
        Permission::findOrCreate('Attributes.update');
        Permission::findOrCreate('Attributes.delete');
        Permission::findOrCreate('Realestates.view');
        Permission::findOrCreate('Realestates.create');
        Permission::findOrCreate('Realestates.update');
        Permission::findOrCreate('Realestates.delete');
        Permission::findOrCreate('Ads.view');
        Permission::findOrCreate('Ads.create');
        Permission::findOrCreate('Ads.update');
        Permission::findOrCreate('Ads.delete');
        Permission::findOrCreate('Notifications.view');
        Permission::findOrCreate('Notifications.create');
        Permission::findOrCreate('Notifications.update');
        Permission::findOrCreate('Notifications.delete');


        // // this can be done as separate statements
        // Role::findOrCreate('customer');

        $role = Role::findOrCreate('Admin');

        $role->givePermissionTo(Permission::all());

    }
}

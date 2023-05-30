<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = new User();
        $user->name = 'Admin';
        $user->email = 'admin@peaklink.com';
        $user->password = Hash::make('password');
        $role = Role::findByName('Admin');
        $user->role_id = $role->id;
        $user->assignRole($role);
        $user->save();

    }
}

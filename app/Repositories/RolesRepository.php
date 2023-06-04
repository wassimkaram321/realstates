<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

//use Your Model

/**
 * Class userRepository.
 */
class RolesRepository
{
    /**
     * @return string
     *  Return the model
     */
    protected $role;

    public function __construct(Role $role)
    {
        $this->role = $role;
    }
    public function all()
    {
        # code...
        return $this->role->get(['id','name']);
    }
    public function permissions()
    {
        # code...
        return Permission::all();
    }
    public function find($id)
    {
        $user = Role::with('permissions')->whereid($id)->get();
        return $user;
    }
    public function create($request)
    {
        $role = Role::find($request->role_id);
        $permissions = $role->permissions;
        $role->revokePermissionTo($permissions);
        $permissions = $request->permissions;
        foreach($permissions as $permission){
            $this->add_permission_to_role($request->role_id,$permission['permission']);
        }
    }
    public function add_permission_to_role($id,$permission)
    {
        # code...
        Permission::findOrCreate($permission);
        $role = Role::find($id);
        $role->givePermissionTo($permission);

    }
    public function revoke_permission($id,$permission)
    {
        # code...
        $permission_name = Permission::wherename($permission)->get()->first();
        $role = Role::find($id);
        return $role->revokePermissionTo($permission_name->name);

    }
    public function remove_permission($id)
    {
        # code...
        return Permission::find($id)->delete();


    }


    public function rules()
    {
        # code...
        return [

        ];
    }
    public function rules_update()
    {
        # code...
        return [

        ];
    }
}

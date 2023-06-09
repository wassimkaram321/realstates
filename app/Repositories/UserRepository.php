<?php

namespace App\Repositories;

use App\Models\Realstate;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use InvalidArgumentException;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use Mockery\Expectation;
use PhpParser\Node\Expr\Throw_;
use Spatie\Permission\Models\Role;

//use Your Model

/**
 * Class userRepository.
 */
class UserRepository
{
    /**
     * @return string
     *  Return the model
     */
    protected $user;

    public function __construct(User $user )
    {
        $this->user = $user;
    }
    public function all()
    {
        # code...
        return $this->user->get();
    }
    public function find($id)
    {
        $user = $this->user->whereid($id)->get();
        return $user;
    }
    public function create(array $data)
    {
        # code...

        if (isset($data['image'])) {

            $file_extension = $data['image']->getClientOriginalExtension();
            $file_name = time() . '.' . $file_extension;
            $path = 'images/users';
            $data['image']->move($path, $file_name);
            $data['image'] = $file_name;
        }

        $role = Role::find($data['role_id']);
        $data['password'] =  Hash::make($data['password']);
        $user =  $this->user->create($data);
        $user->assignRole($role->name);
        return $user;
    }
    public function update($id,array $data)
    {
        $user = $this->user->find($id);
        $data['password'] =  Hash::make($data['password']);
        if (isset($data['image'])) {
            $file_extension = $data['image']->getClientOriginalExtension();
            $file_name = time() . '.' . $file_extension;
            $path = 'images/users';
            $data['image']->move($path, $file_name);
            $data['image'] = $file_name;
        }
        return $user->update($data);
    }
    public function delete($id)
    {
        return $this->user->destroy($id);
    }
    public function change_status($status , $user_id)
    {
        # code...
        $user = $this->user->whereid($user_id)->update([
            'status'=>$status
        ]);
        return $user;

    }
    public function user_permission($id)
    {
        # code...
        $user = $this->user->find($id);
        $role = Role::find($user->role_id);
        $permissions = $role->permissions()->get();
        return $permissions;
    }

    public function changeEnableNotification($request)
    {
        $user = $this->user->findOrFail(Auth::id());
        $user->enable_notification = $request->enable_notification;
        $user->save();
        return $user;
    }

    public function addRealEstateToFavorite($request)
    {
        $realestate = Realstate::where('id', $request->realestate_id)->first();
        if ($realestate->ava == 1) {
            $user = $this->user->findOrFail(Auth::id());
            $user->favoriteRealEstates()->attach($request->realestate_id);
            return $user;
        } else {
            throw new InvalidArgumentException();
        }
    }

    public function removeRealEstateToFavorite($request)
    {
        $user = $this->user->findOrFail(Auth::id());
        $user->favoriteRealEstates()->detach($request->realestate_id);
        return $user;
    }

    public function getFavoriteRealEstate($request)
    {
        $user = $this->user->findOrFail(Auth::id());
        $userFavoriteRealestatesIds = $user->favoriteRealEstates()->pluck('realestate_id');
        $favoriteRealestates = Realstate::whereIn('id', $userFavoriteRealestatesIds)->app();
        return $favoriteRealestates;
    }

    public function rules()
    {
        # code...
        return [
            'password' => 'required',
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'image' => 'nullable',
            'role_id' => 'required',
        ];
    }
    public function rules_update()
    {
        # code...
        return [
            'password' => '',
            'name' => 'required',
            'email' => 'required',
            'phone' => '',
            'image' => 'nullable',
            'role_id' => 'nullable',
        ];
    }
}

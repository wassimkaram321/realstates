<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
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

    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function all()
    {
        # code...
        return $this->user->all();
    }
    public function find($id)
    {
        $user = User::whereid($id)->get();
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
       
        $data['password'] =  Hash::make($data['password']);
        return $this->user->create($data);
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
        $user = User::whereid($user_id)->update([
            'status'=>$status
        ]);
        return $user;

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
        ];
    }
}

<?php

namespace App\Repositories;

use App\Models\Company;
use Illuminate\Support\Facades\Hash;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class userRepository.
 */
class CompanyRepository
{
    /**
     * @return string
     *  Return the model
     */
    protected $company;

    public function __construct(Company $company)
    {
        $this->company = $company;
    }
    public function all()
    {
        # code...
        return $this->company->all();
    }
    public function find($id)
    {
        $user = Company::whereid($id)->get();
        return $user;
    }
    public function create(array $data)
    {
        # code...
        $data['password'] =  Hash::make($data['password']);
        if (isset($data['image'])) {
            $file_extension = $data['image']->getClientOriginalExtension();
            $file_name = time() . '.' . $file_extension;
            $path = 'images/companies';
            $data['image']->move($path, $file_name);
            $data['image'] = $file_name;
        }
        return $this->company->create($data);
    }
    public function update($id,array $data)
    {
        $user = $this->company->find($id);
        $data['password'] =  Hash::make($data['password']);
        if (isset($data['image'])) {
            $file_extension = $data['image']->getClientOriginalExtension();
            $file_name = time() . '.' . $file_extension;
            $path = 'images/companies';
            $data['image']->move($path, $file_name);
            $data['image'] = $file_name;
        }
        return $user->update($data);
    }
    public function delete($id)
    {
        return $this->company->destroy($id);
    }
    public function change_status($status , $user_id)
    {
        # code...
        $user = Company::whereid($user_id)->update([
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
            'phone' => 'required',
            'image' => 'nullable',
        ];
    }
}

<?php

namespace App\Repositories;

use App\Manager\FileManager;
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
        return $this->company->findOrFail($id);
    }
    public function create($request)
    {
        $request['password'] =  Hash::make($request['password']);
        if(isset($request['image']))
            $request['image'] = FileManager::addFile($request['image'],'images/companies');
        return $this->company->create($request->all());
    }
    public function update($request)
    {
        $user = $this->company->findOrFail($request->id);

        $request['password'] =  Hash::make($request['password']);
        if(isset($request['image']))
            $request['image'] = FileManager::addFile($request['image'],'images/companies');
        $user->update($request->all());
        return $user;
    }
    public function delete($request)
    {
        return $this->company->destroy($request->id);
    }
    public function changeStatus($request)
    {
        $user = $this->company->findOrFail($request->id);
        $user->update(['status'=>$request->status]);
        return $user;

    }

}

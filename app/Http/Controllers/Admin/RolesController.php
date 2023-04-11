<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\RolesRepository;
use Exception;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;

class RolesController extends Controller
{
    //
    use ResponseTrait;
    protected $repository;
    

    public function __construct(RolesRepository $repository)
    {
        $this->repository = $repository;
       
    }
    public function index(Request $request)
    {
        # code...
        try{
            $data = $this->repository->all();
            return $this->success('success',$data);
        }
        catch(Exception $ex){
            return $this->error();
           
        }
    }
    public function show(Request $request)
    {
        //
        try{
            $data = $this->repository->find($request->id);
            return $this->success('success',$data);
        }
        catch(Exception $ex){
            return $this->error();
        }
    }
    public function add_permission_to_role(Request $request)
    {
        # code...
        try{
            $data = $this->repository->add_permission_to_role($request->id,$request->permission);
            return $this->success('success',$data);
        }
        catch(Exception $ex){
            return $this->error();
        }

    }
    public function revoke_permission(Request $request)
    {
        # code...
        try{
            $data = $this->repository->revoke_permission($request->id,$request->permission);
            return $this->success('success',$data);
        }
        catch(Exception $ex){
            return $this->error();
        }

    }
    public function remove_permission(Request $request)
    {
        # code...
        try{
            $data = $this->repository->remove_permission($request->id);
            return $this->success('success',[]);
        }
        catch(Exception $ex){
            return $this->error();
        }

    }
}

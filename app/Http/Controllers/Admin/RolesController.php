<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\AuthorizationHandler;
use App\Repositories\RolesRepository;
use Exception;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    //

    protected $repository;
    protected $authorizationHandler;


    public function __construct(RolesRepository $repository , AuthorizationHandler $authorizationHandler )
    {
        $this->repository = $repository;
        $this->authorizationHandler = $authorizationHandler;

    }
    public function index(Request $request)
    {
        # code...
        $this->authorize('Role');
        try{
            $data = $this->repository->all();
            return $this->success('success',$data);
        }
        catch(Exception $ex){
            return $this->error();
        }
    }
    public function permissions(Request $request)
    {
        # code...
        try{
            $data = $this->repository->permissions();
            return $this->success('success',$data);
        }
        catch(Exception $ex){
            return $this->error();
        }
    }
    public function create(Request $request)
    {
        # code...
        $this->authorize('Role');
        try{
            $this->repository->create($request);
            return $this->success('success',[]);
        }
        catch(Exception $ex){
            return $this->error();

        }
    }
    public function show(Request $request)
    {
        //
        $this->authorize('Role');
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
        $this->authorize('Role');
        try{
            $this->repository->add_permission_to_role($request->id,$request->permission);
            return $this->success('success',[]);
        }
        catch(Exception $ex){
            return $this->error();
        }

    }
    public function revoke_permission(Request $request)
    {
        # code...
        $this->authorize('Role');
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
        $this->authorize('Role');
        try{
            $data = $this->repository->remove_permission($request->id);
            return $this->success('success',[]);
        }
        catch(Exception $ex){
            return $this->error();
        }

    }
}

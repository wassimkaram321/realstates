<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

use Exception;

class UserController extends Controller
{
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $repository;
    

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
       
    }
    public function index()
    {
        //
        try{
            $users = $this->repository->all();
            return $this->success('success',UserResource::collection($users));
        }
        catch(Exception $ex){
            return $this->error();
           
        }
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try{
            $data = $this->validate($request,$this->repository->rules());
            $this->repository->create($data);
            return $this->success('success',[]);
        }
        catch(Exception $ex){
            // return $this->error();
            return $ex->getMessage();
        }
       
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
        try{
            $data = $this->repository->find($request->id);
            return $this->success('success',UserResource::collection($data));
        }
        catch(Exception $ex){
            return $this->error();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
        return view('admin.users.edit',compact('user'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        
        try{
             $data = $this->validate($request, $this->repository->rules_update());
            $this->repository->update($request->id, $data);
            return $this->success('success', []);
        }
        catch(Exception $ex){
            return $this->error();
        }
       
     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function change_status(Request $request)
    {
        # code...
        try{
            $this->repository->change_status($request->status,$request->id);
            return $this->success('success',[]);
        }
        catch(Exception $ex){
            return $this->error();
            
        }
        
    }
    public function user_permission(Request $request)
    {
        # code...
        try{
           $data= $this->repository->user_permission($request->id);
            return $this->success('success',$data);
        }
        catch(Exception $ex){
            return $this->error();
            
        }
    }
    public function destroy(Request $request)
    {
        //
        try{
            $id = $request->id;
            $this->repository->delete($id);
            return $this->success('success',[]);
        }
        catch(Exception $ex){
            return $this->error();
        }
       
       

    }
}

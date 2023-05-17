<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\RealstateResource;
use App\Models\City;
use App\Models\Realstate;
use App\Models\User;
use App\Repositories\RealstateRepository;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use Exception;
class RealstateController extends Controller
{
    use ResponseTrait;
    protected $repository;
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(RealstateRepository $repository)
    {
        $this->repository = $repository;
    }
    public function index()
    {
        //
        try{
            $data = $this->repository->all();
            return $this->success('success',$data);
        }
        catch(Exception $ex){
            // return $this->error();
            return $ex->getMessage();
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
        try {
            $data = $this->validate($request, $this->repository->rules());
           
            // $user_id = $request->user()->id();
           
            $this->repository->create($data,null);
            return $this->success('success', $data);
            // return $this->success('success', RealstateResource::collection($data));
        } catch (Exception $ex) {
            // return $this->error();
            return $ex->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Realstate  $realstate
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
        try{
            $data = $this->repository->find($request->id);
            return $this->success('success',RealstateResource::collection($data));
        }
        catch(Exception $ex){
            // return $this->error();
            return $ex->getMessage();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Realstate  $realstate
     * @return \Illuminate\Http\Response
     */
    public function edit(Realstate $realstate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Realstate  $realstate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Realstate $realstate)
    {
        //
        try {
            $data = $this->validate($request, $this->repository->rules_update());
            $this->repository->update($request->id, $data,$request->user()->id);
            // return $this->success('success', RealstateResource::collection($data));
            return $this->success('success', $data);
        } 
        catch (Exception $ex) {
            // return $this->error();
            return $ex->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Realstate  $realstate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        try {
            $id = $request->id;
            $this->repository->delete($id);
            return $this->success('success', []);
        } catch (Exception $ex) {
            // return $this->error();
            return $ex->getMessage();
        }
    }
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
    public function get_realstates_by_category(Request $request)
    {
        # code...
        try{
            $data = $this->validate($request, $this->repository->rules_update());
           
            $data = $this->repository->get_realstates_by_category($data);
            return $this->success('success',RealstateResource::collection($data));
        }
        catch(Exception $ex){
            return $this->error();
           
        }
    }
    public function get_user_real_estates(Request $request)
    {
        # code...
        try{
            // $user_id = $request->user()->id;
            $user = User::findOrFail($request->user()->id);
            $data =$this->repository->get_user_realstates($user->id);
        
            return $this->success('success',RealstateResource::collection($data));
        }
        catch(Exception $ex){
            return $this->error();
        }
    
    }
    public function get_real_estates_by_city(Request $request)
    {
        # code...
        try{
            // $user_id = $request->user()->id;
            $city = City::findOrFail($request->id);
            $data =$this->repository->get_real_estates_by_city($city);
            return $this->success('success',RealstateResource::collection($data));
        }
        catch(Exception $ex){
            return $this->error();
        }
    
    }
    public function get_real_estates_by_state(Request $request)
    {
        # code...
        try{
            
            $data =$this->repository->get_real_estates_by_state($request->id);
            return $this->success('success',RealstateResource::collection($data));
        }
        catch(Exception $ex){
            return $this->error();
        }
    
    }
    public function nearby_real_estates(Request $request)
    {
        # code...
        try{
            
            $data =$this->repository->nearby_real_estates($request->lat,$request->long);
            return $this->success('success',RealstateResource::collection($data));
        }
        catch(Exception $ex){
            return $this->error();
        }
        
    
    }
}

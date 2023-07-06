<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\VehicleCategoryResource;
use App\Models\VehicleCategory;
use App\Repositories\VehicleCategoryRepository;
use Illuminate\Http\Request;

class VehicleCategoryController extends Controller
{
    protected $repository;

    public function __construct(VehicleCategoryRepository $repository)
    {
        $this->repository = $repository;
       
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $this->repository->all($request);
        return $this->success('success', $data);
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
        $data = $this->repository->create($request);

        return $this->success('success',$data);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VehicleCategory  $VehicleCategory
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $data = $this->repository->find($request->id);
        return $this->success('success',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VehicleCategory  $VehicleCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(VehicleCategory $VehicleCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VehicleCategory  $VehicleCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VehicleCategory $VehicleCategory)
    {
        $data = $this->repository->update($request);
        // return $data;
        return $this->success('success',$data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VehicleCategory  $VehicleCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $data = $this->repository->delete($request->id);
        return $this->success('success',[]);
    }
    // public function updata_status(Request $request)
    // {
    //     $data = $this->repository->updata_status($request);
    //     return $this->success('success',[]);
    // }
    
}


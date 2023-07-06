<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VehicleRequest;
use App\Http\Resources\VehicleResource;
use App\Models\Vehicle;
use App\Repositories\VehicleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VehicleController extends Controller
{
    protected $repository;

    public function __construct(VehicleRepository $repository)
    {
        $this->repository     = $repository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(VehicleRequest $request)
    {
        $data = $this->repository->all($request);
        return $this->success('success', VehicleResource::collection($data));
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
    public function store(VehicleRequest $request)
    {
        $data = $this->repository->create($request);

        return $this->success('success', VehicleResource::make($data));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(VehicleRequest $request)
    {
        $data = $this->repository->find($request);
        return $this->success('success', VehicleResource::make($data));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicle $vehicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(VehicleRequest $request, Vehicle $vehicle)
    {
        if (Auth::user()->role_id != 1){
            return $this->error_message('only admin can update.');
        }
        $data = $this->repository->update($request);
        return $this->success('success', VehicleResource::make($data));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(VehicleRequest $request)
    {
        $data = $this->repository->delete($request->id);
        return $this->success('success', []);
    }

    public function create_image(VehicleRequest $request)
    {
        $this->repository->create_image($request);
        return $this->success('success', []);
    }

    public function change_status(VehicleRequest $request)
    {
        $this->repository->change_status($request->status, $request->id);
        return $this->success('success', []);
    }

    public function change_feature(VehicleRequest $request)
    {
        $this->repository->change_feature($request->feature, $request->id);
        return $this->success('success', []);
    }

    public function change_recommended(VehicleRequest $request)
    {
        $this->repository->change_recommended($request->recommended, $request->id);
        return $this->success('success', []);
    }

    public function get_recommended(VehicleRequest $request)
    {
        $data = $this->repository->get_recommended($request);
        return $this->success('success', $data);
    }

    public function get_feature(VehicleRequest $request)
    {
        $data = $this->repository->get_feature($request);
        return $this->success('success', $data);
    }

    public function get_user_vehicles(VehicleRequest $request)
    {
        $data = $this->repository->get_user_vehicles($request);
        return $this->success('success', $data);
    }

    public function nearby_vehicle(VehicleRequest $request)
    {
        $data = $this->repository->nearby_vehicle($request->lat, $request->long);
        return $this->success('success', $data);
    }
}

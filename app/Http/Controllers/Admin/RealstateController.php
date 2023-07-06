<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RealEstateRequest;
use App\Http\Resources\RealstateResource;
use App\Models\City;
use App\Models\Realstate;
use App\Models\User;
use App\Repositories\RealstateRepository;
use App\Repositories\AuthorizationHandler;
use Exception;
use Illuminate\Support\Facades\App;

class RealstateController extends Controller
{

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
    public function index(RealEstateRequest $request)
    {

        $data = $this->repository->all($request);
        return $this->success('success', RealstateResource::collection($data));
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
    public function store(RealEstateRequest $request)
    {
        $this->checkOwner($request->id);
        $data = $this->repository->create($request);
        return $this->success('success', RealstateResource::make($data));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Realstate  $realstate
     * @return \Illuminate\Http\Response
     */
    public function show(RealEstateRequest $request)
    {
        $this->checkOwner($request->id);
        $data = $this->repository->find($request);
        return $this->success('success', RealstateResource::make($data));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Realstate  $realstate
     * @return \Illuminate\Http\Response
     */
    public function edit(RealEstateRequest $realstate)
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
    public function update(RealEstateRequest $request, Realstate $realstate)
    {
        $this->checkOwner($request->id);
        $data = $this->repository->update($request);
        return $this->success('success', RealstateResource::make($data));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Realstate  $realstate
     * @return \Illuminate\Http\Response
     */
    public function destroy(RealEstateRequest $request)
    {
        $this->repository->delete($request);
        return $this->success('success', []);
    }
    public function create_image(RealEstateRequest $request)
    {
        $this->repository->create_image($request);
        return $this->success('success', []);
    }

    public function update_image(RealEstateRequest $request)
    {
        $this->repository->update_image($request);
        return $this->success('success', []);
    }
    public function change_status(RealEstateRequest $request)
    {
        $this->checkOwner($request->id);
        $this->repository->change_status($request->status, $request->id);
        return $this->success('success', []);

    }
    public function change_feature(RealEstateRequest $request)
    {
        $this->repository->change_feature($request->feature, $request->id);
        return $this->success('success', []);
    }
    //Recommended
    public function change_recommended(RealEstateRequest $request)
    {
        $this->repository->change_recommended($request->recommended, $request->id);
        return $this->success('success', []);
    }
    public function get_recommended()
    {
        $data = $this->repository->get_recommended();
        return $this->success('success', RealstateResource::collection($data));

    }


    public function get_realstates_by_category(RealEstateRequest $request)
    {

        $data = $this->repository->get_realstates_by_category($request);
        return $this->success('success', RealstateResource::collection($data));
    }
    public function get_user_real_estates(RealEstateRequest $request)
    {


        $user = User::findOrFail($request->user()->id);
        $data = $this->repository->get_user_realstates($user->id);
        return $this->success('success', RealstateResource::collection($data));
    }
    public function get_real_estates_by_city(RealEstateRequest $request)
    {
        $city = City::findOrFail($request->id);
        $data = $this->repository->get_real_estates_by_city($city);
        return $this->success('success', RealstateResource::collection($data));
    }
    public function get_real_estates_by_state(RealEstateRequest $request)
    {
        $data = $this->repository->get_real_estates_by_state($request->id);
        return $this->success('success', RealstateResource::collection($data));
    }
    public function nearby_real_estates(RealEstateRequest $request)
    {
        $data = $this->repository->nearby_real_estates($request->lat, $request->long);
        return $this->success('success', RealstateResource::collection($data));
    }
    public function get_feature()
    {
        $data = $this->repository->get_feature();
        return $this->success('success', RealstateResource::collection($data));
    }
    private function checkOwner($real_estate_id)
    {
        $user = auth()->user();
        $user = User::findOrFail($user->id);
        if($user->role_id != 1){
            if(!$user->real_states()->where('id', $real_estate_id)->exists()){
                throw new Exception('Not Authorized');
            }
        }
    }
}

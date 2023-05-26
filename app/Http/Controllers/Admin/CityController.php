<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CityRequest;
use App\Http\Resources\CityResource;
use App\Models\City;
use App\Repositories\AuthorizationHandler;
use App\Repositories\CityRepository;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $repository;
    protected $authorizationHandler;
    public function __construct(CityRepository $repository , AuthorizationHandler $authorizationHandler)
    {
        $this->repository = $repository;
        $this->authorizationHandler = $authorizationHandler;
    }
    public function index()
    {
        //
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
    public function store(CityRequest $request)
    {
        $this->repository->create($request);
        return $this->success('success',[]);

        // $rules = array(
        //     'name_en'    => 'required',
        //     'state_id'   => 'required',
        // );

        // $validator = validator($request->all(), $rules);
        // if ($validator->fails()) {
        //     return response()->json([
        //         'error'          => 'true',
        //         'status_message' => $validator->messages()->first()
        //     ]);
        // }

        // $city = new City;

        // $array1 = $request->name_en;
        // $array2 = $request->name_ar;

        // for($i = 0;  $i< count($array1);$i++)
        // {
        //     for($j = 0;  $j< count($array2); $j++)
        //     {
        //         $city->setTranslation('name', 'en', $array1[$i]);
        //         $city->setTranslation('name', 'ar', $array2[$j]);
        //         $city->state_id = $request->input('state_id');
        //         $city->save();
        //     }
        // }
        // return response()->json(['error' => 'false', "message" => "success", 'data' => []]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(CityRequest $request)
    {

        $cities = $this->repository->find($request);
        return $this->success('success',CityResource::collection($cities));
        // $rules = array(
        //     'lang'         => 'required',
        // );

        // $validator = validator($request->all(), $rules);
        // if ($validator->fails()) {
        //     return response()->json([
        //         'error'          => 'true',
        //         'status_message' => $validator->messages()->first()
        //     ]);
        // }
        // $citys = City::get();
        // if ($request->lang == 'ar') {
        //     foreach ($citys as $city) {
        //         $data[] = array(
        //             'id'           => $city->id,
        //             'name'         => $city->getTranslation('name', 'ar') ?? '',
        //             'state'        => $city->state->getTranslation('name', 'ar') ?? '',
        //         );
        //     }
        //     return response()->json(['error' => 'false', "message" => "success", 'data' => $data]);
        // } else {
        //     foreach ($citys as $city) {
        //         $data[] = array(
        //             'id'           => $city->id,
        //             'name'         => $city->getTranslation('name', 'en') ?? '',
        //             'state'        => $city->state->getTranslation('name', 'en') ?? '',
        //         );
        //     }
        //     return response()->json(['error' => 'false', "message" => "success", 'data' => $data]);
        // }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(CityRequest $request)
    {
        $this->repository->update($request);
        return $this->success('success',[]);
        // $rules = array(
        //     'id'         => 'required',
        // );

        // $validator = validator($request->all(), $rules);
        // if ($validator->fails()) {
        //     return response()->json([
        //         'error'          => 'true',
        //         'status_message' => $validator->messages()->first()
        //     ]);
        // }
        // $city = City::find($request->id);

        // if ($request->input('name_en') != null) {
        //     $city->setTranslation('name', 'en', $request->input('name_en'));
        // }
        // if ($request->input('name_ar') != null) {
        //     $city->setTranslation('name', 'ar', $request->input('name_ar'));
        // }
        // if ($request->input('state_id') != null) {
        //     $city->state_id = $request->state_id;
        // }
        // $city->save();

        // return response()->json(['error' => 'false', "message" => "success", 'data' => []]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(CityRequest $request)
    {
        $this->repository->delete($request);
        return $this->success('success',[]);
        // $rules = array(
        //     'id'         => 'required',
        // );

        // $validator = validator($request->all(), $rules);
        // if ($validator->fails()) {
        //     return response()->json([
        //         'error'          => 'true',
        //         'status_message' => $validator->messages()->first()
        //     ]);
        // }
        // $City = City::find($request->id);
        // $City->delete();
        // return response()->json(['error' => 'false', "message" => "success", 'data' => []]);
    }
}

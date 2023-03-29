<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
    public function store(Request $request)
    {
        $rules = array(
            'name_en'    => 'required',
            'state_id'   => 'required',
        );

        $validator = validator($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'error'          => 'true',
                'status_message' => $validator->messages()->first()
            ]);
        }
       
        $city = new City;
        
        $array1 = $request->name_en;
        $array2 = $request->name_ar;

        for($i = 0;  $i< count($array1);$i++)
        {
            for($j = 0;  $j< count($array2); $j++)
            {
                $city->setTranslation('name', 'en', $array1[$i]);
                $city->setTranslation('name', 'ar', $array2[$j]);
                $city->state_id = $request->input('state_id');
                $city->save();
            }
        }
        return response()->json(['error' => 'false', "message" => "success", 'data' => []]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $rules = array(
            'lang'         => 'required',
        );

        $validator = validator($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'error'          => 'true',
                'status_message' => $validator->messages()->first()
            ]);
        }
        $citys = City::get();
        if ($request->lang == 'ar') {
            foreach ($citys as $city) {
                $data[] = array(
                    'id'           => $city->id,
                    'name'         => $city->getTranslation('name', 'ar') ?? '',
                    'state'        => $city->state->getTranslation('name', 'ar') ?? '',
                );
            }
            return response()->json(['error' => 'false', "message" => "success", 'data' => $data]);
        } else {
            foreach ($citys as $city) {
                $data[] = array(
                    'id'           => $city->id,
                    'name'         => $city->getTranslation('name', 'en') ?? '',
                    'state'        => $city->state->getTranslation('name', 'en') ?? '',
                );
            }
            return response()->json(['error' => 'false', "message" => "success", 'data' => $data]);
        }
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
    public function update(Request $request, City $city)
    {
        $rules = array(
            'id'         => 'required',
        );

        $validator = validator($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'error'          => 'true',
                'status_message' => $validator->messages()->first()
            ]);
        }
        $city = City::find($request->id);

        if ($request->input('name_en') != null) {
            $city->setTranslation('name', 'en', $request->input('name_en'));
        }
        if ($request->input('name_ar') != null) {
            $city->setTranslation('name', 'ar', $request->input('name_ar'));
        }
        if ($request->input('state_id') != null) {
            $city->state_id = $request->state_id;
        }
        $city->save();

        return response()->json(['error' => 'false', "message" => "success", 'data' => []]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $rules = array(
            'id'         => 'required',
        );

        $validator = validator($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'error'          => 'true',
                'status_message' => $validator->messages()->first()
            ]);
        }
        $City = City::find($request->id);
        $City->delete();
        return response()->json(['error' => 'false', "message" => "success", 'data' => []]);
    }
}

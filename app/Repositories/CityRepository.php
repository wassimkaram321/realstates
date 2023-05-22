<?php

namespace App\Repositories;

use App\Manager\CityManager;
use App\Models\City;
use Illuminate\Support\Facades\App;

class CityRepository
{
    protected $city;
    protected $cityManager;

    public function __construct(City $city , CityManager $cityManager)
    {
        $this->city = $city;
        $this->cityManager = $cityManager;
    }

    // Add your methods here
    public function all($request)
    {

    }

    public function find($request)
    {
        App::setLocale($request->lang);
        return $this->city::all();
    }

    public function create($request)
    {   
        $request->merge(['name' => $request->name_en]);
        $city = $this->city::create($request->all());
        $this->cityManager->setTranslation($city,$request);
        return $city;
    }

    public function update($request)
    {
        $request->merge(['name' => $request->name_en]);
        $city = $this->city::findOrFail($request->id);
        $city->update($request->all());
        $this->cityManager->setTranslation($city,$request);
        return $city;
    }

    public function delete($request)
    {
        return $this->city::findOrFail($request->id)->delete();
    }

}
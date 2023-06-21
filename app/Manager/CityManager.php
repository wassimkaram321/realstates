<?php

namespace App\Manager;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\City;

class CityManager
{
    public static function setTranslation($city , $request){
        $list = $request->list;
        
           for ($j = 0; $j < count($list); $j++) {
               $city = new City; 
               $city->setTranslation('name', 'ar', $list[$j]['name_ar']);
               $city->setTranslation('name', 'en', $list[$j]['name_en']);
               $city->state_id = $request->input('state_id');
               $city->save();
           }
           return $city;
       }
}

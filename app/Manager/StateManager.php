<?php

namespace App\Manager;

use Illuminate\Foundation\Http\FormRequest;

class StateManager
{
    public static function setTranslation($city , $request){

        $city->setTranslation('name', 'en', $request['name_en']);
        if($request->has('name_ar'))
            $city->setTranslation('name', 'ar', $request['name_ar']);
        $city->save();
    }
}

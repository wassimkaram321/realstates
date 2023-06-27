<?php

namespace App\Manager;

use Illuminate\Foundation\Http\FormRequest;

class AttributeManager
{
    public static function setTranslation($attributes , $request){

        $attributes->setTranslation('title', 'en', $request['title']);
        // if($request->has('title_ar'))
            $attributes->setTranslation('title', 'ar', $request['title_ar']);
        $attributes->save();
    }
    public static function setValueTranslation($value , $request){

        $value->setTranslation('value', 'en', $request['value']);
        // if($request->has('title_ar'))
            $value->setTranslation('value', 'ar', $request['value_ar']);
        $value->save();
    }
}

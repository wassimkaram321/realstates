<?php

namespace App\Manager;

use Illuminate\Foundation\Http\FormRequest;

class AttributeManager
{
    public static function setTranslation($attributes , $request){

        $attributes->setTranslation('title', 'en', $request['title']);
        if($request->has('title_ar'))
            $attributes->setTranslation('title', 'ar', $request['title_ar']);
        $attributes->setTranslation('content', 'en', $request['content']);
        if($request->has('content_ar'))
            $attributes->setTranslation('content', 'ar', $request['content_ar']);
        $attributes->save();
    }
}

<?php

namespace App\Manager;

use Illuminate\Foundation\Http\FormRequest;

class AttributeManager
{
    public static function setTranslation($attributes , $request){

        $attributes->setTranslation('title', 'en', $request['title']);
        $attributes->setTranslation('title', 'ar', $request['title_ar']);
        $attributes->setTranslation('content', 'en', $request['content']);
        $attributes->setTranslation('content', 'ar', $request['content_ar']);
        $attributes->save();
    }
}

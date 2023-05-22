<?php

namespace App\Manager;

use Illuminate\Foundation\Http\FormRequest;

class TagManager
{
    public static function setTranslation($tag , $request){

        $tag->setTranslation('title', 'en', $request['title']);
        if($request->has('title_ar'))
            $tag->setTranslation('title', 'ar', $request['title_ar']);
        $tag->save();
    }
}

<?php

namespace App\Manager;

use Illuminate\Foundation\Http\FormRequest;

class RealEstateManager
{
    public static function setTranslation($real_state , $request){

        $real_state->setTranslation('name', 'en', $request['title']);
        $real_state->setTranslation('name', 'ar', $request['title_ar']);
        $real_state->setTranslation('description', 'en', $request['title']);
        $real_state->setTranslation('description_ar', 'ar', $request['title_ar']);
        $real_state->save();
    }
}

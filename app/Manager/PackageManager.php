<?php

namespace App\Manager;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Package;

class PackageManager
{
    public static function setTranslation($package, $request)
    {
        $package->setTranslation('name', 'ar', $request->name_ar);
        $package->setTranslation('name', 'en', $request->name_en);
        $package->setTranslation('description', 'ar', $request->description_ar);
        $package->setTranslation('description', 'en', $request->description_en);
        $package->start_date =  $request->start_date;
        $package->is_active  =  $request->is_active;
        $package->end_date   =  $request->end_date;
        $package->price      =  $request->price;
        $package->save();
        return $package;
    }
}

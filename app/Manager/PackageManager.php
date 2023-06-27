<?php

namespace App\Manager;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Package;
use App\Models\PackageFeature;

class PackageManager
{
    public static function setTranslation($package, $request)
    {
        $package->setTranslation('name', 'ar', $request->name_ar);
        $package->setTranslation('name', 'en', $request->name_en);
        $package->setTranslation('description', 'ar', $request->description_ar);
        $package->setTranslation('description', 'en', $request->description_en);
        $package->is_active  =  $request->is_active;
        $package->deuration  =  $request->deuration;
        $package->color      =  $request->color;
        $package->price      =  $request->price;
        $package->save();
        $features = $request->feature;
        for($i = 0 ;$i <sizeof($features) ;$i++)
        {
            $packagefeature  = new PackageFeature();
            $packagefeature->package_id = $package->id;
            $packagefeature->featur_id      = $features[$i]['id'];
            $packagefeature->feature_value  = $features[$i]['feature_value'];
            
            $packagefeature->save();
        }
        return $package;
    }
}

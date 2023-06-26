<?php

namespace App\Manager;

use App\Models\categories;
use App\Models\Childcategory;
use App\Models\sub_categories;
use Exception;
use Illuminate\Foundation\Http\FormRequest;

class RealEstateManager
{
    public static function setTranslation($real_state, $request)
    {

        $real_state->setTranslation('name', 'en', $request['name']);
        if($request->has('name_ar'))
            $real_state->setTranslation('name', 'ar', $request['name_ar']);
        $real_state->setTranslation('description', 'en', $request['description']);
        if($request->has('name_ar'))
            $real_state->setTranslation('description', 'ar', $request['description_ar']);
        $real_state->save();
    }
    public static function categoryRequest($category, $request)
    {
        $request['cat_id'] = $category->id;
        $request['cat_type'] = get_class($category);
        $request->merge([
            'cat_id' => $category->id,
            'cat_type' => get_class($category),
            'user_id' => null // should be auth user id,
        ]);
        return $request;
    }
    public static function getCategory($cat_id, $cat_type)
    {
        switch ($cat_type) {
            case '1':
                return categories::findOrFail($cat_id);
            case '2':
                return sub_categories::findOrFail($cat_id);
            case '3':
                return Childcategory::findOrFail($cat_id);
            default:
                throw new Exception('Invalid category type.');
        }
    }
    public static function haversineDistance($lat1, $lon1, $lat2, $lon2)
    {
        $R = 6371; // Earth's radius in kilometers

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLon / 2) * sin($dLon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $d = $R * $c;

        return $d;
    }

}

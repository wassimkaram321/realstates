<?php

namespace Database\Seeders;

use App\Models\Feature;
use Illuminate\Database\Seeder;

class FeaturesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //ADS
        $ADS = new Feature();
        $ADS->id = 1;
        $ADS->setTranslation('name', 'en','Add ADS') ;
        $ADS->setTranslation('name', 'ar','اضافة اعلانات') ;
        $ADS->save();

        //real estate
        $real = new Feature();
        $real->id = 2;
        $real->setTranslation('name', 'en','Add Realestate') ;
        $real->setTranslation('name', 'ar','اضافة عقارات') ;
        $real->save();

        //feature
        $feature = new Feature();
        $feature->id = 3;
        $feature->setTranslation('name', 'en','Featured Realestate') ;
        $feature->setTranslation('name', 'ar','عقارات مميزة') ;
        $feature->save();

        //recommended
        $recommended = new Feature();
        $recommended->id = 4;
        $recommended->setTranslation('name', 'en','Recommended Realestate') ;
        $recommended->setTranslation('name', 'ar','عقارات مقترحة') ;
        $recommended->save();

        //Vehicles
        $vehicle = new Feature();
        $vehicle->id = 5;
        $vehicle->setTranslation('name', 'en','Add vehicle') ;
        $vehicle->setTranslation('name', 'ar','اضافة مركبات') ;
        $vehicle->save();
    }
}

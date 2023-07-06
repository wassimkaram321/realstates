<?php

namespace App\Repositories;

use App\Manager\FileManager;
use App\Manager\RealEstateManager;
use App\Models\VehicleCategory;
use Illuminate\Support\Facades\App;

class VehicleCategoryRepository
{
    protected $VehicleCategory;

    public function __construct(VehicleCategory $VehicleCategory)
    {
        $this->VehicleCategory = $VehicleCategory;
    }

    // Add your methods here
    public function all($request)
    {
        App::setlocale($request->lang);

        return $this->VehicleCategory::get();
    }

    public function find($id)
    {
        return $this->VehicleCategory::findOrFail($id);
    }

    public function create($request)
    {
        // $VehicleCategory = $this->VehicleCategory->where('id', $request->id)->first();
        $input = $request->all();
        if ($request->file('icon')) {
            $file_name  = (new FileManager())->addFile($request->file('icon'), 'images/car_images/icon');
            $input['icon'] = $file_name;
        }
        $cat = $this->VehicleCategory::create($input);
        $cat->setTranslation('name', 'en', $request['name']);
        $cat->setTranslation('name', 'ar', $request['name_ar']);
        $cat->save();
        return $cat;
    }

    public function update($request)
    {
        $model = $this->VehicleCategory::where('id', $request->id)->first();
        $input = $request->all();
        if ($request->file('icon')) {
            (new FileManager())->deleteFile($model->icon, 'images/car_images/icon');
            $file_name  = (new FileManager())->addFile($request->file('icon'), 'images/car_images/icon');
            $input['icon'] = $file_name;
        }
        $model->update($input);
        $model->setTranslation('name', 'en', $request['name']);
        $model->setTranslation('name', 'ar', $request['name_ar']);
        $model->save();

        return $model;
    }

    public function delete($id)
    {
        $model = $this->VehicleCategory::findOrFail($id);
        (new FileManager())->deleteFile($model->icon, 'images/car_images/icon');


        $model->delete();

        $model->delete();
        return $model;
    }

    public function rules()
    {
        return [];
    }

    public function rules_update()
    {
        return [];
    }
}

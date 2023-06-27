<?php

namespace App\Repositories;

use App\Manager\PackageManager;
use App\Models\Package;
use Illuminate\Support\Facades\App;

class PackageRepository
{
    protected $Package;
    protected $packagemanager;

    public function __construct(Package $Package,PackageManager $packagemanager)//model
    {
        $this->Package = $Package;
        $this->packagemanager = $packagemanager;
    }

    // Add your methods here
    public function all($request)
    {
        App::setLocale($request->lang);
        // dd($this->Package::get());
        return $this->Package::get();
    }

    public function find($id)
    {
        return  $this->Package::findOrFail($id);
    }

    public function create($request)
    {
        $package = $this->Package;
        $this->packagemanager->setTranslation($package,$request);
        return $package;
    }

    public function update($request)
    {
        $model = $this->Package::findOrFail($request->id);
        // $input=$request->all();
        PackageManager::setTranslation($model,$request);
        // $model->update($input);
        return $model;
    }

    public function delete($id)
    {
        $model = $this->Package::findOrFail($id);
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
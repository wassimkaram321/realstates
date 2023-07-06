<?php

namespace App\Repositories;

use App\Manager\PackageManager;
use App\Models\Package;
use Illuminate\Support\Facades\App;

class PackageRepository
{
    protected $Package;
    protected $packagemanager;

    public function __construct(Package $Package, PackageManager $packagemanager) //model
    {
        $this->Package = $Package;
        $this->packagemanager = $packagemanager;
    }

    // Add your methods here
    public function all($request)
    {
        App::setLocale($request->lang);
        $parentIds = $this->Package::where('parent_id','!=', null)->withCount('user')->pluck('parent_id')->all();
        $Packages = $this->Package::whereNotIn('id', $parentIds)->with('parent')->withCount('user')->get();
        return $Packages;
    }

    public function find($id)
    {
        return  $this->Package::where('id',$id)->with('features')->first();
    }

    public function create($request)
    {
        $package = $this->Package;
        $this->packagemanager->setTranslation($package, $request);
        return $package;
    }

    public function update($request)
    {

        $package = $this->Package::where('id', $request->id)->with('features')->first();

        $features = $package->features->map(function ($feature) {
            return [
                'id' => $feature->id,
                'pivot_value' => $feature->pivot->value,
            ];
        });
        $featureIds = $features->pluck('id')->toArray();
        $pivotValues = $features->pluck('pivot_value')->toArray();

        $featuress = $request->feature;

        $can_update = 1;

        if (count($request->feature) != count($featureIds)) {
            $can_update = 0;
        } else {
            foreach ($featuress as $feature) {
                $featureId = $feature['id'];
                $featureValue = $feature['feature_value'];

                $index = array_search($featureId, $featureIds);

                if ($index !== false && $pivotValues[$index] === $featureValue) {
                } else {
                    $can_update = 0;
                    break;
                }
            }
        }

        if (!$can_update) {
            $this->packagemanager->setTranslation($this->Package, $request);
        } else {
            $package->setTranslation('name', 'ar', $request->name_ar);
            $package->setTranslation('name', 'en', $request->name_en);
            $package->setTranslation('description', 'ar', $request->description_ar);
            $package->setTranslation('description', 'en', $request->description_en);
            $package->color      =  $request->color;
            $package->price      =  $request->price;
            $package->save();
        }
        // PackageManager::setTranslation($model,$request);
        return $package;
    }

    public function delete($id)
    {
        $model = $this->Package::where('id',$id)->first();
        $model->delete();
        return $model;
    }
    public function updata_status($request)
    {
        $model = $this->Package::where('id',$request->id)->first();
        $model->update([
            'is_active' => $request->is_active,
        ]);
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

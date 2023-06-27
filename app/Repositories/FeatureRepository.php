<?php

namespace App\Repositories;

use App\Models\Feature;
use Illuminate\Support\Facades\App;

class FeatureRepository
{
    protected $Feature;

    public function __construct(Feature $Feature)
    {
        $this->Feature = $Feature;
    }

    // Add your methods here
    public function all($lang)
    {
        App::setlocale($lang);
        return $this->Feature::all();
    }

    public function find($id)
    {
        return $this->Feature::findOrFail($id);
    }

    public function create(array $data, $id)
    {
        return $this->Feature::create($data);
    }

    public function update(array $data, $id)
    {
        $model = $this->Feature::findOrFail($id);
        $model->update($data);
        return $model;
    }

    public function delete($id)
    {
        $model = $this->Feature::findOrFail($id);
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
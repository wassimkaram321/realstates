<?php

namespace App\Repositories;

use App\Models\VehicleCategory;

class VehicleCategoryRepository
{
    protected $VehicleCategory;

    public function __construct(VehicleCategory $VehicleCategory)
    {
        $this->VehicleCategory = $VehicleCategory;
    }

    // Add your methods here
    public function all()
    {
        return $this->VehicleCategory::all();
    }

    public function find($id)
    {
        return $this->VehicleCategory::findOrFail($id);
    }

    public function create(array $data, $id)
    {
        return $this->VehicleCategory::create($data);
    }

    public function update(array $data, $id)
    {
        $model = $this->VehicleCategory::findOrFail($id);
        $model->update($data);
        return $model;
    }

    public function delete($id)
    {
        $model = $this->VehicleCategory::findOrFail($id);
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
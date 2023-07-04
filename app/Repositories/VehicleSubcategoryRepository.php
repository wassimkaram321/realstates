<?php

namespace App\Repositories;

use App\Models\VehicleSubcategory;

class VehicleSubcategoryRepository
{
    protected $VehicleSubcategory;

    public function __construct(VehicleSubcategory $VehicleSubcategory)
    {
        $this->VehicleSubcategory = $VehicleSubcategory;
    }

    // Add your methods here
    public function all()
    {
        return $this->VehicleSubcategory::all();
    }

    public function find($id)
    {
        return $this->VehicleSubcategory::findOrFail($id);
    }

    public function create(array $data, $id)
    {
        return $this->VehicleSubcategory::create($data);
    }

    public function update(array $data, $id)
    {
        $model = $this->VehicleSubcategory::findOrFail($id);
        $model->update($data);
        return $model;
    }

    public function delete($id)
    {
        $model = $this->VehicleSubcategory::findOrFail($id);
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
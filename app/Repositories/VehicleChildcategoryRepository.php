<?php

namespace App\Repositories;

use App\Models\VehicleChildcategory;

class VehicleChildcategoryRepository
{
    protected $VehicleChildcategory;

    public function __construct(VehicleChildcategory $VehicleChildcategory)
    {
        $this->VehicleChildcategory = $VehicleChildcategory;
    }

    // Add your methods here
    public function all()
    {
        return $this->VehicleChildcategory::all();
    }

    public function find($id)
    {
        return $this->VehicleChildcategory::findOrFail($id);
    }

    public function create(array $data, $id)
    {
        return $this->VehicleChildcategory::create($data);
    }

    public function update(array $data, $id)
    {
        $model = $this->VehicleChildcategory::findOrFail($id);
        $model->update($data);
        return $model;
    }

    public function delete($id)
    {
        $model = $this->VehicleChildcategory::findOrFail($id);
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
<?php

namespace App\Repositories;

use App\Models\Vehicle;

class VehicleRepository
{
    protected $Vehicle;

    public function __construct(Vehicle $Vehicle)
    {
        $this->Vehicle = $Vehicle;
    }

    // Add your methods here
    public function all()
    {
        return $this->Vehicle::all();
    }

    public function find($id)
    {
        return $this->Vehicle::findOrFail($id);
    }

    public function create(array $data, $id)
    {
        return $this->Vehicle::create($data);
    }

    public function update(array $data, $id)
    {
        $model = $this->Vehicle::findOrFail($id);
        $model->update($data);
        return $model;
    }

    public function delete($id)
    {
        $model = $this->Vehicle::findOrFail($id);
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
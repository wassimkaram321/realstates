<?php

namespace App\Repository;

use App\Models\AdCategoryRepository;

class AdCategoryRepository
{
    protected $AdCategoryRepository;

    public function __construct(AdCategoryRepository $AdCategoryRepository)
    {
        $this->AdCategoryRepository = $AdCategoryRepository;
    }

    // Add your methods here
    public function all()
    {
        return $this->AdCategoryRepository::all();
    }

    public function find($id)
    {
        return $this->AdCategoryRepository::findOrFail($id);
    }

    public function create(array $data, $id)
    {
        return $this->AdCategoryRepository::create($data);
    }

    public function update(array $data, $id)
    {
        $model = $this->AdCategoryRepository::findOrFail($id);
        $model->update($data);
        return $model;
    }

    public function delete($id)
    {
        $model = $this->AdCategoryRepository::findOrFail($id);
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
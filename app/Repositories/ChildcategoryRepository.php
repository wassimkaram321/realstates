<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Models\Childcategory;

class ChildcategoryRepository
{
    protected $Childcategory;

    public function __construct(Childcategory $Childcategory)
    {
        $this->Childcategory = $Childcategory;
    }
    // Add your methods here
    public function all($lang)
    {
        App::setlocale($lang);
        $childs = $this->Childcategory::get();
        $data = array();
        foreach ($childs as $child) {
            $data[] = array(
                'id'             => $child->id,
                'name'           => $child->getTranslation('name', $lang) ?? '',
                'child_category' => $child->sub->getTranslation('name', $lang),
                'child_category_id' => $child->sub->id,
            );
        }
        return $data;
    }

    public function find($id)
    {
        return $this->Childcategory::findOrFail($id);
    }

    public function create($request)
    {
        $list = $request->list;

        for($j = 0;  $j< count($list); $j++)
            {
                $Child = new Childcategory;
                $Child->setTranslation('name', 'ar', $list[$j]['name_ar']);
                $Child->setTranslation('name', 'en', $list[$j]['name_en']);
                $Child->sub_id = $request->input('sub_id');
                $Child->save();
            }
        return $Child;
    }

    public function update($request)
    {
        $model = $this->Childcategory::findOrFail($request->id);

        if ($request->input('name_en') != null) {
            $model->setTranslation('name', 'en', $request->input('name_en'));
        }
        if ($request->input('name_ar') != null) {
            $model->setTranslation('name', 'ar', $request->input('name_ar'));
        }
        if ($request->input('sub_id') != null) {
            $model->sub_id = $request->sub_id;
        }
        $model->save();
        return $model;
    }

    public function delete($id)
    {
        $model = $this->Childcategory::findOrFail($id);
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

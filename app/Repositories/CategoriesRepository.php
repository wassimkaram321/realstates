<?php

namespace App\Repositories;

use App\Models\categories;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class userRepository.
 */
class CategoriesRepository
{
    /**
     * @return string
     *  Return the model
     */
    protected $category;

    public function __construct(categories $category)
    {
        $this->category = $category;
    }
    public function all($lang)
    {
        App::setlocale($lang);
        $categorys =  $this->category->get();
        return $categorys;
    }
    public function find($id)
    {
        $cat = categories::where('id',$id)->get();
        return $cat;
    }
    public function create($request)
    {
        $category = new categories;
        $category->setTranslation('name', 'en', $request->name_en);
        if (isset($request->name_ar)) {
            $category->setTranslation('name', 'ar', $request->name_ar);
        }
        $category->save();
        return $category;
    }
    public function update($request)
    {
        $category =  $this->category->find($request->id);
        if ($request->input('name_en') != null) {
            $category->setTranslation('name', 'en', $request->input('name_en'));
        }
        if ($request->input('name_ar') != null) {
            $category->setTranslation('name', 'ar', $request->input('name_ar'));
        }
        
        $category->save();
        return $category;
    }
    public function delete($request)
    {
        return $this->category->destroy($request->id);
    }

    public function rules()
    {
        # code...
        return [
            'name_en'         => 'required',
            'name_ar'         => 'max:50'
        ];
    }
    public function rules_update()
    {
        # code...
        return [
            'name_en'         => 'required'
            // 'name_ar'         => 'required'
        ];
    }
}

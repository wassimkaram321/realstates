<?php

namespace App\Repositories;

use App\Models\categories;
use App\Models\sub_categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SubCategoriesRepository
{
    protected $sub_categories;

    public function __construct(sub_categories $sub_categories)
    {
        $this->sub_categories = $sub_categories;
    }

    // Add your methods here
    public function all($lang)
    {
        $sub = $this->sub_categories->get();
        $data = array();
        foreach ($sub as $sub_category) {
                    $data[] = array(
                        'id'           => $sub_category->id,
                        'name'         => $sub_category->getTranslation('name', $lang) ?? '',
                      //  'category'     => $sub_category->category->getTranslation('name', $lang),
                       // 'category_id'     => $sub_category->category->id
                    );
                }
        return $data;
    }

    public function find($id)
    {
        return $this->sub_categories::findOrFail($id);
    }

    public function create($request)
    {
        // $rules = array(
        //       'cat_id'   => 'required|exists:categories,id',
        //   );

        //   $validator = validator($request->all(), $rules);
        //   if ($validator->fails()) {
        //       return response()->json([
        //           'error'          => 'true',
        //           'status_message' => $validator->messages()->first()
        //       ]);
        //   }
        $list = $request->list;
        for ($j = 0; $j < count($list); $j++) {
            $sub_category = new sub_categories;
            $sub_category->setTranslation('name', 'ar', $list[$j]['name_ar']);
            $sub_category->setTranslation('name', 'en', $list[$j]['name_en']);
            $sub_category->cat_id = $request->input('cat_id');
            $sub_category->save();
        }
        return $sub_category;
    }

    public function update($request)
    {
        $category = $this->sub_categories::findOrFail($request->id);

        if ($request->input('name_en') != null) {
            $category->setTranslation('name', 'en', $request->input('name_en'));
        }
        if ($request->input('name_ar') != null) {
            $category->setTranslation('name', 'ar', $request->input('name_ar'));
        }
        // if ($request->input('cat_id') != null) {
        //     $category->cat_id = $request->cat_id;
        // }
        $category->save();
        return $category;
    }

    public function delete($id)
    {
        $model = $this->sub_categories::findOrFail($id);
        return $model->delete();
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

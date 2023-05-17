<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\categories;
use App\Models\sub_categories;
use Illuminate\Http\Request;

class SubCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $rules = array(
        //     'name_en'  => 'required',
        //     'cat_id'   => 'required',
        // );

        // $validator = validator($request->all(), $rules);
        // if ($validator->fails()) {
        //     return response()->json([
        //         'error'          => 'true',
        //         'status_message' => $validator->messages()->first()
        //     ]);
        // }
       
       
        // dd($request);
        $list = $request->list;
        for($j = 0;  $j< count($list); $j++)
            {
                $sub_category = new sub_categories;
                $sub_category->setTranslation('name', 'ar', $list[$j]['name_ar']);
                $sub_category->setTranslation('name', 'en', $list[$j]['name_en']);
                $sub_category->cat_id = $request->input('cat_id');
                $sub_category->save();
            }
        // $array1 = $request->name_en;
        // $array2 = $request->name_ar;

        // for($i = 0;  $i< count($array1);$i++)
        // {
        //     for($j = 0;  $j< count($array2); $j++)
        //     {
        //         $sub_category->setTranslation('name', 'en', $array1[$i]);
        //         $sub_category->setTranslation('name', 'ar', $array2[$j]);
        //         $sub_category->cat_id = $request->input('cat_id');
        //         $sub_category->save();
        //     }
        // }
        return response()->json(['error' => 'false', "message" => "success", 'data' => []]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\sub_categories  $sub_categories
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $rules = array(
            'lang'         => 'required',
        );

        $validator = validator($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'error'          => 'true',
                'status_message' => $validator->messages()->first()
            ]);
        }
        $sub_categorys = sub_categories::get();
        if ($request->lang == 'ar') {
            foreach ($sub_categorys as $sub_category) {
                $data[] = array(
                    'id'           => $sub_category->id,
                    'name'         => $sub_category->getTranslation('name', 'ar') ?? '',
                    'category'     => $sub_category->category->getTranslation('name', 'ar')
                );
            }
            return response()->json(['error' => 'false', "message" => "success", 'data' => $data]);
        } else {
            foreach ($sub_categorys as $sub_category) {
                $data[] = array(
                    'id'           => $sub_category->id,
                    'name'         => $sub_category->getTranslation('name', 'en') ?? '',
                    'category'     => $sub_category->category->getTranslation('name', 'en')
                );
            }
            return response()->json(['error' => 'false', "message" => "success", 'data' => $data]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\sub_categories  $sub_categories
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $sub_category = sub_categories::find($request->id);
        $category     = categories::get();
        return view('sub_category.edit',compact('sub_category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\sub_categories  $sub_categories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, sub_categories $sub_categories)
    {
        $rules = array(
            'id'         => 'required',
        );

        $validator = validator($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'error'          => 'true',
                'status_message' => $validator->messages()->first()
            ]);
        }
        $category = sub_categories::find($request->id);

        if ($request->input('name_en') != null) {
            $category->setTranslation('name', 'en', $request->input('name_en'));
        }
        if ($request->input('name_ar') != null) {
            $category->setTranslation('name', 'ar', $request->input('name_ar'));
        }
        if ($request->input('cat_id') != null) {
            $category->cat_id = $request->cat_id;
        }
        $category->save();

        return response()->json(['error' => 'false', "message" => "success", 'data' => []]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sub_categories  $sub_categories
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $rules = array(
            'id'         => 'required',
        );

        $validator = validator($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'error'          => 'true',
                'status_message' => $validator->messages()->first()
            ]);
        }
        $categorys = sub_categories::find($request->id);
        $categorys->delete();
        return response()->json(['error' => 'false', "message" => "success", 'data' => []]);
    }
}


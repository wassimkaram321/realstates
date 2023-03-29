<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Childcategory;
use Illuminate\Http\Request;

class ChildcategoryController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $rules = array(
            'name_en'  => 'required',
          //  'sub_id' => 'required|exists:sub_categories,id',
        );

        $validator = validator($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'error'          => 'true',
                'status_message' => $validator->messages()->first()
            ]);
        }
       
        $Child = new Childcategory;
        
        $array1 = $request->name_en;
        $array2 = $request->name_ar;

        for($i = 0;  $i< count($array1);$i++)
        {
            for($j = 0;  $j< count($array2); $j++)
            {
                $Child->setTranslation('name', 'en', $array1[$i]);
                $Child->setTranslation('name', 'ar', $array2[$j]);
                $Child->sub_id = $request->sub_id;
                $Child->save();
            }
        }
        return response()->json(['error' => 'false', "message" => "success", 'data' => []]);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Childcategory  $childcategory
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'secret' => 'required',
         
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            if ($errors->first('secret')) {
                return response()->json(['message' => $errors->first('secret'), 'status' => 'fail'], 400);
            }
        
        }
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
        $childs = Childcategory::get();
        
        if ($request->lang == 'ar') {
            foreach ($childs as $child) {
                $data[] = array(
                    'id'             => $child->id,
                    'name'           => $child->getTranslation('name', 'ar') ?? '',
                    'child_category' => $child->sub->getTranslation('name', 'ar')
                );
            }
            return response()->json(['error' => 'false', "message" => "success", 'data' => $data]);
        } else {
            foreach ($childs as $child) {
                $data[] = array(
                    'id'             => $child->id,
                    'name'           => $child->getTranslation('name', 'en') ?? '',
                    'child_category' => $child->sub->getTranslation('name', 'en')
                );
            }
            return response()->json(['error' => 'false', "message" => "success", 'data' => $data]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Childcategory  $childcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Childcategory $childcategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Childcategory  $childcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
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
        $child = Childcategory::find($request->id);
        if ($request->input('name_en') != null) {
            $child->setTranslation('name', 'en', $request->input('name_en'));
        }
        if ($request->input('name_ar') != null) {
            $child->setTranslation('name', 'ar', $request->input('name_ar'));
        }
        if ($request->input('sub_id') != null) {
            $child->sub_id = $request->sub_id;
        }
        $child->save();

        return response()->json(['error' => 'false', "message" => "success", 'data' => []]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Childcategory  $childcategory
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
        $child = Childcategory::find($request->id);
        $child->delete();
        return response()->json(['error' => 'false', "message" => "success", 'data' => []]);
    }
}

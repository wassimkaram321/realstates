<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\CategoriesRepository;
use Illuminate\Support\Facades\App;
use App\Models\categories;
use Illuminate\Http\Request;
use Exception;

class CategoriesController extends Controller
{

    protected $repository;

    public function __construct(CategoriesRepository $repository)
    {
        $this->repository = $repository;
    }
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
        // return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->repository->create($request);
        return $this->success('success', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $lang = $request->lang;

        $data = $this->repository->all($lang);
        return $this->success('success', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        // $data = $this->repository->find($request->id);
        $data = categories::where('id',$request->id)->first();
        // dd($data);
        return response()->json(['error' => 'false', "message" => "success", 'data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = $this->repository->update($request);
        return $this->success('success', $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $data = $this->repository->delete($request);
        return $this->success('success', []);
    }
}

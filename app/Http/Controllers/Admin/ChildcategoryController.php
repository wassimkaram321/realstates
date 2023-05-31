<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\ChildcategoryRepository;
use App\Models\Childcategory;
use Illuminate\Http\Request;

class ChildcategoryController extends Controller
{

    protected $repository;

    public function __construct(ChildcategoryRepository $repository)
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
        $this->repository->create($request);
        return $this->success('success', []);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Childcategory  $childcategory
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $lang = $request->lang;
        $data = $this->repository->all($lang);
        return $this->success('success',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Childcategory  $childcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $data = $this->repository->find($request);
        return $this->success('success', $data);
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
        $this->repository->update($request);
        return $this->success('success',[]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Childcategory  $childcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->repository->delete($request->id);
        return $this->success('success', []);
    }
}

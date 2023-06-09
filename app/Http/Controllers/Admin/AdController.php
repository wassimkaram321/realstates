<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Repositories\AdRepository;
use Illuminate\Http\Request;

class AdController extends Controller
{
    protected $repository;

    public function __construct(AdRepository $repository)
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
        $data = $this->repository->all();
        return $this->success('success',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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
        $data = $this->repository->create($request);
        return $this->success('success',$data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $data = $this->repository->find($request->id);
        return $this->success('success',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function edit(Ad $ad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = $this->repository->update($request);
        return $this->success('success',$data);
    }
    public function UpdateStatus(Request $request)
    {
        $this->repository->UpdateStatus($request);
        return $this->success([], 'success');
    }
    public function AdClick(Request $request)
    {
        $this->repository->AdClick($request);
        return $this->success([], 'success');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->repository->delete($request->id);
        return $this->success('success','');
    }
}

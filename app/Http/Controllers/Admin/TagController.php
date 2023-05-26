<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagRequest;
use App\Models\Image;
use App\Repositories\TagRepository;
use Illuminate\Http\Request;
use Exception;

class TagController extends Controller
{
    protected $repository;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(TagRepository $repository)
    {
        $this->repository = $repository;
    }
    public function index(Request $request)
    {
        //
        $data = $this->repository->all($request);
        return $this->success('success', $data);
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
    public function store(TagRequest $request)
    {
        $data = $this->repository->create($request);
        return $this->success('success', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(TagRequest $request)
    {
        $data = $this->repository->find($request);
        return $this->success('success', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(TagRequest $request, Image $image)
    {
        $data = $this->repository->update($request);
        return $this->success('success', $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(TagRequest $request)
    {
        $data = $this->repository->delete($request);
        return $this->success('success', []);
    }
    public function tag_real_states(TagRequest $request)
    {
        $data = $this->repository->tag_real_states($request);
        return $this->success('success', $data);
    }
}

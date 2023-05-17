<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Repositories\ImageRepository;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use Exception;

class ImageController extends Controller
{
    use ResponseTrait;
    protected $repository;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(ImageRepository $repository)
    {
        $this->repository = $repository;
    }
    public function index()
    {
        //
        $data = $this->repository->all();
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
    public function store(Request $request)
    {
        //
        try {
            $data = $this->validate($request, $this->repository->rules());
            $this->repository->create($data);
            return $this->success('success', $data);
        } catch (Exception $ex) {
            return $this->error();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        //
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
    public function update(Request $request, Image $image)
    {
        //
        try {
            $data = $this->validate($request, $this->repository->rules_update());
            $this->repository->update($request->id, $data);
            return $this->success('success', []);
        } 
        catch (Exception $ex) {
            return $this->error();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        try {
            $id = $request->id;
            $this->repository->delete($id);
            return $this->success('success', []);
        } catch (Exception $ex) {
            return $this->error();
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyResourse;
use App\Models\Company;
use App\Repositories\CompanyRepository;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use Exception;

class CompanyController extends Controller
{
    use ResponseTrait;
    protected $repository;


    public function __construct(CompanyRepository $repository)
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
        $data = $this->repository->all();
        return $this->success('success', CompanyResourse::collection($data));
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
            return $this->success('success', []);
        } catch (Exception $ex) {
            return $this->error();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //

        try {
            $id = $request->id;

            $data = $this->repository->find($id);

            return $this->success('success', CompanyResourse::collection($data));
        } catch (Exception $ex) {
            return $this->error();
           
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
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
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */

    public function change_status(Request $request)
    {
        # code...
        try {
            $this->repository->change_status($request->status, $request->id);
            return $this->success('success', []);
        } catch (Exception $ex) {
            return $this->error();
        }
    }
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

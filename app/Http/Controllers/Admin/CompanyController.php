<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Http\Resources\CompanyResourse;
use App\Models\Company;
use App\Repositories\CompanyRepository;
use App\Repositories\AuthorizationHandler;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use Exception;

class CompanyController extends Controller
{
    use ResponseTrait;
    protected $repository;
    protected $authorizationHandler;


    public function __construct(CompanyRepository $repository , AuthorizationHandler $authorizationHandler)
    {
        $this->repository = $repository;
        $this->authorizationHandler = $authorizationHandler;
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
    public function store(CompanyRequest $request)
    {
        $data = $this->repository->create($request);
        return $this->success('success', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(CompanyRequest $request)
    {
        $data = $this->repository->find($request);
        return $this->success('success', $data);
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
    public function update(CompanyRequest $request, Company $company)
    {
        $data = $this->repository->update($request);
        return $this->success('success', $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */

    public function change_status(CompanyRequest $request)
    {
        $data = $this->repository->changeStatus($request);
        return $this->success('success', $data);
    }
    public function destroy(CompanyRequest $request)
    {
        $data = $this->repository->delete($request);
        return $this->success('success', $data);
    }
}

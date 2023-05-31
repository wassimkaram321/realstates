<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\StateResource;
use App\Models\State;
use App\Repositories\AuthorizationHandler;
use App\Repositories\StateRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StateController extends Controller
{
    protected $repository;
    protected $authorizationHandler;
    public function __construct(StateRepository $repository, AuthorizationHandler $authorizationHandler)
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
        // $this->authorizationHandler->authorize('state_permission');
        $this->repository->create($request);
        return $this->success('success',[]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        // $this->authorizationHandler->authorize('state_permission');
        $states = $this->repository->find($request);
        return $this->success('success',StateResource::collection($states));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $data = State::where('id',$request->id)->first();
        return response()->json(['error' => 'false', "message" => "success", 'data' => $data]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, State $state)
    {
        // $this->authorizationHandler->authorize('state_permission');
        $this->repository->update($request);
        return $this->success('success',[]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // $this->authorizationHandler->authorize('state_permission');
        $this->repository->delete($request);

        return $this->success('success',[]);
       
 
    }
}
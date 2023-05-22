<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\StateResource;
use App\Models\State;
use App\Repositories\AuthorizationHandler;
use App\Repositories\StateRepository;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class StateController extends Controller
{
    use ResponseTrait;
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

        $this->repository->create($request);
        return $this->success('success',[]);
        // $rules = array(
        //     'name_en' => 'required',
        // );

        // $validator = validator($request->all(), $rules);
        // if ($validator->fails()) {
        //     return response()->json([
        //         'error' => 'true',
        //         'status_message' => $validator->messages()->first()
        //     ]);
        // }
        // $state = new State;
        // $state->setTranslation('name', 'en', $request->input('name_en'));
        // $state->setTranslation('name', 'ar', $request->input('name_ar'));
        // $state->save();
        // return response()->json(['error' => 'false', "message" => "success", 'data' => []]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
       
        $states = $this->repository->find($request);
        return $this->success('success',StateResource::collection($states));
        // $rules = array(
        //     'lang' => 'required',
        // );

        // $validator = validator($request->all(), $rules);
        // if ($validator->fails()) {
        //     return response()->json([
        //         'error' => 'true',
        //         'status_message' => $validator->messages()->first()
        //     ]);
        // }
        // $states = State::get();

        // if ($request->lang == 'ar') {
        //     foreach ($states as $state) {
        //         $data[] = array(
        //             'id' => $state->id,
        //             'name' => $state->getTranslation('name', 'ar') ?? '',
        //         );
        //     }
        //     return response()->json(['error' => 'false', "message" => "success", 'data' => $data]);
        // } else {
        //     foreach ($states as $state) {
        //         $data[] = array(
        //             'id' => $state->id,
        //             'name' => $state->getTranslation('name', 'en') ?? '',
        //         );
        //     }
        //     return response()->json(['error' => 'false', "message" => "success", 'data' => $data]);
        // }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function edit(State $state)
    {
        //
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
        $this->repository->update($request);
        return $this->success('success',[]);
        // $rules = array(
        //     'id' => 'required',
        // );

        // $validator = validator($request->all(), $rules);
        // if ($validator->fails()) {
        //     return response()->json([
        //         'error' => 'true',
        //         'status_message' => $validator->messages()->first()
        //     ]);
        // }
        // $category = State::find($request->id);

        // if ($request->input('name_en') != null) {
        //     $category->setTranslation('name', 'en', $request->input('name_en'));
        // }
        // if ($request->input('name_ar') != null) {
        //     $category->setTranslation('name', 'ar', $request->input('name_ar'));
        // }
        // $category->save();

        // return response()->json(['error' => 'false', "message" => "success", 'data' => []]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->repository->delete($request);
        $this->success('success',[]);
        // $rules = array(
        //     'id' => 'required',
        // );

        // $validator = validator($request->all(), $rules);
        // if ($validator->fails()) {
        //     return response()->json([
        //         'error' => 'true',
        //         'status_message' => $validator->messages()->first()
        //     ]);
        // }
        // $categorys = State::find($request->id);
        // $categorys->delete();
        // return response()->json(['error' => 'false', "message" => "success", 'data' => []]);
    }
}
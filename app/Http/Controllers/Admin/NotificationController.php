<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NotificationRequest;
use App\Repositories\NotificationRepository;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    protected $repository;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(NotificationRepository $repository)
    {
        $this->repository = $repository;
    }
    public function index(Request $request)
    {
        $data = $this->repository->all($request);
        return $this->success('success', $data);
    }

    public function userNotifications(Request $request)
    {
        $data = $this->repository->userNotifications($request);
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
    public function store(NotificationRequest $request)
    {
        $data = $this->repository->create($request->all());
        return $this->success('success', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(NotificationRequest $request)
    {
        $data = $this->repository->find($request);
        return $this->success('success', $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(NotificationRequest $request)
    {
        $data = $this->repository->delete($request);
        return $this->success('success', []);
    }

    public function seeAll(NotificationRequest $request)
    {
        $data = $this->repository->seeAll($request);
        return $this->success('success', $data);
    }

    public function unseenCount(NotificationRequest $request)
    {
        $data = $this->repository->unseenCount($request);
        return $this->success('success', $data);
    }
}

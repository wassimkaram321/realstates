<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Realestat_booking;
use Illuminate\Http\Request;
use App\Repositories\Realestat_Booking_Repository;
use App\Traits\ResponseTrait;
use App\Http\Resources\RealestatBookingResource;


class RealestatBookingController extends Controller
{
    use ResponseTrait;
    protected $repository;
    public function __construct(Realestat_Booking_Repository $repository)
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
        return $this->success('success', RealestatBookingResource::collection($data));
    }

    public function user_booking(Request $request)
    {
        $data = $this->repository->user_booking($request->id);
        return $this->success('success',$data);
        // return $this->success('success', RealestatBookingResource::collection($data));
    }
    public function user_bookedup(Request $request)
    {
        $data = $this->repository->user_bookedup($request->id);
        return $this->success('success',$data);
        // return $this->success('success', RealestatBookingResource::collection($data));
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Realestat_booking  $realestat_booking
     * @return \Illuminate\Http\Response
     */
    public function show(Realestat_booking $realestat_booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Realestat_booking  $realestat_booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Realestat_booking $realestat_booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Realestat_booking  $realestat_booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Realestat_booking $realestat_booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Realestat_booking  $realestat_booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Realestat_booking $realestat_booking)
    {
        //
    }
}

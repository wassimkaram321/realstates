<?php

namespace App\Repositories;

use App\Models\Realestat_booking;
use App\Models\Realstate;

class Realestat_Booking_Repository
{
    protected $Realestat_booking;

    public function __construct(Realestat_booking $Realestat_booking)
    {
        $this->Realestat_booking = $Realestat_booking;
    }

    // Add your methods here
    public function all()
    {
        return $this->Realestat_booking::with(['realestate', 'user', 'category'])->get()->reverse()->values();
    }

    public function user_booking($id)//Realestate booked by the user
    {
        return $this->Realestat_booking::where('user_id', $id)->get();
    }
    public function user_bookedup($id)//Reserved realestate belong to user 
    {
        return Realstate::where('user_id', $id)->where('ava',0)->get();
    }
    
    public function find($id)
    {
        return $this->Realestat_booking::findOrFail($id);
    }

    public function create(array $data, $id)
    {
        return $this->Realestat_booking::create($data);
    }

    public function update(array $data, $id)
    {
        $model = $this->Realestat_booking::findOrFail($id);
        $model->update($data);
        return $model;
    }

    public function delete($id)
    {
        $model = $this->Realestat_booking::findOrFail($id);
        $model->delete();
        return $model;
    }

    public function rules()
    {
        return [];
    }

    public function rules_update()
    {
        return [];
    }
}
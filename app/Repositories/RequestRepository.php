<?php

namespace App\Repositories;

use App\Models\Request as Requestes;
use App\Models\Realestat_booking;
use App\Models\Realstate;

class RequestRepository
{
    protected $Requestes;

    public function __construct(Requestes $Requestes)
    {
        $this->Requestes = $Requestes;
    }

    // Add your methods here
    public function all()
    {
        return $this->Requestes::where('deleted_at', null)->where('status', 'Pendding')->get();
    }

    public function find($id)
    {
        return $this->Requestes::findOrFail($id);
    }

    public function create($data)
    {
        return $this->Requestes::create([
            'user_id'     => $data['user_id'],
            'bookedup_id' => $data['bookedup_id'],
            'type'        => $data['type'],
            'status'      => 'Pendding',
        ]);
    }

    public function update($request)
    {
        $model = $this->Requestes::findOrFail($request->id);
        if ($model->status == 'Accepted') {
            return 'this request already accepted';
        } else {
            if ($request->status == 'Accepted') {

                //update status of real estate to booked up 
                $Realstate = Realstate::findOrFail($model->bookedup_id);
                $Realstate->status = 0;//ava
                $Realstate->save();

                // create row in booking table
                Realestat_booking::create([
                    'request_id'    => $request->id,
                    'user_id'       => $model->user_id,
                    'realestate_id' => $model->bookedup_id,
                    'booking_type'  => $Realstate->cat_id,
                ]);


                //update status of request
                $model->update([
                    'status' => $request->status,
                ]);
            } else {
                //soft delelte for request and update status to cancelled
                $model->update([
                    'status' => 'Cancelled',
                ]);
                $model->delete();
            }
            return 'success';
        }
    }

    public function delete($id)
    {
        $model = $this->Requestes::findOrFail($id);
        if ($model->status != 'Accepted') {
            $model->delete();
            return 'success';
        } else {
            return 'can not deleted';
        }
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

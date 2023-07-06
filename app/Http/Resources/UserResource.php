<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;
use DB;
use Illuminate\Support\Facades\DB as FacadesDB;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $baseURL = URL::to('/');
        $role = DB::table('roles')->where('id', $this->role_id)->first();
        // dd($role->name);
        return [
            'id' =>      $this->id,
            'name' =>    $this->name,
            'email' =>   $this->email,
            'phone' =>   $this->phone,
            'role_name' => $role->name,
            'role_id' => $this->role_id,
            'real_state_id' => $this->role_id,
            'company_id' => $this->company_id,
            'city_id' => $this->city_id,
            'status' => $this->status,
            'image' =>  asset($baseURL . '/' . 'public/images/users/' . $this->image) ?? '', //$this->image,


        ];
    }
}

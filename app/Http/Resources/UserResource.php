<?php

namespace App\Http\Resources;
 
use Illuminate\Http\Resources\Json\JsonResource;
 
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
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'role_id' => $this->role_id,
            'real_state_id' => $this->role_id,
            'company_id' => $this->company_id,
            'city_id' => $this->city_id,
            'status' => $this->status,
            'image' => $this->image,
            
           
        ];
    }
}

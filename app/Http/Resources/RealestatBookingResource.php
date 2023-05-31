<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RealestatBookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'             => $this->id,
            'client'         => $this->user->name,
            'property owner' => $this->realestate->owner->name,
            'realestate'     => $this->realestate,
            'cat_type'       => $this->category->name,
        ];
        // return parent::toArray($request);
    }
}

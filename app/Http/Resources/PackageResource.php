<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PackageResource extends JsonResource
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
            'id'          => $this->id,
            'name'        => $this->name,
            'description' => $this->description,
            'price'       => $this->price,
            'is_active'   => $this->is_active,
            'deuration'   => $this->deuration ,
            'color'       => $this->color,
            'feature'     => $this->features,
            'user_count'  => $this->user_count,
            'parent'      => $this->parent,


        ];
        //parent::toArray($request);
    }
}

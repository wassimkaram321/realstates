<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RealstateResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'cat_id' => $this->cat_id,
            'cat_type' => $this->cat_type,
            'status' => $this->status,
            'image' => $this->image,
            'city_id' => $this->city_id,
            'user_id' => $this->user_id,
            'price' => $this->price,
            'space' => $this->space,
            'latitude' => $this->latitude,
            'longtitude' => $this->longtitude,
            'tags' => $this->tags,
            'attributes' => $this->attributes,
            'images' => $this->images,
            'categories' => $this->category()->get(),
        ];
    }
}

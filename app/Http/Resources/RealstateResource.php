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
            
            'id'          => $this->id,
            'name'        => $this->name,
            'description' => $this->description,
            'cat_id'      => $this->cat_id,
            'sub_id'      => $this->sub->id ,
            'child_id'    => $this->child->id,
            'child'       => $this->child ? $this->child->name : null,
            'sub_category'=> $this->sub ? $this->sub->name: null,
            'category'    => $this->categories ? $this->categories->name : null,
            'cat_type'    => $this->cat_type,
            'status'      => $this->status,
            'image'       => $this->image,
            'city'        => $this->city ? $this->city->name : null,
            'state'       => ($this->city && $this->city->state) ? $this->city->state->name : null,
            'user_name'   => $this->owner->name,
            'price'       => $this->price,
            'space'       => $this->space,
            'latitude'    => $this->latitude,
            'longtitude'  => $this->longtitude,
            'address'     => $this->address,
            'rent_time'   => $this->rent_time,
            'ava'         => $this->ava,
            'tags'        => $this->tags,
            'attributes'  => $this->attributes,
            'images'      => $this->images,
            // 'categories' => $this->category()->get(),
        ];
    }
}

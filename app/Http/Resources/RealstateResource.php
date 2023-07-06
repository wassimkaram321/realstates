<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;

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
        $baseURL = URL::to('/');
        $data  = array();
        $data1 = array();
        foreach ($this->images as $image) {
            $data[]=[
                'id'    => $image->id,
                'alt'   => $image->alt,
                'name'  => asset($baseURL . '/'.'public/images/real_estate_images/' . $image->name) ?? '',
                ];
             }
        foreach ($this->tags as $tag) {
            $data1[]=[
                'id'    => $tag->id,
                'title' => $tag->title,
                ];
             }

        return [

            'id'          => $this->id,
            'name'        => $this->name,
            'description' => $this->description,
            'cat_id'      => $this->cat_id,
            'sub_id'      => $this->sub? $this->sub->id : null,
            'child_id'    => $this->child ? $this->child->id : null,
            'child'       => $this->child ? $this->child->name : null,
            'sub_category'=> $this->sub ? $this->sub->name: null,
            'category'    => $this->categories ? $this->categories->name : null,
            'cat_type'    => $this->cat_type,
            'status'      => $this->status,
            'image'       => asset($baseURL . '/'.'public/images/real_estate_images/' . $this->image) ?? '',//$this->image,
            'city'        => $this->city ? $this->city->name : null,
            'city_id'     => $this->city ? $this->city->id : null,
            'state'       => ($this->city && $this->city->state) ? $this->city->state->name : null,
            'state_id'    => ($this->city && $this->city->state) ? $this->city->state->id : null,
            'user_name'   => $this->owner->name,
            'price'       => $this->price,
            'space'       => $this->space,
            'feature'     => $this->feature,
            'Recommended' => $this->Recommended,
            'latitude'    => $this->latitude,
            'longtitude'  => $this->longtitude,
            'address'     => $this->address,
            'rent_time'   => $this->rent_time,
            'available'   => $this->ava,
            'tags'        => $data1,//$this->tags,
            'attributes'  => $this->attributeValues,
            'images'      => $data,//$this->images,
            // 'categories'  => $this->category()->get(),
            // 'avg_rating'  => $this->averageRating() ?? 0,


        ];
    }
}

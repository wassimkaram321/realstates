<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;

class VehicleSubcategoryResource extends JsonResource
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
        return [
            'id'   =>$this->id,
            'name' => $this->getTranslation('name', $request->lang) ?? '',
            'icon' => asset($baseURL . '/'.'images/car_images/icon/' . $this->icon) ?? '',
        ];
        // return parent::toArray($request);
    }
}

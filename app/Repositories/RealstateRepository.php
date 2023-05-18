<?php

namespace App\Repositories;

use App\Manager\AttributeManager;
use App\Manager\RealEstateManager;
use App\Models\categories;
use App\Models\Childcategory;
use App\Models\City;
use App\Models\Realstate;
use App\Models\sub_categories;
use App\Models\User;
use Attribute;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class userRepository.
 */
class RealstateRepository
{
    /**
     * @return string
     *  Return the model
     */
    protected $real_state;

    public function __construct(Realstate $real_state)
    {
        $this->real_state = $real_state;
    }
    public function all()
    {
        # code...
        return $this->real_state->active()->with(['attributes', 'images', 'category'])->get();
    }
    public function find($request)
    {
        return $this->real_state->findOrFail($request->id)->with(['attributes', 'images', 'tags'])->active()->get();

    }
    public function create($request)
    {
        # code...

        $images = $request['images'] ?? [];
        $tags = $request['tags'] ?? [];
        $attributes = $request['attributes'] ?? [];

        $category = RealEstateManager::getCategory($request['cat_id'], $request['cat_type']);

        RealEstateManager::categoryRequest($category, $request);
        $realEstateData = $request->except(['images', 'tags', 'attributes']);

        $tagIds = collect($tags)->pluck('tag_id')->toArray();

        $real_state = $this->real_state->create($realEstateData);
        $real_state->category()->associate($category);
        $real_state->tags()->attach($tagIds);
        $real_state->images()->createMany($images);
        foreach ($attributes as $attribute) {
            $temp = $real_state->attributes()->create($attribute);
            AttributeManager::setTranslation($temp, $attribute);
        }

        RealEstateManager::setTranslation($real_state, $request);


        return $real_state;
    }

    public function update($request)
    {
        $real_state = Realstate::findOrFail($request->id);

        $images = $request['images'] ?? [];
        $tags = $request['tags'] ?? [];
        $attributes = $request['attributes'] ?? [];

        $category = RealEstateManager::getCategory($request['cat_id'], $request['cat_type']);
        RealEstateManager::categoryRequest($category, $request);

        $tagIds = collect($tags)->pluck('tag_id')->toArray();


        $real_state->update($request->all());
        if (count($tags) > 0) {
            $real_state->tags()->sync($tagIds);
        } else {
            $real_state->tags()->detach();
        }
        if (count($attributes) > 0) {
            $attributeIds = collect($attributes)->pluck('id');
            $real_state->attributes()->whereIn('id', $attributeIds)->delete();
            $real_state->attributes()->createMany($attributes);
        } else {
            $real_state->attributes()->delete();
        }
        if (count($images) > 0) {
            $imageIds = collect($images)->pluck('id');
            $real_state->images()->whereIn('id', $imageIds)->delete();
            $real_state->images()->createMany($images);
        } else {
            $real_state->images()->delete();
        }
        RealEstateManager::setTranslation($real_state, $request);
        return $real_state;
    }
    public function delete($request)
    {
        $real_state = $this->real_state->findOrFail($request->id);
        $real_state->tags()->detach();
        $real_state->attributes()->delete();
        $real_state->images()->delete();
        $real_state->delete();
        return $real_state;
    }

    public function change_status($status, $real_state_id)
    {
        # code...
        $real_state = $this->real_state->findOrFail($real_state_id);
        $real_state->update([
            'status' => $status
        ]);
        return $real_state;
    }
    public function get_realstates_by_category($data)
    {
        $category = "";
        if ($data['cat_type'] === 'category') {
            $category = categories::findOrFail($data['cat_id']);
        } elseif ($data['cat_type'] === 'sub_categories') {
            $category = sub_categories::findOrFail($data['cat_id']);
        } elseif ($data['cat_type'] === 'Childcategory') {
            $category = Childcategory::findOrFail($data['cat_id']);
        } else {
            return [];
        }
        return $category->realstates()->active()->get();
    }
    public function get_user_realstates($user_id)
    {
        $user = User::findOrFail($user_id);
        return $user->real_states;
    }
    public function get_real_estates_by_city($city)
    {
        return $city->real_states;
    }
    public function nearby_real_estates($lat, $long)
    {
        # code...
        $radius = 5;
        $real_states = $this->real_state->active()
            ->with(['attributes', 'images', 'category'])
            ->whereRaw("ST_Distance_Sphere(point(longtitude, latitude), point(?, ?)) <= ?", [$long, $lat, $radius * 1609.34])
            ->get();

        return $real_states;


    }
    public function get_real_estates_by_state($state_id)
    {
        # code...
        $realEstates = $this->real_state->whereHas('city', function ($query) use ($state_id) {
            $query->where('state_id', $state_id);
        })->get();
        return $realEstates;
    }
}

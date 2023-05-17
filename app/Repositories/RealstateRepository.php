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
        // Get the category for the real estate object based on the cat_id and cat_type in the input request
        $category = $this->getCategory($request['cat_id'], $request['cat_type']);

        $request['cat_id'] = $category->id;
        $request['cat_type'] = get_class($category);

        unset($request['images'], $request['tags'], $request['attributes']);
        // $request['user_id'] = $user_id;
        $request['user_id'] = null;
        // Get an array of tag IDs from the input request
        $tagIds = collect($tags)->pluck('tag_id')->toArray();
        // Create a new real estate object with the input request
        $real_state = Realstate::create($request->all());

        // Associate the real estate object with its category
        $real_state->category()->associate($category);
        // Attach the real estate object to its tags
        $real_state->tags()->attach($tagIds);
        // Create attributes for the real estate object
        // $real_state->attributes()->createMany($attributes);
        foreach ($attributes as $attribute) {
            $temp = $real_state->attributes()->create($attribute);
            AttributeManager::setTranslation($temp, $attribute);
        }
        // Create images for the real estate object
        $real_state->images()->createMany($images);
        // Set the translations for the real estate object (if applicable)
        // RealEstateManager::setTranslation($real_state, $request);

        return $real_state;
    }

    public function update($request)
    {
        $real_state = Realstate::findOrFail($request->id);

        $images = $request['images'] ?? [];
        $tags = $request['tags'] ?? [];
        $attributes = $request['attributes'] ?? [];
        // Get the category object for the given cat_id and cat_type, and set the corresponding fields in $request

        $category = $this->getCategory($request['cat_id'], $request['cat_type']);
        $request['cat_id'] = $category->id;

        $request['cat_type'] = get_class($category);
        unset($request['images'], $request['tags'], $request['attributes']);

        $tagIds = collect($tags)->pluck('tag_id')->toArray();

        // $request['user_id'] = $user_id;
        $request['user_id'] = null;
            // Update the real estate object with the remaining fields in $request
            $real_state->update($request->all());
            // Sync the tags with the given tag IDs, or detach them if no tags were provided
            if (count($tags) > 0) {
                $real_state->tags()->sync($tagIds);
            } else {
                $real_state->tags()->detach();
            }
            // Update the attributes with the given request, or delete them if no attributes were provided
            if (count($attributes) > 0) {
                $attributeIds = collect($attributes)->pluck('id');
                $real_state->attributes()->whereIn('id', $attributeIds)->delete();
                $real_state->attributes()->createMany($attributes);
            } else {
                $real_state->attributes()->delete();
            }
            // Update the images with the given request, or delete them if no images were provided
            if (count($images) > 0) {
                $imageIds = collect($images)->pluck('id');
                $real_state->images()->whereIn('id', $imageIds)->delete();
                $real_state->images()->createMany($images);
            } else {
                $real_state->images()->delete();
            }
            // Update the translations of the real estate object
            // RealEstateManager::setTranslation($real_state,$request);
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
        $array = [];
        $real_states = Realstate::active()->with(['attributes', 'images', 'category'])->get();
        foreach ($real_states as $key => $real_state) {
            # code...
            $distance = $this->haversineDistance($lat, $long, $real_state->latitude, $real_state->longtitude);
            if ($distance <= $radius) {
                $array[] = $real_state;
            }
        }
        return $array;


    }
    public function get_real_estates_by_state($state_id)
    {
        # code...
        $realEstates = RealState::whereHas('city', function ($query) use ($state_id) {
            $query->where('state_id', $state_id);
        })->get();
        return $realEstates;

    }
    private function getCategory($id, $type)
    {
        switch ($type) {
            case 'categories':
                return categories::findOrFail($id);
            case 'subcategory':
                return sub_categories::findOrFail($id);
            case 'childcategory':
                return Childcategory::findOrFail($id);
            default:
                throw new Exception('Invalid category type.');
        }
    }


    private function haversineDistance($lat1, $lon1, $lat2, $lon2)
    {
        $R = 6371; // Earth's radius in kilometers

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLon / 2) * sin($dLon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $d = $R * $c;

        return $d;
    }

}

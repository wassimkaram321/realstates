<?php

namespace App\Repositories;

use App\Models\categories;
use App\Models\Childcategory;
use App\Models\Realstate;
use App\Models\sub_categories;
use App\Models\User;
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
    public function find($id)
    {
        $real_state = Realstate::with(['attributes', 'images', 'tags'])->active()->whereid($id)->get();
        return $real_state;
    }
    public function create(array $data, $user_id)
    {
        # code...
        $images = $data['images'] ?? [];
        $tags = $data['tags'] ?? [];
        $attributes = $data['attributes'] ?? [];
        // Get the category for the real estate object based on the cat_id and cat_type in the input data
        $category = $this->getCategory($data['cat_id'], $data['cat_type']);

        $data['cat_id'] = $category->id;
        $data['cat_type'] = get_class($category);

        unset($data['images'], $data['tags'], $data['attributes']);
        // $data['user_id'] = $user_id;
        $data['user_id'] = null;
        // Get an array of tag IDs from the input data
        $tagIds = collect($tags)->pluck('tag_id')->toArray();
        try {
            // Start a database transaction
            DB::beginTransaction();
            // Create a new real estate object with the input data
            $real_state = Realstate::create($data);
            // Associate the real estate object with its category
            $real_state->category()->associate($category);
            // Attach the real estate object to its tags
            $real_state->tags()->attach($tagIds);
            // Create attributes for the real estate object
            $real_state->attributes()->createMany($attributes);
            // Create images for the real estate object
            $real_state->images()->createMany($images);
            // Set the translations for the real estate object (if applicable)
            $this->setTranslation($real_state, $data);
            // Commit the database transaction
            DB::commit();
        } catch (Exception $ex) {
            // Rollback the database transaction if there is an exception
            DB::rollback();
            return $ex->getMessage();
        }
        return $real_state;
    }

    public function update($id, array $data, $user_id)
    {
        $real_state = Realstate::findOrFail($id);

        $images = $data['images'] ?? [];
        $tags = $data['tags'] ?? [];
        $attributes = $data['attributes'] ?? [];
        // Get the category object for the given cat_id and cat_type, and set the corresponding fields in $data
        $category = $this->getCategory($data['cat_id'], $data['cat_type']);
        $data['cat_id'] = $category->id;
        $data['cat_type'] = get_class($category);
        unset($data['images'], $data['tags'], $data['attributes']);

        $tagIds = collect($tags)->pluck('tag_id')->toArray();

        // $data['user_id'] = $user_id;
        $data['user_id'] = null;
        try {
            DB::beginTransaction();
            // Update the real estate object with the remaining fields in $data
            $real_state->update($data);
            // Sync the tags with the given tag IDs, or detach them if no tags were provided
            if (count($tags) > 0) {
                $real_state->tags()->sync($tagIds);
            } else {
                $real_state->tags()->detach();
            }
            // Update the attributes with the given data, or delete them if no attributes were provided
            if (count($attributes) > 0) {
                $attributeIds = collect($attributes)->pluck('id');
                $real_state->attributes()->whereIn('id', $attributeIds)->delete();
                $real_state->attributes()->createMany($attributes);
            } else {
                $real_state->attributes()->delete();
            }
            // Update the images with the given data, or delete them if no images were provided
            if (count($images) > 0) {
                $imageIds = collect($images)->pluck('id');
                $real_state->images()->whereIn('id', $imageIds)->delete();
                $real_state->images()->createMany($images);
            } else {
                $real_state->images()->delete();
            }
            // Update the translations of the real estate object
            $this->setTranslation($real_state, $data);
            DB::commit();
        } catch (Exception $ex) {
            DB::rollback();
            return $ex->getMessage();
        }
        return $real_state;
    }
    public function delete($id)
    {
        $real_state = Realstate::find($id);

        $real_state->tags()->detach();
        $real_state->attributes()->delete();
        $real_state->images()->delete();
        $real_state->delete();

        return true;
    }

    public function change_status($status, $real_state_id)
    {
        # code...
        $real_state = Realstate::whereid($real_state_id)->update([
            'status' => $status
        ]);
        return $real_state;
    }
    public function get_realstates_by_category($data)
    {
        # code...
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
        # code...
        $user = User::findOrFail($user_id);
        return $user->real_states;
    }
    private function getCategory($id, $type)
    {
        switch ($type) {
            case 'category':
                return categories::findOrFail($id);
            case 'subcategory':
                return sub_categories::findOrFail($id);
            case 'childcategory':
                return Childcategory::findOrFail($id);
            default:
                throw new Exception('Invalid category type.');
        }
    }

    private function setTranslation($real_state, $data)
    {
        $real_state->setTranslation('name', 'en', $data['name']);
        $real_state->setTranslation('name', 'ar', $data['name_ar']);
        $real_state->setTranslation('description', 'en', $data['description']);
        $real_state->setTranslation('description', 'ar', $data['description_ar']);
        $real_state->save();
    }
    public function rules()
    {
        # code...

        return [
            'name' => 'required',
            'name_ar' => 'required',
            'description' => 'required',
            'description_ar' => 'required',
            'price' => 'required',
            'space' => 'required',
            'slug' => 'nullable',
            'latitude' => 'nullable',
            'longtitude' => 'nullable',
            'cat_id' => 'nullable',
            'cat_type' => 'nullable',
            'user_id' => 'nullable',
            'image' => 'nullable',
            'status' => 'nullable',
            'tags' => 'nullable',
            'attributes' => 'nullable',
            'images' => 'nullable',
        ];
    }
    public function rules_update()
    {
        # code...
        return [
            'name' => 'nullable',
            'name_ar' => 'nullable',
            'description' => 'nullable',
            'description_ar' => 'nullable',
            'price' => 'nullable',
            'space' => 'nullable',
            'slug' => 'nullable',
            'latitude' => 'nullable',
            'longtitude' => 'nullable',
            'cat_id' => 'nullable',
            'cat_type' => 'nullable',
            'user_id' => 'nullable',
            'image' => 'nullable',
            'status' => 'nullable',
            'tags' => 'nullable',
            'attributes' => 'nullable',
            'images' => 'nullable',
        ];
    }
}

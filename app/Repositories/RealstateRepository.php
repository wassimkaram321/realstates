<?php

namespace App\Repositories;

use App\Manager\AttributeManager;
use App\Manager\FileManager;
use App\Manager\RealEstateManager;
use App\Models\categories;
use App\Models\Childcategory;
use App\Models\City;
use App\Models\Image;
use App\Models\Notification;
use App\Models\Package;
use App\Models\Realstate;
use App\Models\sub_categories;
use App\Models\User;
use App\Traits\NotificationTrait;
use Attribute;
use Exception;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
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
    use NotificationTrait;
    protected $real_state;
    protected $auth;

    public function __construct(Realstate $real_state, AuthorizationHandler $auth)
    {
        $this->real_state = $real_state;
        $this->auth = $auth;
    }
    public function all($request)
    {
        # code...
        App::setlocale($request->lang);
        return $this->real_state->with(['attributeValues', 'images', 'tags'])->get();
    }
    public function find($request)
    {
        $lang = $request->lang ?? 'en';
        App::setlocale($lang);
        return $this->real_state->where('id', $request->id)->with(['attributeValues', 'images', 'tags'])->first();
    }
    public function create($request)
    {
        if (Auth::user()->role_id != 1) //user
        {
            $packages = Package::where('id', $request->package_id)->with('features')->first();
            $hasFeature = $packages->features->contains('id', 2);
            if (!$hasFeature) {
                throw new Exception('Can not Add ');
            }
            else {

                //count user real estate for specific package
                $realstatecount = Realstate::where('package_id',  $request->package_id)
                ->where('user_id', Auth::user()->id )
                ->count();

                $realstatevalue = $packages->features->where('id', 2)->first();
                // dd($realstatecount , $realstatevalue->pivot->feature_value);
                if($realstatecount >= $realstatevalue->pivot->feature_value)//if user used all value
                {
                    throw new Exception('Can not Add ');
                }
            }

            if($packages->features->contains('id', 3))//feature
            {
                $request['feature'] = 1;
            }
            if($packages->features->contains('id', 4))//recommended
            {
                $request['Recommended'] = 1;
            }

        }
        $this->auth->canAdd();

        $tags = $request['tags'] ?? [];
        $request['user_id'] = Auth::user()->id;
        $attributes = $request['attributes'] ?? [];
        $realEstateData = $request->except(['images', 'tags', 'attributes']);

        $tagIds = collect($tags)->pluck('tag_id')->toArray();

        $real_state = $this->real_state->create($realEstateData);

        $real_state->tags()->attach($tagIds);

        foreach ($attributes as $attribute) {

            $real_state->attributes()->attach($attribute['id'], [
                'selected_value' => $attribute['value_id'],
            ]);
        }
        RealEstateManager::setTranslation($real_state, $request);
        return $real_state;
    }
    //
    public function create_image($request)
    {
        $real_state = $this->real_state->where('id', $request->id)->first();

        if ($request->file('image')) {
            $file_name  = (new FileManager())->addFile($request->file('image'), 'images/real_estate_images');
            $real_state->image = $file_name;
            $real_state->save();
        }
        $real_state->images()->delete();
        $images = $request['images'] ?? [];

        foreach ($images as $i) {
            $file_name = (new FileManager())->addFile($i['name'], 'images/real_estate_images');
            $image_data = ['name' => $file_name, 'alt' => $i['alt'], 'realstate_id' => $real_state->id];
            $real_state->images()->create($image_data);
        }
        return $real_state;
    }
    //


    public function update($request)
    {

        $real_state = Realstate::whereid($request->id)->first();

        $tags = $request['tags'] ?? [];
        $attributes = $request['attributes'] ?? [];



        $tagIds = collect($tags)->pluck('tag_id')->toArray();

        $realEstateData = $request->except(['images', 'tags', 'attributes']);

        if (count($tags) > 0) {
            $real_state->tags()->sync($tagIds);
        } else {
            $real_state->tags()->detach();
        }

        DB::table('realestate_attributes')->where('realestate_id', $real_state->id)->delete();
        foreach ($attributes as $attribute) {
            $real_state->attributes()->attach($attribute['id'], [
                'selected_value' => $attribute['selected_value'],
            ]);
        }
        $real_state->update($realEstateData);
        RealEstateManager::setTranslation($real_state, $request);
        return $real_state;
    }

    public function update_image($request)
    {
        $image = Image::findOrFail($request->id);
        $file_name = (new FileManager())->addFile($request->image, 'images/real_estate_images');
        $image->name =  $file_name;
        $image->alt  =  $request->alt;
        $image->save();
        return  $image;
    }
    public function delete($request)
    {
        $real_state = $this->real_state->findOrFail($request->id);
        DB::table('realestate_attributes')->where('realestate_id', $real_state->id)->delete();
        $real_state->tags()->detach();
        $real_state->attributes()->delete();
        $real_state->images()->delete();
        $real_state->delete();
        return $real_state;
    }

    public function change_status($status, $real_state_id)
    {
        $real_state = $this->real_state->findOrFail($real_state_id);
        $real_state->update([
            'status' => $status
        ]);

        $user = User::where('id', $real_state->user_id)->where('enable_notification', 1)->first();

        if (isset($user)) {
            $body = $real_state->name . "'s status has been updated.";
            $notification = Notification::create([
                'title' => 'real estate',
                'body'  => $body,
            ]);
            $notification->users()->attach(['user_id' => $user->id]);
            if (isset($user->device_token)) {
                $this->send_notification($user->device_token, 'real estate', $body);
            }
        }

        return $real_state;
    }
    public function get_realstates_by_category($data)
    {
        App::setlocale($data->lang);
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

    public function change_feature($feature, $real_state_id)
    {
        $real_state = $this->real_state->findOrFail($real_state_id);
        $real_state->update([
            'feature' => $feature
        ]);
        return $real_state;
    }
    public function get_feature()
    {
        $feature = $this->real_state->where('feature', '1')->get();
        return $feature;
    }
    //Recommended
    public function change_recommended($recommended, $real_state_id)
    {
        $real_state = $this->real_state->findOrFail($real_state_id);
        $real_state->update([
            'Recommended' => $recommended
        ]);
        return $real_state;
    }
    public function get_recommended()
    {
        $Recommended = $this->real_state->where('Recommended', '1')->get();
        return $Recommended;
    }
}

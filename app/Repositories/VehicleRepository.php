<?php

namespace App\Repositories;

use App\Manager\FileManager;
use App\Manager\RealEstateManager;
use App\Models\Notification;
use App\Models\Package;
use App\Models\User;
use App\Models\Vehicle;
use App\Traits\NotificationTrait;
use Exception;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;


class VehicleRepository
{
    use NotificationTrait;
    protected $Vehicle;


    public function __construct(Vehicle $Vehicle)
    {
        $this->Vehicle = $Vehicle;
    }

    // Add your methods here
    public function all($request)
    {
        $lang = $request->lang ?? 'en';
        App::setlocale($lang);
        return $this->Vehicle::with(
            'attributeValues',
            'package',
            'user:id,name',
            'category:id,name,icon',
            'subcategory:id,name,icon',
            'childcategory:id,name',
        )
            ->get();
    }

    public function find($request)
    {
        $lang = $request->lang ?? 'en';
        App::setlocale($lang);
        $vehicle = $this->Vehicle::with(
            'images:id,vehicle_id,name,alt',
            'user:id,name',
            'attributeValues',
            'package',
            'category:id,name,icon',
            'subcategory:id,name,icon',
            'childcategory:id,name',
            'tags',
        )
            ->where('id', $request->id)->first();

        $vehicle->image = asset(URL::to('/') . '/' . 'public/images/Vehicle_images/' . $vehicle->image);
        $vehicle->images->map(function ($image) {
            $image->name = asset(URL::to('/') . '/' . 'public/images/Vehicle_images/' . $image->name);
        });

        return $vehicle;
    }

    public function create($request)
    {
        if (Auth::user()->role_id != 1) //user
        {
            $packages = Package::where('id', $request->package_id)->with('features')->first();
            $hasFeature = $packages->features->contains('id', 5);
            if (!$hasFeature) {
                throw new Exception('Can not Add ');
            } else {

                //count user real estate for specific package
                $realstatecount = Vehicle::where('package_id',  $request->package_id)
                    ->where('user_id', Auth::user()->id)
                    ->count();

                $realstatevalue = $packages->features->where('id', 5)->first();
                if ($realstatecount >= $realstatevalue->pivot->feature_value) //if user used all value
                {
                    throw new Exception('Can not Add ');
                }
            }

            if ($packages->features->contains('id', 3)) //feature
            {
                $request['feature'] = 1;
            }
            if ($packages->features->contains('id', 4)) //recommended
            {
                $request['Recommended'] = 1;
            }
        }
        // $this->auth->canAdd();

        $tags = $request['tags'] ?? [];
        $request['user_id'] = Auth::user()->id;
        $attributes = $request['attributes'] ?? [];
        $vehicleData = $request->except(['images', 'tags', 'attributes']);

        $tagIds = collect($tags)->pluck('tag_id')->toArray();

        $vehicle = $this->Vehicle->create($vehicleData);

        $vehicle->tags()->attach($tagIds);

        foreach ($attributes as $attribute) {

            $vehicle->attributes()->attach($attribute['id'], [
                'selected_value' => $attribute['selected_value'],
            ]);
        }
        RealEstateManager::setTranslation($vehicle, $request);
        return $vehicle;
    }

    public function update($request)
    {
        $vehicle = $this->Vehicle::findOrFail($request->id);

        $tags = $request['tags'] ?? [];
        $attributes = $request['attributes'] ?? [];

        $tagIds = collect($tags)->pluck('tag_id')->toArray();

        $vehicleData = $request->except(['images', 'tags', 'attributes']);

        if (count($tags) > 0) {
            $vehicle->tags()->sync($tagIds);
        } else {
            $vehicle->tags()->detach();
        }

        DB::table('realestate_attributes')->where('realestate_id', $vehicle->id)->delete();
        foreach ($attributes as $attribute) {
            $vehicle->attributes()->attach($attribute['id'], [
                'selected_value' => $attribute['selected_value'],
            ]);
        }
        $vehicle->update($vehicleData);
        RealEstateManager::setTranslation($vehicle, $request);
        return $vehicle;
    }

    public function delete($id)
    {
        $vehicle = $this->Vehicle->findOrFail($id);
        DB::table('vehicles_attributes')->where('vehicle_id', $vehicle->id)->delete();
        $vehicle->tags()->detach();
        foreach($vehicle->images as $image) {
            (new FileManager())->deleteFile($image->name, 'images/Vehicle_images');
        }
        $vehicle->images()->delete();
        $vehicle->delete();
        return $vehicle;
    }

    public function create_image($request)
    {
        $Vehicle = $this->Vehicle->where('id', $request->id)->first();

        if ($request->file('image')) {
            $file_name  = (new FileManager())->addFile($request->file('image'), 'images/Vehicle_images');
            $Vehicle->image = $file_name;
            $Vehicle->save();
        }
        $Vehicle->images()->delete();
        $images = $request['images'] ?? [];

        foreach ($images as $i) {
            $file_name = (new FileManager())->addFile($i['name'], 'images/real_estate_images');
            $image_data = ['name' => $file_name, 'alt' => $i['alt'], 'realstate_id' => $Vehicle->id];
            $Vehicle->images()->create($image_data);
        }
        return $Vehicle;
    }

    public function change_status($status, $vehicle_id)
    {
        $vehicle = $this->Vehicle->findOrFail($vehicle_id);
        $vehicle->update([
            'status' => $status
        ]);

        $user = User::where('id', $vehicle->user_id)->where('enable_notification', 1)->first();

        if (isset($user)) {
            $body = $vehicle->name . "'s status has been updated.";
            $notification = Notification::create([
                'title' => 'vehicle',
                'body'  => $body,
            ]);
            $notification->users()->attach(['user_id' => $user->id]);
            if (isset($user->device_token)) {
                $this->send_notification($user->device_token, 'vehicle', $body);
            }
        }

        return $vehicle;
    }

    public function change_feature($feature, $vehicle_id)
    {
        $vehicle = $this->Vehicle->findOrFail($vehicle_id);
        $vehicle->update([
            'feature' => $feature
        ]);
        return $vehicle;
    }

    public function change_recommended($recommended, $vehicle_id)
    {
        $vehicle = $this->Vehicle->findOrFail($vehicle_id);
        $vehicle->update([
            'Recommended' => $recommended
        ]);
        return $vehicle;
    }

    public function get_recommended($request)
    {
        $lang = $request->lang ?? 'en';
        App::setlocale($lang);
        $Recommended = $this->Vehicle->where('Recommended', '1')
            ->with(
                'attributeValues',
                'package',
                'user:id,name',
                'category:id,name,icon',
                'subcategory:id,name,icon',
                'childcategory:id,name',
            )->get();
        return $Recommended;
    }

    public function get_feature($request)
    {
        $lang = $request->lang ?? 'en';
        App::setlocale($lang);
        $feature = $this->Vehicle->where('feature', '1')
            ->with(
                'attributeValues',
                'package',
                'user:id,name',
                'category:id,name,icon',
                'subcategory:id,name,icon',
                'childcategory:id,name',
            )->get();

        return $feature;
    }

    public function get_user_vehicles($request)
    {
        $lang = $request->lang ?? 'en';
        App::setlocale($lang);
        $vehicles = $this->Vehicle->where('user_id', Auth::user()->id)
            ->with(
                'attributeValues',
                'package',
                'category:id,name,icon',
                'subcategory:id,name,icon',
                'childcategory:id,name',
            )->get();

        return $vehicles;
    }

    public function nearby_vehicle($lat, $long)
    {
        $radius = 5;
        $vehicle = $this->Vehicle->active()
            ->with(
                'attributeValues',
                'package',
                'category:id,name,icon',
                'subcategory:id,name,icon',
                'childcategory:id,name',
            )
            ->whereRaw("ST_Distance_Sphere(point(longtitude, latitude), point(?, ?)) <= ?", [$long, $lat, $radius * 1609.34])
            ->get();

        return $vehicle;
    }
}

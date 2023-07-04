<?php

namespace App\Repositories;

// use App\Models\Repositories;
use App\Manager\FileManager;

use App\Models\Ad;
use App\Models\Notification;
use App\Models\Package;
use App\Models\User;
use App\Traits\NotificationTrait;
use Exception;
use Illuminate\Support\Facades\Auth;

class AdRepository
{
    use NotificationTrait;
    protected $Ad;


    public function __construct(Ad $Ad)
    {
        $this->Ad = $Ad;
    }

    // Add your methods here
    public function all()
    {
        return $this->Ad::with(['package:id,name','user:id,name'])->get();
    }

    public function find($id)
    {
        return $this->Ad::where('id',$id)->with(['package:id,name','user:id,name'])->first();
    }

    public function create($request)
    {
        if (Auth::user()->role_id != 1) //user
        {
            $packages = Package::where('id', $request->package_id)->with('features')->first();

            $hasFeature = $packages->features->contains('id', 1);
            if (!$hasFeature) {
                throw new Exception('Can not Add.');
            } else {

                //count package Ads
                $adsCount = Ad::where('package_id',  $request->package_id)->where('user_id',  Auth::user()->id)
                    ->count();

                $adsValue = $packages->features->where('id', 1)->first();

                if ($adsCount >= $adsValue->pivot->feature_value) {
                    throw new Exception('Can not Add');
                }
            }
        }
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
        $ad = $this->Ad->create($input);
        if ($request->file('image')) {
            $file_name = (new FileManager())->addFile($request->file('image'), 'images/ADS');
            $ad->image = $file_name;
            $ad->save();
        }
        return $ad;
        // return $this->Ad::create($data);
    }

    public function update($request)
    {
        $model = $this->Ad::where('id', $request->id)->first();
        $input = $request->all();
        if ($request->file('image')) {
            $file_name = (new FileManager())->addFile($input['image'], 'images/real_estate_images');
            $input['image'] =  $file_name;
        }
        $model->update($input);

        return $model;
    }

    public function UpdateStatus($request)
    {
        $ad = $this->Ad->findOrFail($request->id);
        $ad->is_active = $request->is_active;
        $ad->save();


        $user = User::where('id', $ad->user_id)->where('enable_notification', 1)->first();

        if (isset($user)) {
            $body = "Your AD's status has been updated.";
            $notification = Notification::create([
                'title' => 'ADs',
                'body'  => $body,
            ]);
            $notification->users()->attach(['user_id' => $user->id]);
            if (isset($user->device_token)) {
                $this->send_notification($user->device_token, 'ADs', $body);
            }
        }

        return $ad;
    }
    public function AdClick($request)
    {
        $ad = $this->Ad->findOrFail($request->id);
        $ad->increment('click_counts');
    }

    public function delete($id)
    {
        $model = $this->Ad::findOrFail($id);
        $model->delete();
        return $model;
    }

    public function rules()
    {
        return [];
    }

    public function rules_update()
    {
        return [];
    }
}

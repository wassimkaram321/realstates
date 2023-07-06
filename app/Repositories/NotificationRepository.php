<?php

namespace App\Repositories;

use App\Models\Notification;
use App\Models\User;
use App\Traits\NotificationTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotificationRepository
{
    use NotificationTrait;
    protected $notification;

    public function __construct(Notification $notification)
    {
        $this->notification = $notification;
    }

    public function all($request)
    {
        return $this->notification->where('by_admin', 1)->orderBy('created_at', 'desc')->get();
    }

    public function userNotifications()
    {
        $auth = Auth::user();
        // $user = User::where('id', $auth->id)->first();
        return $auth->notifications;
    }

    public function find($id)
    {
        return $this->notification::findOrFail($id);
    }

    public function create(array $data)
    {
        $data['by_admin'] = 1;
        $notification = $this->notification->create($data);
        if (!isset($dara['package_id']) || $dara['package_id'] == null) {
            $users = User::where('enable_notification', 1)->where('role_id', 2)->get();
        } else {
            // add code to send the notification to the users how has the package_id
        }
        foreach ($users as $user) {
            $notification->users()->attach(['user_id' => $user->id]);
            if (isset($user->device_token)) {
                $this->send_notification($user->device_token, $data['title'], $data['body']);
            }
        }
        return $notification;
    }

    public function update(array $data, $id)
    {
        $model = $this->notification::findOrFail($id);
        $model->update($data);
        return $model;
    }

    public function delete($id)
    {
        $model = $this->notification::findOrFail($id);
        $model->delete();
        return $model;
    }

    public function seeAll($request)
    {
        DB::table('user_notification')->where('user_id', '=',  Auth::id())->update(['seen' => 1, 'seen_at' => now()]);
    }
    public function unseenCount($request)
    {
        $user = User::where('id', Auth::id())->first();
        return $user->notifications()->where('seen', 0)->orderBy('created_at', 'desc')->count();
    }

}

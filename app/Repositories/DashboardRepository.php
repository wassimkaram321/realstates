<?php

namespace App\Repositories;

use App\Models\Realstate;
use App\Models\User;

class DashboardRepository
{
    protected $DashboardRepository;

    public function __construct()
    {

    }

    // Add your methods here
    public function index($request)
    {
        $users = User::get()->count();
        $latest_users = User::latest()->get();
        $realestates = Realstate::get()->count();
        $latest_realestates = Realstate::latest()->get();
        $data = [
            'users'=> $users,
            'latest_users'=> $latest_users,
            'realestates'=> $realestates,
            'latest_realestates'=> $latest_realestates,
        ];
        return $data;
    }


}

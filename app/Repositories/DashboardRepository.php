<?php

namespace App\Repositories;

use App\Models\Realestat_booking;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
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
        $users                 = User::get()->count();
        $latest_users          = User::latest()->get();
        $realestates           = Realstate::get()->count();
        $latest_realestates    = Realstate::latest()->get();
        $available_realestates = Realstate::where('ava', 1)->get()->count();
        $realestat_booking     = Realestat_booking::get()->count();
        $data = [
            'users'                 => $users,
            'latest_users'          => $latest_users,
            'realestates'           => $realestates,
            'latest_realestates'    => $latest_realestates,
            'realestat_booking'     => $realestat_booking,
            'available_realestates' => $available_realestates,

        ];
        return $data;
    }

    public function last_booking()
    {
        $last_bookings     = Realestat_booking::with('realestate', 'user')->take(5)->get();
        foreach ($last_bookings  as    $last_booking) {
            $data[] = array(
                'client_name'     => $last_booking->user->name,
                'owner'           => $last_booking->realestate->owner->name,
                'realestat_name'  => $last_booking->realestate->name,
                'realestat_price' => $last_booking->realestate->price,
            );
        }
        return $data;
    }
    
    public function weekly_booking()
    {
     $query = DB::table('realestat_bookings')
        ->select(DB::raw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as realestate_count'))
        ->groupBy('year', 'month')
        ->orderBy('year', 'desc')
        ->orderBy('month', 'desc')
        ->get();
       return $query;
    }
    
    function countRealEstatesByCity()
    {
        $querys = Realstate:://DB::table('real_states')->
            select('city_id', DB::raw('COUNT(*) as estate_count'))
            ->groupBy('city_id')
            ->get();
            
        foreach($querys as $query)
        {
            $data[] =  array(
                'city'         => $query->city->name,
                'estate count' => $query->estate_count,
                );
        }
        return $data;
        }
    
    function getTopBookedUsers()
    {
       $baseURL = URL::to('/');
       $querys = Realstate::with('owner')
        ->select('user_id', DB::raw('COUNT(*) as booked_count'))
        ->where('ava', 0)
        ->groupBy('user_id')
        ->orderBy('booked_count', 'desc')
        ->limit(5)
        ->get();
        
        foreach($querys as $query)
        {
            $name = DB::table('roles')->where('id',$query->owner->role_id)->first();//relation هاد السطر غبا لازم بدلو ب 
            $data[] =  array(
                'user name'      => $query->owner->name,
                'user image'     => asset($baseURL . '/'.'public/images/users/' . $query->owner->image) ?? '',
                'role name'      => $name->name,
                'realestate num' => $query->booked_count,
                );
        }
        return $data;
    }

}

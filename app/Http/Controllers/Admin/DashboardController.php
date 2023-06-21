<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\DashboardRepository;
use Illuminate\Support\Facades\Request;

class DashboardController extends Controller
{
    //
    protected $dashboardRepository;
    public function __construct(DashboardRepository $dashboardRepository)
    {
        $this->dashboardRepository = $dashboardRepository;
    }
    public function index(Request $request)
    {
        $data =  $this->dashboardRepository->index($request);
        return $this->success('success',$data);
    }

    public function last_booking()
    {
        $data =  $this->dashboardRepository->last_booking();
        return $this->success('success',$data);
    }
    
    public function weekly_booking()
    {
        $data =  $this->dashboardRepository->weekly_booking();
        return $this->success('success',$data);
    }
    
    public function countRealEstatesByCity()
    {
        $data =  $this->dashboardRepository->countRealEstatesByCity();
        return $this->success('success',$data);
    }
    
    public function getTopBookedUsers()
    {
        $data =  $this->dashboardRepository->getTopBookedUsers();
        return $this->success('success',$data);
    }
    

}

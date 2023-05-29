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
}

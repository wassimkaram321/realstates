<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewRequest;
use App\Models\Realstate;
use App\Repositories\RealstateRepository;
use App\Repositories\ReviewRepository;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    //
    protected $reviewRepository;
    public function __construct(ReviewRepository $reviewRepository)
    {
        $this->reviewRepository = $reviewRepository;
    }
    public function RealestateReviews(ReviewRequest $request)
    {
        # code...
        return $this->reviewRepository->RealestateReviews($request);
    }
    public function makeRealestateReview(ReviewRequest $request)
    {
        # code...
        return $this->reviewRepository->makeReview($request);
    }
    public function deleteRealestateReview(ReviewRequest $request)
    {
        # code...
        return $this->reviewRepository->deleteReview($request);
    }
    public function statusChange(ReviewRequest $request)
    {
        return $this->reviewRepository->statusChange($request);
    }
}

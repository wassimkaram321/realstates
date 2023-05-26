<?php

namespace App\Repositories;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReviewResource;
use App\Models\Realstate;
use Digikraaft\ReviewRating\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewRepository  extends Controller
{


    public function __construct()
    {

    }

    // Add your methods here
    public function RealestateReviews($request){
        $realestate_reviews = Realstate::findOrFail($request->id)->reviews()->active()->get();
        return $this->success('success',ReviewResource::collection($realestate_reviews));
    }
    public function makeReview($request)
    {
        $realestate = Realstate::findOrFail($request->realestate_id);
        $user = Auth::user();
        if ($realestate->hasReviewed(auth()->user()))
            return $this->error_message('user has reviewed this realestate');
        $realestate->review($request->review,$user,$request->rate);
        return $this->success('success',[]);
    }

    public function deleteReview($request)
    {
        Review::findOrFail($request->id)->delete();
        return $this->success('success',[]);
    }
    public function statusChange($request)
    {
        Review::findOrFail($request->id)->update([
            'status' => $request->status,
        ]);
        return $this->success('success',[]);
    }


}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Tour;

class ReviewController extends Controller
{
    protected $review;
    protected $tour;

    public function __construct(Review $review, Tour $tour)
    {
        $this->review = $review;
        $this->tour = $tour;
    }

    public function index($tour_id)
    {
        return view('admin.reviews.index', compact('tour_id'));
    }

    public function edit($id)
    {
        $data = $this->review->showReview($id);
        return response()->json([
            'data' => $data,
            'code' => 200,
            'message' => 'Show successfully'
        ], 200);
    }

    public function changeStatus($tour_id, $id, $status)
    {
        $this->review->changeStatus($id, $status);
        return SUCCESS;
    }

    public function getListReview(Request $request, $tour_id)
    {
        return $this->review->getListReviewByAjax($request, $tour_id);
    }
}

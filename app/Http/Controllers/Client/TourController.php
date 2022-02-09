<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tour;
use App\Models\Faqs;
use App\Models\Gallery;
use App\Models\Itinerary;
use App\Models\Review;
use App\Models\TypeOfTour;

class TourController extends Controller
{
    protected $tour;
    protected $gallery;
    protected $faqs;
    protected $review;
    protected $type;

    public function __construct(Tour $tour, Gallery $gallery, Faqs $faqs, Review $review, TypeOfTour $type)
    {
        $this->tour = $tour;
        $this->gallery = $gallery;
        $this->faqs = $faqs;
        $this->review = $review;
        $this->type = $type;
    }

    public function listTour(Request $request)
    {
        $type = $this->type->listType();
        $tours = $this->tour->with('destinations')->where('status', ACTIVE);

        if ($request->ajax()) {
            $min = $request->min;
            $max = $request->max;
            $tours->WhereBetween('price', [$min, $max]);
            $durations = $request->duration ?? [];
            $types = $request->type ?? [];
            $tours->whereIn('type_id', $types);
            $tours->where(function ($query) use ($durations) {
                foreach ($durations as $key => $value) {
                    if ($value <= 5) {
                        $query->OrWhereBetween('duration', [$value, $value + 2]);
                    } else {
                        $query->OrWhereBetween('duration', [$value, $value + 999]);
                    }
                }
            });
            $tour = $tours->paginate(3);
            $response = [
                'view'=> view('client.filterTour', ['tour'=> $tour])->render()
            ];
            return response()->json($response);
        }
        $tour = $tours->paginate(3);
        return view('client.listTour', compact('tour', 'type'));
    }

    public function filter(Request $request)
    {
        return $this->tour->filterInListTour($request);
    }

    public function tourDetail($duration, $slug)
    {
        $detail = $this->tour->tourDetail($duration, $slug);
        $tourId = $this->tour->tourId($duration, $slug);
        $gallery = $this->gallery->listGallery($tourId->id);
        $itineraries =Itinerary::with('placeItineraries')->where('tour_id', '=', $tourId->id)->get();
        $faqs = $this->faqs->listFaqs($tourId->id);
        $related = $this->tour->relatedTour($tourId->destination_id);
        $rating = $this->review->rating($tourId->id);
        $review = $this->review->review($tourId->id);
        $count = $this->review->countReview($tourId->id);
        $type = $this->type->find($tourId->type_id);
        $listReviewByStar = $this->review->listReviewByStar($tourId->id);
        return view('client.tourDetail', compact('duration', 'slug', 'type', 'detail', 'gallery', 'itineraries', 'faqs', 'review', 'rating', 'count', 'related', 'listReviewByStar'));
    }

    public function storeReview(Request $request, $duration, $slug)
    {
        $params = $request->only(['content', 'star']);
        $request->validate([
            'content' => ['required', 'string', 'min:4', 'max:255'],
        ]);
        if ($request->has('star')) {
            $tourId = $this->tour->tourId($duration, $slug);
            $this->review->storeReview($params, $tourId->id);
            $tabId = $request->input('tabId');
            return redirect()->back()->with('tabId', $tabId);
        } else {
            $tabId = $request->input('tabId');
            return redirect()->back()->with('tabId', $tabId)
                                     ->with('alert', 'Star rating is required');
        }
    }
}

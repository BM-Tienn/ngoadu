<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\Itinerary;
use App\Models\Faqs;

class ItineraryController extends Controller
{
    protected $itinerary;
    protected $faqs;

    public function __construct(Itinerary $itinerary, Faqs $faqs)
    {
        $this->itinerary = $itinerary;
        $this->faqs = $faqs;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($tour_id)
    {
        $info = $this->faqs->showInformation($tour_id);
        $listItinerary = $this->itinerary->listItinerary($tour_id);
        return view('admin.itineraries.index', compact('info', 'listItinerary', 'tour_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            return $this->itinerary->storeData($request);
        } catch (\Exception $e) {
            return FAILURE;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->itinerary->showInformation($id);
        return response()->json([
            'itinerary' => $data,
            'code' => 200,
            'message' => 'Show successfully'
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            return $this->itinerary->updateData($request, $id);
        } catch (\Exception $e) {
            return FAILURE;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->itinerary->deleteItinerary($id);
    }

    public function getListItinerary($tour_id)
    {
        return $this->itinerary->getListItineraryByAjax($tour_id);
    }
}

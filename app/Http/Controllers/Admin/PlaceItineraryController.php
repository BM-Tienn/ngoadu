<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\PlaceItinerary;
use App\Models\Itinerary;

class PlaceItineraryController extends Controller
{
    protected $placeItinerary;
    protected $itinerary;

    public function __construct(PlaceItinerary $placeItinerary, Itinerary $itinerary)
    {
        $this->placeItinerary = $placeItinerary;
        $this->itinerary = $itinerary;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($tour_id, $itinerary_id)
    {
        $info = $this->itinerary->showInformation($itinerary_id);
        return view('admin.placeItineraries.index', compact('info', 'itinerary_id', 'tour_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->placeItinerary->rule());
        $this->placeItinerary->storeData($request);
        return redirect()->back()->with(['alert-type' => 'success', 'message' => 'Lưu trữ dữ liệu thành công' ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $showInformation = $this->placeItinerary->showInformation($id);
        return Response::json(['success'=>true, 'place'=>$showInformation]);
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
        $request->validate($this->placeItinerary->rule());
        $this->placeItinerary->updateData($request, $id);
        return redirect()->back()->with(['alert-type' => 'success', 'message' => 'Thay đổi dữ liệu thành công' ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->placeItinerary->find($id)->delete();
        return SUCCESS;
    }

    public function getListPlace($tour_id, $itinerary_id)
    {
        return $this->placeItinerary->getListPlaceByAjax($tour_id, $itinerary_id);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Destination;
use App\Models\TypeOfTour;
use App\Models\Tour;

class TourController extends Controller
{
    protected $tour;
    protected $destination;
    protected $type;

    public function __construct(Tour $tour, Destination $destination, TypeOfTour $type)
    {
        $this->tour = $tour;
        $this->destination = $destination;
        $this->type = $type;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $destination = $this->destination->listDestination();
        $type = $this->type->listType();
        return view('admin.tours.index', compact('destination', 'type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $destination = $this->destination->destinationOfTour();
        $type = $this->type->typeOfTour();
        return view('admin.tours.form', compact('destination', 'type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->tour->rule());
        $this->tour->storeData($request);
        return redirect()->route('tour.index')->with(['alert-type' => 'success', 'message' => 'Lưu trữ dữ liệu thành công' ]);
    }

    /**
     * Show the form the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $record = $this->tour->showInformation($id);
        return view('admin.tours.show', compact('record'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $destination = $this->destination->listDestination();
        $type = $this->type->listType();
        $record = $this->tour->showInformation($id);
        return view('admin.tours.form', compact('record', 'destination', 'type'));
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
        $request->validate($this->tour->ruleUpdate($id));
        $this->tour->updateData($request, $id);
        return redirect()->route('tour.index')->with(['alert-type' => 'success', 'message' => 'Thay đổi dữ liệu thành công' ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->tour->deleteTour($id);
    }

    public function changeStatus($id, $status)
    {
        return $this->tour->changeStatus($id, $status);
    }

    public function changeAttractive($id, $priority)
    {
        return $this->tour->changeAttractive($id, $priority);
    }

    public function getListTour(Request $request)
    {
        return $this->tour->getListTourByAjax($request);
    }
}

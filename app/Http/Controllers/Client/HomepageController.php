<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Destination;
use App\Models\TypeOfTour;
use App\Models\Tour;


class HomepageController extends Controller
{
    protected $destination;
    protected $tour;
    protected $type;

    public function __construct(Destination $destination, Tour $tour, TypeOfTour $type)
    {
        $this->destination = $destination;
        $this->tour = $tour;
        $this->type = $type;
    }

    public function main()
    {
        $destination = $this->destination->getListDestination();
        $type = $this->type->listTypeOfTour();
        $countDestination = $destination->count();
        $countTour = $this->tour->countTour();
        $countType = $type->count();
        $attractiveTour = $this->tour->attractiveTour();
        $newTour = $this->tour->newTour();
        return view('client.index', compact('type', 'countDestination', 'countType', 'countTour', 'destination', 'attractiveTour', 'newTour'));
    }

    public function search(Request $request)
    {
        $search = $this->tour->search($request);
        $type = $this->type->listTypeOfTour();
        return view('client.searchTour', compact('search', 'type'));
    }
}

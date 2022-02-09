<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    public $model;
   
    public function __construct() {
        $this->model = new Booking();
        if ($booking = Session::get('booking') == null) {
            Session::get('booking')  == array();
        }
    }

    public function main()
    {
        return view('client.checkout');
    }

    public function thankyou()
    {
        return view('client.thank');
    }

    public function booking(Request $request)
    {
        $quantity = $request->quantity;
        $start = Str::substr($request->start_at, 0, 10);
        $id = $request->tour_id;
        $this->model->booking($id, $quantity, $start);
        return redirect()->route('client.booking');
    }

    public function changeBooking(Request $request)
    {
        $quantity = $request->quantity;
        $start = Str::substr($request->start_at, 0, 10);
        $id = $request->tour_id;
        $this->model->changeBooking($id, $quantity, $start);
        return redirect()->route('client.booking');
    }

    public function completeBooking(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'max:100'],
            'phone' => ['required', 'string', 'max:10'],
            'address' => ['bail', 'max:200'],
            'provide' => ['bail', 'max:50'],
            'country' => ['bail', 'max:50'],
            'code' => ['bail', 'max:50'],
            'note' => ['bail', 'max:500'],
            
        ]);
        $params = $this->getParams($request);
        $this->model->completeBooking($params);
        return redirect()->route('booking.thankyou');
    }

    private function getParams(Request $request)
    {
        return $request->only(['first_name', 'last_name', 'email', 'phone', 'address',
                                'city', 'provide', 'country', 'code', 'note', 'status', 'statuspayment']);
    }
}

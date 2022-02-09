<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class Booking extends Model
{
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    //     'first_name', 'last_name', 'email', 'phone', 'address', 'city',
    //     'provide', 'country', 'code', 'note', 'status', 'statuspayment',
    //     'tour_id', 'price', 'people', 'start_at',
    // ];

    protected $guarded = [];

    public function booking($id, $quantity, $start)
    {
        $tour = Tour::where('tours.id', $id)->first();
        $booking = Session::put('booking');
        if (!$booking) {
            $booking = [
                $id => [
                'id' => $tour->id,
                'title' => $tour->title,
                'duration' => $tour->duration,
                'price' => $tour->price,
                'destination' => $tour->destinations->title,
                'type' => $tour->types->title,
                'quantity' => $quantity,
                'start_at' => $start
                        ]
                    ];
                Session::put('booking', $booking);
        }
        $booking[$id] = [
                'id' => $tour->id,
                'title' => $tour->title,
                'duration' => $tour->duration,
                'price' => $tour->price,
                'destination' => $tour->destinations->title,
                'type' => $tour->types->title,
                'quantity' => $quantity,
                'start_at' => $start
        ];
        Session::put('booking', $booking);
    }

    public function completeBooking(array $params)
    {
        foreach (Session::get("booking") as $booking) {
            $params['tour_id'] = $booking["id"];
            $params['price'] = $booking["price"];
            $params['people'] = $booking["quantity"];
            $params['start_at'] = date('Y-m-d', strtotime($booking["start_at"]));
            $params['status'] = BOOKING_STATUS_NEW;
            $params['statuspayment'] = PAYINCASH;
        }
        $this->create($params);
        session()->forget('booking');
        return;
    }

    public function changeBooking($id, $quantity, $start)
    {
        $booking = Session::get('booking');
        $booking[$id]['quantity'] = $quantity;
        $booking[$id]['start_at'] = $start;
        Session::put('booking', $booking);
    }

    public function getListBooking($request)
    {
        $status = $request->status;
        $text = $request->filter_search;
        $data = $this->query();
        if ($status != ALL) {
            $data->where('status', $status);
        }
        if (!empty($text)) {
            $data->where(function ($q) use ($text) {
                $q->Where('first_name', 'like', '%' . $text . '%')
                ->orWhere('email', 'like', '%' . $text . '%')
                ->orWhere('phone', 'like', '%' . $text . '%');
            });
        }
        return $data->orderBy('id', 'desc')->get();
    }

    public function showInformation($id)
    {
        return $this->find($id);
    }

    public function tourBooking($id)
    {
        return Tour::where('tours.id', $id)->first();
    }

    public function updateStatus($params, $id)
    {
        return $this->find($id)->update(['status' => $params['status']]);
    }

    public function getListBookingByAjax($request)
    {
        $data = $this->getListBooking($request);
        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('name', function ($data) {
            return $data->first_name . ' ' . $data->last_name;
        })
        ->editColumn('status', function ($data) {
            if ($data->status == BOOKING_STATUS_NEW) {
                return '<button class="badge badge-info border-0 btn-new">New</button>';
            } elseif ($data->status == BOOKING_STATUS_CONFIRMED) {
                return '<button class="badge badge-primary border-0">Comfirmed</button>';
            } elseif ($data->status == BOOKING_STATUS_COMPLETED) {
                return '<button class="badge badge-success border-0">Completed</button>';
            } else {
                return '<button class="badge badge-danger border-0 btn-cancel">Cancel</button>';
            }
        })
        ->addColumn('total', function ($data) {
            return '$'. $data->people * $data->price.'.00';
        })
        ->addColumn('action', function ($data) {
            return '<a href="'. route('booking.edit', $data->id) .'" class="btn btn-sm btn-info align-middle text-white"><i class="fas fa-eye"></i></a>';
        })
        ->addColumn('start_at', function ($data) {
            return date('m/d/Y', strtotime($data->start_at));
        })
        ->rawColumns(['status', 'action'])
        ->make(true);
    }
}

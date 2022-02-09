<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PlaceItinerary;
use App\Libraries\Ultilities;
use Yajra\DataTables\Facades\DataTables;

class Itinerary extends Model
{
       /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'tour_id'];

    public function tours()
    {
        return $this->belongsTo(Tour::class, 'tour_id', 'id');
    }

    public function placeItineraries()
    {
        return $this->hasMany('App\Models\PlaceItinerary');
    }

    public function showInformation($id)
    {
        return $this->find($id);
    }

    public function listItinerary($tour_id)
    {
        return $this->where('tour_id', $tour_id)->get();
    }

    public function deleteItinerary($id)
    {
        $check = PlaceItinerary::where('itinerary_id', $id)->count();
        if ($check == 0) {
            $this->find($id)->delete();
            return SUCCESS;
        }
        return FAILURE;
    }

    public function rule($id = null)
    {
        return [
            'title' => ['required', 'string','max:100'],
        ];
    }

    public function storeData($request)
    {
        $params = $request->only(['title', 'tour_id']);
        $params['title'] = Ultilities::clearXSS($request->title);
        $tour = Tour::where('id', $params['tour_id'])->first();
        $count = $this->where('tour_id', $params['tour_id'])->count();
        $check = $this->where([['tour_id', $params['tour_id']], ['title', $params['title']]])->count();
        if ($tour->duration == $count) {
            return 0;
        } elseif ($check == 0) {
            $this->create($params);
            return 1;
        } else {
            return 2;
        }
    }

    public function updateData($request, $id)
    {
        $params = $request->only(['title']);
        $params['title_update'] = Ultilities::clearXSS($request->title);
        $tourId = $this->find($id);
        $check = $this->where([['tour_id', $tourId->tour_id],['title', $params['title_update']]])->whereNotIn('id', [$id])->count();
        if ($check == 0) {
            $this->find($id)->update(['title' => $params['title_update']]);
            return 1;
        } else {
            return 2;
        }
    }

    public function getListItineraryByAjax($tour_id)
    {
        $data = $this->listItinerary($tour_id);
        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('place', function ($data) {
            return '<a href="'. url('admin/tour/'.$data->tour_id.'/itinerary/'.$data->id.'/place') .'" class="btn btn-sm btn-link">Place</a>';
        })
        ->addColumn('action', function ($data) {
            return '<a data-id="' . $data->id . '" class="btn btn-sm btn-primary align-middle btn-edit text-white"><i class="fas fa-edit"></i></a> <a data-id="' . $data->id . '" class="btn-danger btn btn-sm align-middle btn-delete text-white"><i class="fas fa-trash-alt"></i></a>';
        })
        ->rawColumns(['place', 'action'])
        ->make(true);
    }
}

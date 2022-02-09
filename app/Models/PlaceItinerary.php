<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Libraries\Ultilities;
use Yajra\DataTables\Facades\DataTables;

class PlaceItinerary extends Model
{
       /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['itinerary_id', 'location', 'duration', 'description', 'note'];

    public function itineraries()
    {
        return $this->belongsTo(Itinerary::class, 'itinerary_id', 'id');
    }

    public function saveData($params, $id)
    {
        return $this->find($id)->update(['location' => $params['location'], 'duration' => $params['duration'],
        'description' => $params['description'], 'note' => $params['note']]);
    }

    public function listPlaceItinerary($id)
    {
        return $this->where('itinerary_id', $id)->get();
    }

    public function showInformation($id)
    {
        return $this->find($id);
    }

    public function rule()
    {
        return [
            'location' => ['required', 'string', 'max:255'],
            'duration' => ['bail', 'max:365'],
            'description' => ['required', 'string', 'max:800'],
            'note' => ['bail', 'max:100'],
        ];
    }

    public function storeData($request)
    {
        $params = $request->all();
        if (!isset($params['duration'])) {
            $params['duration'] = '';
            $params['note'] = '';
        }
        $params['destination'] = Ultilities::clearXSS($request->destination);
        $params['note'] = Ultilities::clearXSS($request->note);
        return $this->create($params);
    }

    public function updateData($request, $id)
    {
        $params = $request->all();
        if (!isset($params['duration'])) {
            $params['duration'] = '';
            $params['note'] = '';
        }
        $params['location'] = Ultilities::clearXSS($request->location_update);
        $params['description'] = Ultilities::clearXSS($request->description_update);
        $params['note'] = Ultilities::clearXSS($request->note);
        return $this->saveData($params, $id);
    }

    public function getListPlaceByAjax($tour_id, $itinerary_id)
    {
        $data = $this->listPlaceItinerary($itinerary_id);
        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($data) {
            return '<a data-id="' . $data->id . '" class="btn btn-sm btn-primary btn-circle btn-edit text-white"><i class="fas fa-edit"> </i></a> <a data-id="' . $data->id . '" class="btn-danger btn-circle  btn-custom  btn btn-sm btn-delete"><i class="fas fa-trash-alt text-white"></i></a>';
        })
        ->rawColumns(['action'])
        ->make(true);
    }
}

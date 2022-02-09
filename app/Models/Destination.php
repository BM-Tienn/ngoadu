<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Libraries\Ultilities;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class Destination extends Model
{
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'image', 'status', 'slug',
    ];

    public function tours()
    {
        return $this->hasMany(Tour::class);
    }

    public function changeStatus($id, $status)
    {

        if ($status == ACTIVE) {
            return $this->find($id)->update(['status' => INACTIVE]);
        } else {
            return $this->find($id)->update(['status' => ACTIVE]);
        }
    }

    public function listDestination()
    {
        return $this->orderBy('id', 'desc')->get();
    }

    public function getList($request)
    {
        $status = $request->status;
        $text = $request->filter_search;
        $data = $this->query();
        if ($status != ALL) {
            $data->where('status', $status);
        }
        if (!empty($text)) {
            $data->where('title', 'like', '%' . $text . '%');
        }
        return $data->orderBy('id', 'desc')->get();
    }

    public function destinationOfTour()
    {
        return $this->where('status', ACTIVE)->orderBy('id', 'desc')->get();
    }

    public function showInformation($id)
    {
        return $this->find($id);
    }

    public function rule($id = null)
    {
        return [
            'title' => ['required', 'string', 'max:100', 'unique:destinations'],
            'image' => ['required', 'image','mimes:jpeg,png,jpg,svg','max:5120'],
        ];
    }

    public function storeData($request)
    {
        $params = $request->all();
        $params['title'] = Ultilities::clearXSS($request->title);
        $params['slug'] = Str::slug($params['title'], '-');
        $params['image'] = time() . ".". $request->file('image')->getClientOriginalExtension();
        $request->file('image')->move('upload/destination', $params['image']);
        return $this->create($params);
    }

    public function ruleUpdate($id)
    {
        return [
            'title_update' => ['required', 'string', 'max:100', 'unique:destinations,title,'.$id],
            'image' => ['image','mimes:jpeg,png,jpg,gif,svg','max:5120', ($id == 0) ? 'required' :''],
        ];
    }

    public function updateData($request, $id)
    {
        $params = $request->all();
        $params['title'] = Ultilities::clearXSS($request->title_update);
        $params['slug'] = Str::slug($params['title'], '-');

        if ($request->hasFile('image')) {
            $params['image'] = time() . ".". $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move('upload/destination', $params['image']);
            $filePathName = 'upload/destination/' . $this->find($id)->image;
            if (file_exists($filePathName)) {
                unlink($filePathName);
            }
        } else {
            $params['image'] = $this->find($id)->image;
        }
        return $this->find($id)->update($params);
    }

    public function deleteDestination($id)
    {
        $destination = $this->find($id);
        $check = $destination->tours->count();
        if ($check == 0) {
            $filePathName = 'upload/destination/' . $destination->image;
            if (file_exists($filePathName)) {
                unlink($filePathName);
            }
            $destination->delete();
            return SUCCESS;
        } else {
            return FAILURE;
        }
    }

    public function getListDestinationByAjax($request)
    {
        $data = $this->getList($request);
        return DataTables::of($data)
        ->addIndexColumn()
        ->editColumn('status', function ($data) {
            return view('admin.common.actionStatus', ['data' => $data]);
        })
        ->addColumn('image', function ($data) {
            return '<img class="img-datatable" src="' . asset('upload/destination/' . $data->image) . '">';
        })
        ->addColumn('action', function ($data) {
            return '<a data-id="' . $data->id . '" class="btn btn-sm btn-primary align-middle btn-edit text-white"><i class="fas fa-edit"></i></a> <a data-id="' . $data->id . '" class="btn-danger align-middle btn-custom btn btn-sm btn-delete text-white"><i class="fas fa-trash-alt"> </i></a>';
        })
        ->rawColumns(['status', 'image', 'action'])
        ->make(true);
    }

    // Query in Client part

    public function getListDestination()
    {
        return $this->with('tours')->get();
    }
}

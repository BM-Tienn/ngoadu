<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Libraries\Ultilities;
use Yajra\DataTables\Facades\DataTables;

class TypeOfTour extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'status',];

    public function tours()
    {
        return $this->hasMany(Tour::class);
    }

    public function getListType($request)
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

    public function listType()
    {
        return $this->orderBy('id', 'desc')->get();
    }

    public function typeOfTour()
    {
        return $this->where('status', ACTIVE)->orderBy('id', 'desc')->get();
    }

    public function saveData($params, $id)
    {
        return $this->find($id)->update(['title' => $params['title'], 'status' => $params['status']]);
    }

    public function storeData($request)
    {
        $params = $request->all();
        $params['title'] = Ultilities::clearXSS($request->title);
        $check = $this->where('title', $params['title'])->count();
        if ($check == 0) {
            $this->create($params);
            return SUCCESS;
        } else {
            return FAILURE;
        }
    }

    public function updateData($request, $id)
    {
        $params = $request->all();
        $params['title'] = Ultilities::clearXSS($request->title);
        $check = $this->where('title', $params['title'])->whereNotIn('id', [$id])->count();
        if ($check == 0) {
            $this->saveData($params, $id);
            return SUCCESS;
        } else {
            return FAILURE;
        }
    }

    public function showInformation($id)
    {
        return $this->find($id);
    }

    public function deleteType($id)
    {
        $check = Tour::where('type_id', $id)->count();
        if ($check == 0) {
            $this->find($id)->delete();
            return SUCCESS;
        } else {
            return FAILURE;
        }
    }

    public function changeStatus($id, $status)
    {
        if ($status == ACTIVE) {
            $this->find($id)->update(['status' => INACTIVE]);
            return SUCCESS;
        } else {
            $this->find($id)->update(['status' => ACTIVE]);
            return FAILURE;
        }
    }

    public function getListTypeByAjax($request)
    {
        $data = $this->getListType($request);
        return DataTables::of($data)
        ->addIndexColumn()
        ->editColumn('status', function ($data) {
            return view('admin.common.actionStatus', ['data' => $data]);
        })
        ->addColumn('action', function ($data) {
            return '<a data-id="' . $data->id . '" class="btn btn-sm btn-primary align-middle btn-circle btn-edit" style="color:white"><i class="fas fa-edit"> </i></a> <a data-id="' . $data->id . '" class="btn-danger btn-circle  btn-custom align-middle btn btn-sm btn-delete"><i class=" fas fa-trash-alt" style="color:white"> </i></a>';
        })
        ->rawColumns(['status', 'action'])
        ->make(true);
    }
    //query in client

    public function listTypeOfTour()
    {
        return $this->where('status', ACTIVE)->orderBy('id', 'desc')->get();
    }
}

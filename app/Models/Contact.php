<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\Facades\DataTables;

class Contact extends Model
{
       /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'message',
    ];

    public function getListContact($request)
    {
        $status = $request->status;
        $text = $request->filter_search;
        $data = $this->query();
        if ($status != ALL) {
            $data->where('status', $status);
        }
        if (!empty($text)) {
            $data->where(function ($q) use ($text) {
                $q->Where('name', 'like', '%' . $text . '%')
                ->orWhere('email', 'like', '%' . $text . '%')
                ->orWhere('phone', 'like', '%' . $text . '%');
            });
        }
        return $data->orderBy('id', 'desc')->get();
    }


    public function show($id)
    {
        return $this->find($id);
    }

    public function updateStatus($id)
    {
        return $this->find($id)->update(['status' => STATUS_READ]);
    }

    public function getListContactByAjax($request)
    {
        $data = $this->getListContact($request);
        return DataTables::of($data)
        ->addIndexColumn()
        ->editColumn('created_at', function ($data) {
            return date('m/d/Y H:i:s', strtotime($data->created_at));
        })
        ->editColumn('status', function ($data) {
            if ($data->status == STATUS_READ) {
                return 'Read';
            } else {
                return 'New';
            }
        })
        ->addColumn('action', function ($data) {
            return '<a href="javascript:void(0);" data-href="'. route('contact.edit', $data->id).'" class="btn btn-sm btn-info align-middle text-white btn-show-detail"><i class="fas fa-eye"></i></a>';
        })
        ->rawColumns(['action'])
        ->make(true);
    }
}

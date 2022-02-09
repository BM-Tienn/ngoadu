<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class Review extends Model
{
       /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['tour_id', 'content', 'star', 'status',];

    public function listReviewByStar($id)
    {
        return $this->where([['tour_id', $id], ['status', REVIEW_STATUS_PUBLIC]])
        ->select(DB::raw('count(*) as review, star'))->groupBy('star')->get();
    }

    public function countReview($id)
    {
        return $this->where([['tour_id', $id], ['status', REVIEW_STATUS_PUBLIC]])->count();
    }

    public function review($id)
    {
        return $this->where([['tour_id', $id], ['status', REVIEW_STATUS_PUBLIC]])->orderBy('id', 'desc')->paginate(5);
    }

    public function rating($id)
    {
        $sum = $this->where([['tour_id', $id], ['status', REVIEW_STATUS_PUBLIC]])->sum('star');
        $count = $this->where([['tour_id', $id], ['status', REVIEW_STATUS_PUBLIC]])->count();
        if ($count > 0) {
            return round($sum/$count, 1);
        } else {
            return FAILURE;
        }
    }

    public function storeReview($params, $id)
    {
        $params['assessor'] = 'customer';
        $params['tour_id'] = $id;
        $params['status'] = REVIEW_STATUS_PUBLIC;
        $this->create($params);
    }

    public function changeStatus($id, $status)
    {
        if ($status != REVIEW_STATUS_PUBLIC) {
            return $this->find($id)->update(['status' => REVIEW_STATUS_PUBLIC]);
        } else {
            return $this->find($id)->update(['status' => REVIEW_STATUS_BLOCK]);
        }
    }

    public function listReview($request, $id)
    {
        $status = $request->status;
        $star = $request->star;
        $data = $this->query();
        if ($status != ALL) {
            $data->where('status', $status);
        }
        if ($star != ALL) {
            $data->where('star', $star);
        }
        return $data->where('tour_id', $id)->orderBy('id', 'desc')->get();
    }

    public function showReview($id)
    {
        return $this->join('tours', 'tours.id', '=', 'reviews.tour_id')->where('reviews.id', $id)
        ->select('tours.title', 'reviews.*')->first();
    }

    public function getListReviewByAjax($request, $tour_id)
    {
        $data = $this->listReview($request, $tour_id);
        return DataTables::of($data)
        ->addIndexcolumn()
        ->addColumn('star', function ($data) {
            return $data->star.'<i class="fa fa-star ml-1" style="color:green"></i>';
        })
        ->editColumn('status', function ($data) {
            return view('admin.common.actionStatusReview', ['data' => $data]);
        })
        ->editColumn('time', function ($data) {
            return date(' d/m/Y', strtotime($data->created_at));
        })
        ->addColumn('action', function ($data) {
            return '<a href="javascript:void(0);" data-href="'. route('review.edit', $data->id) .'" data-id="' . $data->id . '" class="btn btn-sm btn-info align-middle text-dark btn-show-detail"><i class="fas fa-eye"></i></a>';
        })
        ->rawColumns(['status', 'star', 'action'])
        ->make(true);
    }
}

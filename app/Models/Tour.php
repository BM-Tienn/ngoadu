<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Libraries\Ultilities;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class Tour extends Model
{
    // protected $fillable = [
    //         'title','slug', 'status', 'priority', 'destination_id', 'type_id', 'photo', 'duration', 'price',
    //         'overview', 'include', 'depature', 'addtional', 'map', 'video', 'image_360', 'meta_title','meta_description'
    //     ];

    protected $guarded = [];

    public function destinations()
    {
        return $this->belongsTo(Destination::class, 'destination_id', 'id');
    }

    public function types()
    {
        return $this->belongsTo(TypeOfTour::class, 'type_id', 'id');
    }

    public function changeStatus($id, $status)
    {
        if ($status == ACTIVE) {
            return $this->find($id)->update(['status' => INACTIVE]);
        } else {
            return $this->find($id)->update(['status' => ACTIVE]);
        }
    }

    public function changeAttractive($id, $priority)
    {
        if ($priority == ATTRACTIVE) {
            return $this->find($id)->update(['priority' => INATTRACTIVE]);
        } else {
            return $this->find($id)->update(['priority' => ATTRACTIVE]);
        }
    }

    public function rule($id = null)
    {
        return [
            'title' => ['required', 'string', 'max:100', 'unique:tours'],
            'photo' => ['required', 'image','mimes:jpeg,png,jpg,svg','max:5120'],
            'duration' => ['required', 'numeric', 'max:365'],
            'price' => ['required', 'numeric', 'max:10000000'],
            'meta_title' => ['required', 'string', 'max:100'],
            'meta_description' => ['required', 'string', 'min:10', 'max:250'],
        ];
    }

    public function ruleUpdate($id)
    {
        return [
            'title' => ['required', 'string', 'max:100', 'unique:tours,title,'.$id],
            'photo' => ['image','mimes:jpeg,png,jpg,svg','max:5120'],
            'duration' => ['required', 'numeric', 'min:1', 'max:365'],
            'price' => ['required', 'numeric', 'min:1', 'max:10000000'],
            'meta_title' => ['required', 'string', 'max:100', 'unique:tours,meta_title,'.$id],
            'meta_description' => ['required', 'string', 'min:10', 'max:250'],
            'overview' => ['bail', 'max:1000'],
            'depature' => ['bail', 'max:1000'],
            'addtional' => ['bail', 'max:1000'],
            'include' => ['bail', 'max:1000'],
            'map' => ['bail', 'max:1000'],
            'image_360' => ['bail', 'max:255'],
            'video' => ['bail', 'max:100'],
        ];
    }

    public function storeData($request)
    {
        $params = $request->all();
        $params['title'] = Ultilities::clearXSS($request->title);
        $params['meta_title'] = Ultilities::clearXSS($request->meta_title);
        $params['meta_description'] = Ultilities::clearXSS($request->meta_description);
        $params['photo'] = time() . '.' . $request->file('photo')->getClientOriginalExtension();
        $request->file('photo')->move('upload/tour', $params['photo']);
        $params['slug'] = Str::slug($params['title'], '-');
        $params['map']= '';
        return $this->create($params);
    }

    public function updateData($request, $id)
    {
        $params = $request->all();
        $params['title'] = Ultilities::clearXSS($request->title);
        $params['meta_title'] = Ultilities::clearXSS($request->meta_title);
        $params['meta_description'] = Ultilities::clearXSS($request->meta_description);
        $params['slug'] = Str::slug($params['title'], '-');

        if ($request->hasFile('photo')) {
            $params['photo'] = time() . '.' . $request->file('photo')->getClientOriginalExtension();
            $request->file('photo')->move('upload/tour', $params['photo']);
            $tour = $this->find($id);
            $filePathName = 'upload/tour/' . $tour->photo;
            if (file_exists($filePathName)) {
                unlink($filePathName);
            }
        } else {
            $params['photo'] = $this->find($id)->photo;
        }
        return $this->find($id)->update($params);
    }

    public function showInformation($id)
    {
        return $this->find($id);
    }

    public function deleteTour($id)
    {
        $countGallery = Gallery::where('tour_id', $id)->count();
        $countReview = Review::where('tour_id', $id)->count();
        $countItinarary = Itinerary::where('tour_id', $id)->count();
        $countFaqs = Faqs::where('tour_id', $id)->count();
        $countBooking = Booking::where('tour_id', $id)->count();
        if ($countGallery > 0 || $countItinarary > 0 || $countReview > 0 || $countFaqs > 0 || $countBooking > 0) {
            return FAILURE;
        } else {
            $tour = $this->find($id);
            $filePathName = 'upload/tour/'.$tour->photo;
            if (file_exists($filePathName)) {
                unlink($filePathName);
            }
            $tour->delete();
            return SUCCESS;
        }
    }

    public function relatedTour($id)
    {
        return $this->where('destination_id', $id)->limit(6)->get();
    }

    public function getlistTour($request)
    {
        $status = $request->status;
        $destination = $request->destination;
        $type = $request->type;
        $priority = $request->priority;
        $text = $request->filter_search;
        $data = $this->query();

        if ($destination != ALL) {
            $data->where('destination_id', $destination);
        }
        if ($type != ALL) {
            $data->where('type_id', $type);
        }
        if ($status != ALL) {
            $data->where('status', $status);
        }
        if ($priority != ALL) {
            $data->where('priority', $priority);
        }
        if (!empty($text)) {
            $data->where('title', 'like', '%' . $text . '%');
        }
        return $data->orderBy('id', 'desc')->get();
    }

    public function getListTourByAjax($request)
    {
        $data = $this->getListTour($request);
        return DataTables::of($data)
        ->addIndexcolumn()
        ->editColumn('status', function ($data) {
            return view('admin.common.actionStatus', ['data' => $data]);
        })
        ->editColumn('priority', function ($data) {
            return view('admin.common.actionAttractive', ['data' => $data]);
        })
        ->addColumn('photo', function ($data) {
            return '<img class="img-datatable" src="' . asset('upload/tour/' . $data->photo) . '">';
        })
        ->addColumn('action', function ($data) {
            return '<a href="'. route('tour.detail', $data->id) .'"  title="Show" class="btn btn-sm btn-info align-middle text-white"><i class="fas fa-eye"></i></a> <a href="'. route('tour.edit', $data->id) .'"  title="Edit" class="btn btn-sm btn-primary align-middle btn-edit text-white"><i class="fas fa-edit"></i></a> <a  data-id="' . $data->id . '"  title="Delete" class="btn btn-danger align-middle btn-custom btn btn-sm btn-delete text-white"><i class="fas fa-trash-alt"> </i></a>';
        })
        ->addColumn('more', function ($data) {
            return '<a href="'. route('tour.gallery', $data->id) .'" class="btn btn-xs btn-link">Album Ảnh</a><br><a href="'. route('tour.itinerary', $data->id) .'" class="btn btn-xs btn-link">Lộ trình</a><br><a href="'. route('tour.faqs', $data->id) .'" class="btn btn-xs btn-link">Câu hỏi thường gặp</a><br><a href="'. route('tour.review', $data->id) .'" class="btn btn-xs btn-link">Xem đánh giá</a>';
        })
        ->rawColumns(['status', 'priority', 'photo', 'more', 'action'])
        ->make(true);
    }
    // query in client

    public function listTour()
    {
        return $this->with('destinations')->where('status', ACTIVE)->orderBy('id', 'desc')->paginate(3);
    }

    public function tourByDestination($destination_slug)
    {
        $destinationId = $this->destination->where('slug', $destination_slug)->first();
        return $this->where('destination_id', $destinationId->id)->paginate(21);
    }

    public function tourDetail($duration, $slug)
    {
        return $this->where([['duration', $duration], ['slug', $slug]])->first();
    }

    public function tourId($duration, $slug)
    {
        return $this->where([['duration', $duration], ['slug', $slug]])->first();
    }

    public function attractiveTour()
    {
        return $this->with('destinations')->where([['priority', ATTRACTIVE], ['status', ACTIVE]])->orderBy('id', 'desc')->limit(8)->get();
    }

    public function newTour()
    {
        return $this->with('destinations')->where('status', ACTIVE)->orderBy('id', 'desc')->limit(8)->get();
    }

    public function countTour()
    {
        return $this->with('destinations')->where('status', ACTIVE)->count();
    }

    public function filterInListTour($request)
    {
        // $min = $request->min;
        // $max = $request->max;
        $durations = $request->duration ?? [];
        $types = $request->type ?? [];
        $tours = $this->with('destinations')->where('status', ACTIVE);
        // $tours->WhereBetween('price', [$min, $max]);
        if ($request->ajax()) {
            $tours->whereIn('type_id', $types);
            $tours->where(function ($query) use ($durations) {
                foreach ($durations as $key => $value) {
                    if ($value <= 5) {
                        $query->OrWhereBetween('duration', [$value, $value + 2]);
                    } else {
                        $query->OrWhereBetween('duration', [$value, $value + 999]);
                    }
                }
            });
            $filterTour = $tours->paginate(3);
            return view('client.filterTour', compact('filterTour'));
        }
    }

    public function search($request)
    {
        $destination = $request->destination_tour;
        $type = $request->type_tour;
        $tour= $request->name_tour;
        $data = $this->query();
        $data->join('destinations', 'destinations.id', '=', 'tours.destination_id');
        if ($type != ALL) {
            $data->where('tours.type_id', $type);
        }
        if (!empty($destination)) {
            $data->where('destination.title', 'like', '%' . $destination . '%');
        }
        if (!empty($tour)) {
            $data->where('tours.title', 'like', '%' . $tour . '%');
        }
        return $data->orderBy('tours.id', 'desc')->paginate(21);
    }
}

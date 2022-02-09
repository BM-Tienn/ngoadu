<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Libraries\Ultilities;
use Yajra\DataTables\Facades\DataTables;

class Faqs extends Model
{
       /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['tour_id', 'question', 'answer'];

    public function tours()
    {
        return $this->hasMany(Tour::class);
    }

    public function getListFaqs($tour_id)
    {
        return $this->where('tour_id', $tour_id)->orderBy('id', 'desc')->get();
    }

    public function saveData($params, $id)
    {
        $this->find($id)->update(['question' => $params['question'], 'answer' => $params['answer']]);
        return SUCCESS;
    }

    public function showInformation($id)
    {
        return Tour::find($id);
    }

    public function faqsInformation($id)
    {
        return $this->find($id);
    }

    public function listFaqs($tour_id)
    {
        return $this->where('tour_id', $tour_id)->get();
    }

    public function storeData($request)
    {
        $params = $request->all();
        $params['question'] = Ultilities::clearXSS($request->question);
        $params['answer'] = Ultilities::clearXSS($request->answer);
        $check = $this->where([['tour_id', $params['tour_id']], ['question', $params['question']]])->count();
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
        $params['question'] = Ultilities::clearXSS($request->question);
        $params['answer'] = Ultilities::clearXSS($request->answer);
        return $this->saveData($params, $id);
    }

    public function getListFaqsByAjax($tour_id)
    {
        $data = $this->getListFaqs($tour_id);
        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($data) {
            return '<a href="javascript:void(0);" data-href="'. route('faqs.edit', $data->id) .'" class="btn btn-sm btn-primary btn-edit" style="color:white"><i class="fas fa-edit"> </i></a> <a data-id="' . $data->id . '" class="btn-danger btn-circle  btn-custom  btn btn-sm btn-delete"><i class="fas fa-trash-alt" style="color:white"> </i></a>';
        })
        ->rawColumns(['action'])
        ->make(true);
    }
}

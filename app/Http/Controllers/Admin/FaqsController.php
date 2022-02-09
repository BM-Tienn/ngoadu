<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faqs;
use App\Models\Tour;

class FaqsController extends Controller
{
    protected $faqs;
    protected $tour;

    public function __construct(Faqs $faq, Tour $tour)
    {
        $this->faqs = $faq;
        $this->tour = $tour;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($tour_id)
    {
        $faqs = $this->faqs->showInformation($tour_id);
        return view('admin.faqs.index', compact('faqs', 'tour_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->faqs->storeData($request);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->faqs->faqsInformation($id);
        return response()->json([
            'data' => $data,
            'code' => 200,
            'message' => 'Show successfully'
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->faqs->updateData($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->faqs->find($id)->delete();
        return 1;
    }

    public function getListFaqs($tour_id)
    {
        return $this->faqs->getListFaqsByAjax($tour_id);
    }
}

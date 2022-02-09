<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Destination;

class DestinationController extends Controller
{
    protected $destination;

    public function __construct(Destination $destination)
    {
        $this->destination = $destination;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.destinations.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->destination->rule());
        $this->destination->storeData($request);
        return redirect()->route('destination.index')->with(['alert-type' => 'success', 'message' => 'Lưu trữ dữ liệu thành công' ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->destination->showInformation($id);
        return response()->json([
            'destination' => $data,
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
        $request->validate($this->destination->ruleUpdate($id));
        $this->destination->updateData($request, $id);
        return redirect()->back()->with(['alert-type' => 'success', 'message' => 'Thay đổi dữ liệu thành công' ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->destination->deleteDestination($id);
    }

    public function change($id, $status)
    {
        try {
            $this->destination->changeStatus($id, $status);
                return SUCCESS;
        } catch (\Exception $e) {
            return FAILURE;
        }
    }

    public function getListDestination(Request $request)
    {
        return $this->destination->getListDestinationByAjax($request);
    }
}

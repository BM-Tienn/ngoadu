<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TypeOfTour;

class TypeOfTourController extends Controller
{
    protected $type;

    public function __construct(TypeOfTour $type)
    {
        $this->type = $type;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.type_of_tours.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $type = $this->type->storeData($request);
            if ($type == SUCCESS) {
                return SUCCESS;
            } else {
                return 2;
            }
        } catch (\Exception $e) {
            return FAILURE;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->type->showInformation($id);
        return response()->json([
            'type' => $data,
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
        try {
            $type = $this->type->updateData($request, $id);
            if ($type == SUCCESS) {
                return SUCCESS;
            } else {
                return 2;
            }
        } catch (\Exception $e) {
            return FAILURE;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->type->deleteType($id);
    }

    public function change($id, $status)
    {
        return $this->type->changeStatus($id, $status);
    }

    public function getListType(Request $request)
    {
        return $this->type->getListTypeByAjax($request);
    }
}

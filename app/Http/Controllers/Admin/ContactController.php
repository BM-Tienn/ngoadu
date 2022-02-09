<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    protected $contact;

    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.contacts.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $check = $this->contact->find($id);
        if ($check->status != STATUS_READ) {
            $this->contact->updateStatus($id);
        }
        $data = $this->contact->show($id);
        return response()->json([
            'data' => $data,
            'code' => 200,
            'message' => 'Show successfully'
        ], 200);
    }

    public function getListContact(Request $request)
    {
        return $this->contact->getListContactByAjax($request);
    }
}

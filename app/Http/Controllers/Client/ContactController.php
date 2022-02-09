<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Libraries\Ultilities;

class ContactController extends Controller
{
    protected $contact;

    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    public function main()
    {
        return view('client.contact');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:50'],
            'email' => ['required', 'string', 'min:10', 'max:50'],
            'phone' => ['required', 'string', 'min:10','max:10'],
            'message' => ['required', 'string', 'min:3', 'max:255'],
        ]);
        $params = $this->getParams($request);

        $params['name'] = Ultilities::clearXSS($request->name);
        $params['email'] = Ultilities::clearXSS($request->email);
        $params['phone'] = Ultilities::clearXSS($request->phone);
        $params['message'] = Ultilities::clearXSS($request->message);
        
        $this->contact->create($params);
        return redirect()->route('client.home')->with('alert', 'Cảm ơn bạn đã gửi tin nhắn cho chúng tôi!');
    }

    private function getParams(Request $request)
    {
        return $request->only(['name', 'email', 'phone', 'message']);
    }
}

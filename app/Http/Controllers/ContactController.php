<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function show()
    {
        return view('contacts.show');
    }

    public function submit(ContactRequest $request)
    {
        Mail::to('crc.santos@gmail.com')->send(new ContactMail($request->name, $request->email, $request->content));

        return redirect('/')->with('msg','Contact enviado com sucesso!!!');
    }
}
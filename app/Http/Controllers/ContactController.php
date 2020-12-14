<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;

class ContactController extends Controller
{

    public function index(){
        return view('pages.contact');
    }

    //storing user message in database
    public function store(ContactRequest $request)
    {
        $input = $request->input();
        Contact::create($input);
        return redirect()->route('home')->with('success','Message sent successfully!');
    }
}

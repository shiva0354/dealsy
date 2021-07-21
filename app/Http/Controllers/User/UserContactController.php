<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\RedirectResponse;

class UserContactController extends Controller
{
    /**
     * displaying conatct page
     */
    public function index()
    {
        return view('user.pages.contact');
    }

    /**
     * storing user message in database
     *
     * @param ContactRequest $request
     * @return RedirectResponse
     */
    public function store(ContactRequest $request)
    {
        $input = $request->input();
        Contact::create($input);
        return back()->with('success', 'Message sent successfully!');
    }
}

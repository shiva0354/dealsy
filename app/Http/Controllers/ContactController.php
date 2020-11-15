<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    //storing user message in database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'string|required|max:100',
            'email' => 'required|email|max:100',
            'message' => 'required|string',
        ]);
        DB::beginTransaction();
        try {
            Contact::create($validated);
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->intended()->with([
                'error' => $e->getMessage(),
            ]);
        }
        DB::commit();
        return redirect()->route('home')->with([
            'success' => 'Message sent successfully!',
        ]);
    }
}

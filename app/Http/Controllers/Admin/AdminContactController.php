<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;

class AdminContactController extends Controller
{
    /**
     * Displaying the list of conatct messages received
     */
    public function index()
    {
        $contacts = Contact::latest()->paginate(30);
        return view('admin.contacts', compact('contacts'));
    }

    /**
     * Deleting the contact
     */
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return redirect()->route('admin.contacts.index')->with('success', 'Deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactMessageController extends Controller
{
    public function index()
    {
        $data['messages'] = Contact::latest()->paginate(10);
        return view('backend.contacts.index', $data);
    }

    public function show($id)
    {
        $data['contact'] = Contact::find($id);
        if (!$data['contact']) {
            return redirect()->route('contact.list')
                ->with('error', 'Contact message not found');
        }

        return view('backend.contacts.show', $data);
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return back()->with('success', 'Message deleted successfully');
    }
}

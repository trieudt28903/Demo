<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //
    function index()
    {
        $contacts=Contact::paginate(20);
        return view('admin.contact.list',compact('contacts'));
    }

    function delete($id)
    {
        $contact=Contact::find($id);
        $contact->delete();
        return redirect()->route('admin.contact.index');
    }
}

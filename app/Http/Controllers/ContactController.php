<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    public function sendContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $data = $request->all();
        
        Mail::to('eraporsitaliyadev@gmail.com')->send(new ContactMail($data));

        return redirect()->back()->with('success', 'Pesan anda berhasil dikirim!');
    }
}

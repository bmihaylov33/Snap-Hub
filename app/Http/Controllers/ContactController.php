<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function showForm()
    {
        return view('contacts');
    }

    public function submitForm(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        Message::create($validatedData);

        // Mail::to('bmihaylov99@gmail.com')->send(new MessageReceived($validatedData));

        return redirect('/contacts')->with('success', 'Message sent successfully!');
    }
}

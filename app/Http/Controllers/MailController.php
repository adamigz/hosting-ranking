<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactForm;

class MailController extends Controller
{
    public function index()
    {
        return view('contact');
    }
    public function send(Request $request)
    {
        $validated = $request->validate([
            'email' => 'email|required',
            'title' => 'string|required',
            'content' => 'string|required'
        ]);

        Mail::to(settings()->mail)->send(new ContactForm($request->all()));

        return redirect()->back();
    }
}

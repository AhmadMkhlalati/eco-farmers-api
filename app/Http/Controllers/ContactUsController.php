<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactUsRequest;
use App\Models\ContactUs;

class ContactUsController extends Controller
{
    public function store(ContactUsRequest $request)
    {
        ContactUs::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'phone' => $request->phone ?? null,
            'subject' => $request->subject ?? null,
        ]);
        return response()->json([
            'success' => 'Email Sent Successfully!'
        ]);
    }
}

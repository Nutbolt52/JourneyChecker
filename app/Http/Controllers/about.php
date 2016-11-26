<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Requests\ContactFormRequest;

class about extends Controller
{
    public function displaypage()
    {
        return view('about');
    }

    public function contact(ContactFormRequest $request)
    {

        \Mail::send('contactemail',
            array(
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'user_message' => $request->get('message')
            ), function($message)
            {
                $message->from('contact@journeychecker.com');
                $message->to('admin@nutbolt.eu', 'Admin')->subject('Journey Checker Feedback');
            });

        return \Redirect('about')
            ->with('message', 'Thanks for contacting us!');
    }
}

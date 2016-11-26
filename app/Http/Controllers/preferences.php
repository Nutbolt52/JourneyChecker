<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Helpers\tfldata;
use Cookie;

class preferences extends Controller
{
    public function displaypage()
    {
        $lines = tfldata::getLines();
        return view('preferences', ['lines' => $lines]);
    }

    public function SetPreferences(Request $request)
    {
        //Validate input to ensure its an array and each item in the array is a string
        $this->validate($request, [
            'line_ids' => 'required|array',
            'line_ids.*' => 'string'
        ]);

        //Encode selected tube lines as JSON for storing in cookie
        $tubelines = json_encode($request['line_ids']);

        //Prepare cookie which will last for 30 days (43,200 minutes)
        Cookie::queue('tubelines', $tubelines, 43200);

        return redirect('/');
    }

    public function DeletePreferences()
    {
        $cookie = cookie::forget('tubelines');
        return redirect('/')->cookie($cookie);
    }
}

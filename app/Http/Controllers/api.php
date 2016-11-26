<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Cookie;
use App\Helpers\tfldata;
use Cache;

class api extends Controller
{
    public function updatelines(Request $request)
    {
        $preferences_set = false;

        //If preferences set via cookie do the following
        if(Cookie::get('tubelines'))
        {
            $preferences_set = true;

            $cookiedata = $request->cookie('tubelines');
            $lines = json_decode($cookiedata);

            //Put lines into session to avoid checking cookie every time
            $request->session()->put('lines', $lines);

            $tfldata = tfldata::getSpecificLines($lines);

            //Prepare fresh cookie which will last for 30 days. This updates the cookie on every page hit to keep it fresh
            Cookie::queue('tubelines', $cookiedata, 43200);
        } else {
            $tfldata = tfldata::get();
        }

        return view('partials.linestatus', compact('preferences_set', 'tfldata'));
    }

    public function lastupdate() {

        return 'Updated at ' . Cache::get('last-update');

    }
}

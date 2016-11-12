<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Helpers\tfldata;

class api extends Controller
{
    public function updatelines(Request $request)
    {
        if($request->session()->has('lines')) {
            //Retrieve lines from session
            $lines = $request->session()->get('lines');
            //Get TFL Data for specific lines
            $tfldata = tfldata::getSpecificLines($lines);
        } else {
            //If not set in session (i.e. no preferences set), then get data for all TFL lines
            $tfldata = tfldata::get();
        }

        return $tfldata;
    }
}

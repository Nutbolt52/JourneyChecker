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

        //Provide the css class to use in the view
        //All logic should be handled here for display, except for the initial view, which is handled in the blade file (partials.linestatus)
        foreach($tfldata as $line) {
            if($line['statusSeverity'] < 10) {
                $tfldata[$line['id']] = array_add($line, 'cssClass', 'panel-danger');
            } else {
                $tfldata[$line['id']] = array_add($line, 'cssClass', 'panel-success');
            }
        }

        return $tfldata;
    }
}

<?php

namespace App\Helpers;

use Cache;
use Storage;
use Carbon\Carbon;

class tfldata
{
    /**
     * Fetches the TfL data and returns the full array
     * This calls the update helper function if the cache has expired
     *
     * @return mixed
     */
    public static function get()
    {
        if(Cache::has('tfldata')) {
            $data = Cache::get('tfldata');

            return $data;
        } else {
            tfldata::update();
            //probably need to try catch this, or if true then proceed statement, to handle any errors

            $data = Cache::get('tfldata');

            return $data;
        }
    }

    /**
     * Return list of lines available
     *
     * @return mixed
     */
    public static function getLines()
    {
        $data = tfldata::get();

        $lines = [];

        foreach ($data as $line) {
            $lines[$line['id']] = $line['name'];
        }

        return $lines;
    }

    /**
     * Return data for specific list of lines which is passed to the Helper function
     * Returns just the useful data
     *
     * @param $lines
     * @return mixed
     */
    public static function getSpecificLines($lines)
    {

        //need a try catch around this I think incase it returns blank. Or should this be handled in get()?
        $data = tfldata::get();

        $specific_data = [];

        foreach ($data as $linedata) {
            if(in_array($linedata['id'], $lines)) {
                $specific_data[$linedata['id']] = $linedata;
            }
        }
        return $specific_data;
    }

    /**
     * Update the cache
     * Called by the Get helper function, so no need to call it anywhere else
     *
     * * * * * * * * * NOTE * * * * * * * * *
     * Only stores the first disruption. It should really store all of them and display them all
     *
     * @return array|bool
     */
    public static function update()
    {
        try {
            $url = 'https://api.tfl.gov.uk/Line/Mode/tube,dlr,overground/Status?detail=False&app_id=' . config('TFL_APP_ID') . '&app_key=' . config('TFL_APP_KEY');

            $data = json_decode(file_get_contents($url), true);

            $tfldata = [];

            foreach ($data as $linedata) {
                    $temparray = [];

                    $temparray['id'] = $linedata['id'];
                    $temparray['name'] = $linedata['name'];
                    $temparray['statusSeverity'] = $linedata['lineStatuses']['0']['statusSeverity'];
                    $temparray['statusSeverityDescription'] = $linedata['lineStatuses']['0']['statusSeverityDescription'];
                    if(isset($linedata['lineStatuses']['0']['reason'])) {
                        $temparray['reason'] = $linedata['lineStatuses']['0']['reason'];
                    }

                    $tfldata[$linedata['id']] = $temparray;
            }

            Cache::put('tfldata', $tfldata, 0.5);

            Cache::forever('last-update', Carbon::now()->toTimeString());

            return true;
        } catch (\Exception $e) {
            return ['error' => 'Sorry, there was an issue with updating the data from TFL, please try again by reloading the page'];
        }
    }
}
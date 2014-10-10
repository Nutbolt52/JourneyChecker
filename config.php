<?php
  defined('IN_APP') || die("Hands off!");

  //Create TfL Cache location string
  $tflcachelocation = ($_SERVER['DOCUMENT_ROOT'] . '/tflcache.xml.cache');
  
  //TfL Data Options
  define('TFL_URL', 'http://cloud.tfl.gov.uk/TrackerNet/LineStatus'); 
  define('TFLCACHE', $tflcachelocation);
  define('TFLCACHEAGE', '30'); //in seconds

?>

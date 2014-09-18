<?php
    define('IN_APP', true);
    require_once($_SERVER['DOCUMENT_ROOT'] . '/inc/functions.php');
    session_start();

    clearstatcache(); 
    date_default_timezone_set('Europe/London');
    print "Updated at " . date('H:i:s', filemtime(TFLCACHE)) . " (" . date('T') . ")";
    
?>

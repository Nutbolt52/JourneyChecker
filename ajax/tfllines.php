<?php
    define('IN_APP', true);
    require_once($_SERVER['DOCUMENT_ROOT'] . '/inc/functions.php');
    session_start();

    $xml = jtflcache();
    $lines = jtflreaddata($xml,true);

    $tfldisplaylines = jtflprintlines($lines);
    print $tfldisplaylines;
    
?>

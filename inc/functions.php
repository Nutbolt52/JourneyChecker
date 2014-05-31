<?php 
  defined('IN_APP') || die("Hands off!");
  require_once('config.php');
  require_once('inc/menu.php');

  
  //Have <head> unqiue for each page, but have the navbar be a function
  //*********
  //Use this to create a header for pages
//  function jgetheader($body, $title, $activepage){
//    $page = file_get_contents('inc/header.html');
//    $header = jgetmenu($activepage);
//    $page = str_replace('%BODY%', $body, $page);
//    $page = str_replace('%TITLE%', $title, $page);
//    $page = str_replace('%HEADER%', $header , $page);
//    return $page;
//  }

  
  //Need the following functions:
  //jgetmenu 
  //jsetcookie
  //jgetcookie
  //jgettfldata
  //jcachetfldata
  //etc...
  

?>

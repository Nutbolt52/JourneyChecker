<?php 
  defined('IN_APP') || die("Hands off!");
  require_once('config.php');
  require_once('inc/menu.php');
  
    //Check if the TfL Cookie is set and if so put the chosen tube lines in the users session
    function jcheckfortflcookie () {
        if (isset($_COOKIE['tubelines'])) {
            $_SESSION['tfl_lines'] = explode(',', filter_input(INPUT_COOKIE, 'tubelines', FILTER_SANITIZE_STRING));
            $_SESSION['tflcookieset'] = true;
        } else {
            $_SESSION['tflcookieset'] = false;
        }
    }
  

  
  //Need the following functions:
  //jgetmenu 
  //jsetcookie
  //jgetcookie
  //jgettfldata
  //jcachetfldata
  //etc...
  

?>

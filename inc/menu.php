<?php
  defined('IN_APP') || die("Hands off!");

  function jgetmenu($activepage) {

      $header = '<div class="navbar navbar-default navbar-fixed-top" role="navigation">';
      $header .= '<div class="container"><div class="navbar-header">';
      $header .= '<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">';
      $header .= '<span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>';
      //Branding
      $header .= '<div class="navbar-form" style="margin-top:0px; margin-bottom: 3.5px; padding-left:0px; padding-right:0px"><a class="navbar-left" href="/"><img src="img/icon_orange.png" style="height:45px; padding:5px" alt="Journey Checker"></a>';
      $header .= '<a class="navbar-brand" href="/"> Journey Checker</a></div></div>';
      //Collapseable Menu
      $header .= '<div class="collapse navbar-collapse">';
      $header .= '<ul class="nav navbar-nav">';
      //If Statements to determine the active page for menu formatting
      if ($activepage == 'home') { $header .= '<li class="active"><a href="/">Home</a></li>'; }
        else { $header .= '<li><a href="/">Home</a></li>'; }
      if ($activepage == 'pref') { $header .= '<li class="active"><a href="preferences">Preferences</a></li>'; }
        else { $header .= '<li><a href="preferences">Preferences</a></li>'; }
      if ($activepage == 'about') { $header .= '<li class="active"><a href="about">About</a></li>'; }
        else { $header .= '<li><a href="about">About</a></li>'; }
      $header .= '</ul>';
      //Time of last TfL Data Update
      $header .= '<p class="navbar-text navbar-right">Updated at ' . date('H:i:s', filemtime(tflcache)) . " (" . date('T') . ")" . '</p>';
      //End Collapseable Menu 
      $header .= '</div><!--/.nav-collapse -->';
      $header .= '</div></div>';       

    //End of function        
    return $header;
  }       

?>

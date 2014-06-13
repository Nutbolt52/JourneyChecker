<?php 
    define('IN_APP', true);
    require_once('inc/functions.php');
    require_once('inc/menu.php');
    
    $activepage='about'; 
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" type="image/ICO" href="favicon.ico">
        <meta name="description" content="Quickly and easily see if theres any delays on your underground line(s) during your commute in London. Works great on both desktop and mobile!" />
        <meta name="Keywords" content="Journey, Checker, commute, London, TfL, transport for london, underground, delay, disruption" />
        <link rel="image_src" href="img/logosquare.png" />
        <link rel="canonical" href="http://www.journeychecker.com/about">
        
        <!-- Bootstrap CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrapcosmo.min.css" rel="stylesheet">
        <title>Journey Checker - About</title>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body style="padding-top:40px">
        
    <?php
        $navbar = jgetmenu($activepage);
        print $navbar;
    ?>
        
    <div class="container theme-showcase" role="main">   
        
        <div class="page-header">
            <h1>About Journey Checker</h1>
        </div>
        <div class="well">
            <p>The Journey Checker was developed by Nutbolt as a way of quickly and easily checking if there were any delays on his journey home from work. </p>
            <p>It grew to allow more flexibility, allowing users to select their own stations and tube lines etc...</p>
            <p>The London Underground data is provided by TfL and is updated every 30 seconds</p>
            
        </div>
        
<?php
    include 'inc/footer.html'
?>
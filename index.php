<?php
   define('IN_APP', true);
   require_once('inc/functions.php');
   require_once('inc/menu.php');
   session_start();
   
   ini_set('session.cookie_httponly',1);
   $activepage='home';
   
   jtflcheckforcookie();   
   
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" type="image/ICO" href="favicon.ico">
        <meta name="description" content="Quickly and easily see if theres any delays on your underground line(s) during your commute in London. Works great on both desktop and mobile" />
        <meta name="keywords" content="Journey, Checker, commute, London, TfL, transport for london, underground, delay, disruption, status, check, tube" />
        <link rel="image_src" href="img/logosquare.png" />
        <link rel="canonical" href="https://www.journeychecker.com/">
        
        <!-- Bootstrap CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/ripples.min.css" rel="stylesheet">
        <link href="css/material-custom.css" rel="stylesheet">
        
        <title>Journey Checker - London Underground</title>
        
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body style="padding-top:70px">
        
    <?php
        $navbar = jgetmenu($activepage);
        print $navbar;
    ?>
        
    <div class="container theme-showcase" role="main">   
     
    <div class="jumbotron">
        <?php 
            if ($_SESSION['tflcookieset'] == FALSE){
        ?>
        <div>
            <div class="alert alert-info fade in">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <p><strong>Welcome to Journey Checker!</strong> Set your preferences to limit which lines you see below</p>
                <h5>This website uses cookies to remember your preferences. By setting your preferences you are agreeing to allow this site to store cookies on your computer</h5>
                <p><a class="btn btn-warning btn-raised" href="preferences">Set Preferences</a>
                    <button class="btn btn-primary btn-raised" data-toggle="modal" data-target="#info-dialog">More Information</button> </p>
            </div>
            <div id="info-dialog" class="modal fade" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                      <h2 class="modal-title">More Information</h2>
                    </div>
                    <div class="modal-body">
                      <p>Journey Checker allows you to select what London Underground lines you use on your commute to and from work.</p>
                       <p>Once this is set, only these lines will be displayed on the homepage, allowing you to quickly and easily view any delays on lines you use.</p>
                       <p>So that you can see any delays as easily as possible, underground lines currently experiencing delays are shown in red. Any information provided by Transport for London (TfL) is included, and is updated automatically when TfL release new information about the delay. </p>
                       <p>If you leave the page open it will automatically refresh the status of each line every 32 seconds.</p>
                       <p>Journey Checker looks good on any screen size, making it ideal for viewing on your mobile as you travel. </p>
                    </div>
                    <div class="modal-footer">
                      <button class="btn btn-primary" data-dismiss="modal">Dismiss</button>
                    </div>
                  </div>
                </div>
            </div>
        </div>
        <?php } ?>

        <p>
            <div id="TfLlines">
            <?php 
                if ($_SESSION['tflcookieset'] == FALSE){
                    $xml = jtflcache();
                    $lines = jtflreaddata($xml,true);

                    $tfldisplaylines = jtflprintlines($lines);
                    print $tfldisplaylines;
            ?>
            <?php } else { ?>
                <div id="ajaxloader" style="text-align:center; display:none"><img src="img/ajax-loader.gif" /></div>
            <?php } ?>
            
            
            </div>
        
            <div id="TfLlineserror">
            
            </div>
        </p>
    </div><!-- /.container -->
    
    <?php 
        if ($_SESSION['tflcookieset'] == FALSE){
    ?>
    <div class="alert alert-warning">
    <strong>Note: </strong>If there is a disruption the affected lines will turn red and details of the disruption will be provided</p>
    </div>
    <?php } ?>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script>
        $(window).load(function (){
            $("#ajaxloader").fadeIn("slow");
        });
        $( "#TfLlines" ).load( "/ajax/tfllines.php", function( response, status, xhr ) {
            if ( status == "error" ) {
                var msg = "Sorry but there was an error: ";
                $( "#TfLlineserror" ).html( msg + xhr.status + " " + xhr.statusText );
            }
        });

        setInterval('refresh_lines()', 32000);
        function refresh_lines() {
            $( "#TfLlines" ).load( "/ajax/tfllines.php", function( response, status, xhr ) {
                if ( status == "error" ) {
                    var msg = "Sorry but there was an error: ";
                    $( "#TfLlineserror" ).html( msg + xhr.status + " " + xhr.statusText );
                }
            });
        }

    </script>
    
<?php
    include 'inc/footer.html'
?>
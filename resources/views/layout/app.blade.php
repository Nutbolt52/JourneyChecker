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

    <!-- Material Design fonts -->
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Roboto:300,400,500,700">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/icon?family=Material+Icons">

    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/bootstrap-material-design.min.css" rel="stylesheet">
    <link href="css/ripples.min.css" rel="stylesheet">

    <title>Journey Checker - London Underground</title>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body style="padding-top:70px">

@include('partials.menu')

<div class="container theme-showcase" role="main">

@yield('content')

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

    @yield('scripts')

    <div class="pull-right text-muted">
        <p class="text-right">&copy; <?php echo date("Y"); ?> Journey Checker | All Rights Reserved | <a href="https://www.tfl.gov.uk/" target="_blank" style="color: inherit;text-decoration:none;">Powered by TfL Open Data</a></p>
    </div>

</div>
{{--<script src="js/jquery-1.11.2.min.js"></script>--}}
<script src="js/bootstrap.min.js"></script>
<script src="js/material.min.js"></script>
<script src="js/ripples.min.js"></script>

<script>
    $(document).ready(function() {
        $.material.init();
    });
</script>

<script>
    $( "#lastupdate" ).load( "/ajax/lastupdate.php", function( response, status, xhr ) {
        if ( status == "error" ) {
            $( "#lastupdateerror" ).html("Updated at <em>unknown<em>");
        }
    });

    setInterval('refresh_lastupdate()', 32000);
    function refresh_lastupdate() {
        $( "#lastupdate" ).load( "/ajax/lastupdate.php", function( response, status, xhr ) {
            if ( status == "error" ) {
                $( "#lastupdateerror" ).html("Updated at <em>unknown<em>");
            }
        });
    }

//    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
//                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
//            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
//    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
//    ga('create', 'UA-51517692-1', 'journeychecker.com');
//    ga('send', 'pageview');
</script>
</body>
</html>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap core CSS -->
        <link href="css/bootstrapcosmo.min.css" rel="stylesheet">
        <!-- Bootstrap theme -->
        <!--<link href="css/bootstrap-theme.min.css" rel="stylesheet">-->
        <title>Journey Checker - Tube Map</title>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body style="padding-top:50px">
        
      <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Journey Checker</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="index.php">Home</a></li>
            <li><a href="preferences.php">Preferences</a></li>
            <li class="active"><a href="#tube-map">Tube Map</a></li>
            <li><a href="about.php">About</a></li>
          </ul>
          <p class="navbar-text navbar-right">Updated at <script type="text/javascript">
            var x = new Date();document.write(((x.getHours() < 10)?"0":"") + x.getHours() +":"+ ((x.getMinutes() < 10)?"0":"") + x.getMinutes());</script></p>
        </div><!--/.nav-collapse -->
      </div>
    </div>
        
    <div class="container theme-showcase" role="main">   
        
        <script language="JavaScript" src="http://www.tfl.gov.uk/tfl/syndication/widgets/tubemap/tubemap-iframe-stretchy.js"></script>
        NOT WORKING ON MOBILE DEVICE. NOT DRAGGABLE!!!
    </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>

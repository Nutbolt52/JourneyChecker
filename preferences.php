<?php
    ini_set('session.cookie_httponly',1);
    $url= "http://cloud.tfl.gov.uk/TrackerNet/LineStatus";
    $expire=time()+60*60*24*30;
    $tflcache = 'tflcache.xml.cache';
    $tflcacheage = 30; //in second

    if(isset($_GET['delete'])) {
        setcookie('tubelines', null, -1, '/');
        header('Location: index.php');
        exit;
    }
    
    if (isset($_POST['line'])) {
        $linesselected = (filter_input(INPUT_POST, 'line', FILTER_SANITIZE_STRING, FILTER_REQUIRE_ARRAY));
        $tubelines = implode(',', $linesselected);
        setcookie("tubelines", $tubelines, $expire, "/", "", 0, true);
        header('Location: index.php');
        exit;
    }
    
       if(!file_exists($tflcache) || time() - filemtime($tflcache) > $tflcacheage) {
        $contents = file_get_contents($url);
        file_put_contents($tflcache, $contents);
        $xml = simplexml_load_file($tflcache);
        clearstatcache(); 
    } else {
        $xml = simplexml_load_file($tflcache);
    }

    
?>

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
        <title>Journey Checker - Preferences</title>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body style="padding-top:40px">
        
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
            <li class="active"><a href="#preferences">Preferences</a></li>
            <!--<li><a href="tube-map.php">Tube Map</a></li>-->
            <li><a href="about.php">About</a></li>
          </ul>
           <p class="navbar-text navbar-right">Updated at <?php PRINT date('H:i:s', filemtime($tflcache)) . " (" . date('T') . ")" ?></p>
        </div><!--/.nav-collapse -->
      </div>
    </div>
        
    <div class="container theme-showcase" role="main">   
        
        <div class="page-header">
            <h1>Set Your Preferences</h1>
        </div>
        <div class="well">
<?php
        
    if ($xml->LineStatus && $xml->LineStatus->Line){
        foreach ($xml->LineStatus as $row){
            $lines[(int)$row->Line['ID']] = array(
            'id' => (int)$row->Line['ID'],
            'name' => (string)$row->Line['Name'],
            'state' => (string)$row->Status['Description'],
            'cssclass' => (string)$row->Status['CssClass'],
            'details' => (string)$row['StatusDetails'],
            );
        }  
    }
?>
        <div class="container">
          <form class="form-preferences" role="form" method="post" action="preferences.php">
            <?php 
                foreach ($lines as $line) {
            ?>
            <label class="checkbox" style="margin-bottom:10px">
                <input type="checkbox" value="<?php print $line['name']; ?>" name="line[]"> <?php print $line['name']; ?>
            </label>
            <?php } ?>
            <button class="btn btn-primary" type="submit" name="submit">Save</button>
          </form>
         </div> <!-- /container -->
        </div>
        
        <hr>
        
        <div class="well">
            <p>Select all the underground lines you wish to view on the front page </p>
            <p>If you wish to change your selection simply set your preferences again </p>
            <p>Preferences are saved on your computer for 30 days </p>
            <p>To delete cookies saved on your computer click this handy button <a class="btn btn-xs btn-danger" href="?delete">Delete Preferences</a> </p>
        </div>
        
    </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>

<?php
   define('IN_APP', true);
   require_once('inc/functions.php');
   require_once('inc/menu.php');
   
   ini_set('session.cookie_httponly',1);
   $activepage='home';
   
   $tfl_url= "http://cloud.tfl.gov.uk/TrackerNet/LineStatus";
   $lines = array();
   $linescookie = array();
   $tflcache = 'tflcache.xml.cache';
   $tflcacheage = 30; //in seconds
   
   if (isset($_COOKIE['tubelines'])) {
       $linescookie = explode(',', filter_input(INPUT_COOKIE, 'tubelines', FILTER_SANITIZE_STRING));
       $cookieset = true;
   } else {
       $cookieset = false;
   }

   if(!file_exists($tflcache) || time() - filemtime($tflcache) > $tflcacheage) {
        $contents = file_get_contents($tfl_url);
        file_put_contents($tflcache, $contents);
        $xml = simplexml_load_file($tflcache);
        clearstatcache(); 
    } else {
        $xml = simplexml_load_file($tflcache);
    }

    if ($cookieset) {
    if ($xml->LineStatus && $xml->LineStatus->Line){
        foreach ($xml->LineStatus as $row){
            if(in_array($row->Line['Name'], $linescookie)){
                $lines[(int)$row->Line['ID']] = array(
                'id' => (int)$row->Line['ID'],
                'name' => (string)$row->Line['Name'],
                'state' => (string)$row->Status['Description'],
                'cssclass' => (string)$row->Status['CssClass'],
                'details' => (string)$row['StatusDetails'],
            );
          }
        }  
      }
    } else {
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
    }
   
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
        <link rel="image_src" href="img/logo_orange.png" />
        <link rel="image_src" href="img/icon_orange.png" />
        <link rel="canonical" href="http://www.journeychecker.com/">
        
        <!-- Bootstrap core CSS -->
        <link href="css/bootstrapcosmo.min.css" rel="stylesheet">
        <title>Journey Checker</title>
        
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body style="padding-top:50px">
        
    <?php
        $navbar = jgetmenu($activepage);
        print $navbar;
    ?>
        
    <div class="container theme-showcase" role="main">   
     
    <div class="jumbotron">
        <?php 
        if ($cookieset == FALSE){
        ?>
        <div>
            <div class="alert alert-warning fade in">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <p><strong>Welcome to Journey Checker!</strong> Set your preferences to limit which lines you see below</p>
                <h5>This website uses cookies to remember your preferences. By setting your preferences you are agreeing to allow this site to store cookies on your computer</h5>
                <p><a class="btn btn-default" href="preferences">Set Preferences</a></p>
            </div>
        </div>
        <?php } ?>
        
        <p>  
        <?php
        foreach ($lines as $line) {
        ?>
            <div class="panel <?php if ($line['cssclass']== 'GoodService' ) {print "panel-success";} else {print "panel-danger";} ?>">
            <div class="panel-heading"><h3 class="panel-title">     
        <?php print $line['name'];?> </h3></div>
            <div class="panel-body">  
        <?php
            print "<b>Tube Status: </b>" . $line['state'];
            if ($line['details'] !== '') {
                print "<br><b>Details: </b>" . $line['details'];
            }
            echo "</div></div>";
        }
        ?>
       
        </p>
    </div><!-- /.container -->
    
    <div class="alert alert-warning">
    <strong>Note: </strong>If there is a disruption the affected lines will turn red and details of the disruption will be provided</p>
    </div>
    
<?php
    include 'inc/footer.html'
?>
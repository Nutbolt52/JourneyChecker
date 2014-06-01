<?php
    define('IN_APP', true);
    require_once('inc/functions.php');
    require_once('inc/menu.php');
    session_start();
    
    ini_set('session.cookie_httponly',1);
    $activepage='pref';
    
    $expire=time()+60*60*24*30;

    if(isset($_GET['delete'])) {
        setcookie('tubelines', null, -1, '/');
        session_unset();
        session_destroy();
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
    
       if(!file_exists(TFLCACHE) || time() - filemtime(TFLCACHE) > TFLCACHEAGE) {
        $contents = file_get_contents(TFL_URL);
        file_put_contents(TFLCACHE, $contents);
        $xml = simplexml_load_file(TFLCACHE);
        clearstatcache(); 
    } else {
        $xml = simplexml_load_file(TFLCACHE);
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
        <link rel="canonical" href="http://www.journeychecker.com/preferences">
        
        <!-- Bootstrap CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrapcosmo.min.css" rel="stylesheet">
        <title>Journey Checker - Preferences</title>

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
        
<?php
    include 'inc/footer.html'
?>
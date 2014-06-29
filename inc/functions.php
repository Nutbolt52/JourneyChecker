<?php 
  defined('IN_APP') || die("Hands off!");
  require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
  require_once($_SERVER['DOCUMENT_ROOT'] . '/inc/menu.php');
  
    //Check if the TfL Cookie is set and if so put the chosen tube lines in the users session
    function jtflcheckforcookie () {
        if (isset($_COOKIE['tubelines'])) {
            $_SESSION['tfl_lines'] = explode(',', filter_input(INPUT_COOKIE, 'tubelines', FILTER_SANITIZE_STRING));
            $_SESSION['tflcookieset'] = true;
            jtflcookieupdate();
        } else {
            $_SESSION['tflcookieset'] = false;
        }
    }
  
    //TfL Data Caching
    function jtflcache () {
        if(!file_exists(TFLCACHE) || time() - filemtime(TFLCACHE) > TFLCACHEAGE) {
            $contents = file_get_contents(TFL_URL);
            file_put_contents(TFLCACHE, $contents);
            $xml = simplexml_load_file(TFLCACHE);
            clearstatcache(); 
        } else {
            $xml = simplexml_load_file(TFLCACHE);
        }
        return $xml;
    }
  
    //Read TfL Cached Data. Second parameter if set true listens to cookies; if set false will ignore any cookie preferences 
    function jtflreaddata ($xml,$all) {
        if ($_SESSION['tflcookieset'] && $all) {
            if ($xml->LineStatus && $xml->LineStatus->Line){
                foreach ($xml->LineStatus as $row){
                    if(in_array($row->Line['Name'], $_SESSION['tfl_lines'])){
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
        
        return $lines;
    }
    
    //Delete TfL Cookie
    function jtfldeletecookie () {
        setcookie('tubelines', null, -1, '/');
        session_unset();
        session_destroy();
        header('Location: /');
        exit;
    }
    
    //Set TfL Cookie
    function jtflsetcookie ($lines) {
        $expire=time()+60*60*24*30;
        $tubelines = implode(',', $lines);
        setcookie("tubelines", $tubelines, $expire, "/", "", 0, true);
        header('Location: /');
        exit;
    }
    
    //Recreate the TfL Cookie so it doesn't expire
    function jtflcookieupdate () { 
        $expire=time()+60*60*24*30;
        $tubelines = implode(',', $_SESSION['tfl_lines']);
        setcookie("tubelines", $tubelines, $expire, "/", "", 0, true);
    }
    
    //Create array to display out tfl lines
    function jtflprintlines ($lines) {
    
        $tfldisplaylines = '';
        foreach ($lines as $line) { 
            $tfldisplaylines.= '<div class="panel '; if ($line['cssclass']== 'GoodService' ) {$tfldisplaylines.='panel-success';} else {$tfldisplaylines.='panel-danger';} $tfldisplaylines.='">' ;
            $tfldisplaylines.= '<div class="panel-heading"><h3 class="panel-title">';     
            $tfldisplaylines.= $line['name'] . '</h3></div>'; 
            $tfldisplaylines.= '<div class="panel-body">';   

            $tfldisplaylines.='<b>Tube Status: </b>' . $line['state'];
            if ($line['details'] !== '') {
                $tfldisplaylines.= '<br><b>Details: </b>' . $line['details'];
            }
            $tfldisplaylines.= '</div></div>';
        }

        return $tfldisplaylines;   
    }
    
    
    
?>

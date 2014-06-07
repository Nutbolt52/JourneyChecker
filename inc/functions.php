<?php 
  defined('IN_APP') || die("Hands off!");
  require_once('config.php');
  require_once('inc/menu.php');
  
    //Check if the TfL Cookie is set and if so put the chosen tube lines in the users session
    function jtflcheckforcookie () {
        if (isset($_COOKIE['tubelines'])) {
            $_SESSION['tfl_lines'] = explode(',', filter_input(INPUT_COOKIE, 'tubelines', FILTER_SANITIZE_STRING));
            $_SESSION['tflcookieset'] = true;
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
    
  //Need the following functions:
  //jgetmenu 
  //jsetcookie
  //jgetcookie
  //jgettfldata
  //jcachetfldata
  //etc...
  

?>

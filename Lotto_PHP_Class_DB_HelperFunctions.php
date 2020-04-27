<?php
    // include_once('Lotto_PHP_DB_Config.php');
    include_once("Lotto_PHP_Class_DB_Active.php");
    include_once("Lotto_PHP_Class_DB_ShortCut.php");    
    include_once("Lotto_PHP_Class_DB_Output.php");

    // Helper Functions
    function withinRange($inputVal, $minVal=1,$maxVal=49) {
        if($inputVal>=$minVal && $inputVal<=$maxVal) {
            return $inputVal;
        }
        else {
            $value=NULL;
            exit();
        }
    }

    function cleanHtmlInput($value) {
        if(isset($value) && !empty($value) && $value!='' && strtolower($value)!='none') {
            $value  = filter_var($value, FILTER_SANITIZE_STRING); 
            $value  = trim($value);       
            $value  = htmlspecialchars($value);
            $value  = htmlentities($value);            
            $value  = stripslashes($value);
            $value  = strip_tags($value);
        }
        else {
            $value  = NULL;
        }
        return $value;
    }

    function cleanHtmlInputArray($assocArray2Clean) {
        $cleanAssocArray = [];
        
        foreach($assocArray2Clean as $arraKeys => $arrayValues) {
            $cleanAssocArray[$arraKeys] = cleanHtmlInput($arrayValues);
        }        
        return $cleanAssocArray;
    }
    
    function getUserIpAddress(){
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){ //ip from share internet
            $ip                             = $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){ //ip pass from proxy
            $ip                             = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
            $ip                             = $_SERVER['REMOTE_ADDR'];
        }
        $ip = cleanHtmlInput($ip);
        return $ip;
    }
    

?>
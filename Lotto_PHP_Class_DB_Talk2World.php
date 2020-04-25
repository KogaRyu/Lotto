<?php
    // include_once('Lotto_PHP_DB_Config.php');
    //include_once('Lotto_PHP_DB_Queries');
    include_once("Lotto_PHP_Class_DB_Active.php");
    include_once("Lotto_PHP_Class_DB_ShortCut.php");    
    include_once("Lotto_PHP_Class_DB_Output.php");
  
    function pOutputShort() {
        $extPDO = New EXT_PDO();
        //echo "<br> Hello PHP Ext PDO Creation.<br> \r";
        $requestDetails = $_POST;
        // Check Sender then act based on Sender.
        if($requestDetails){
            switch ($requestDetails["Request_Sender"]) {
                case 'lotto_twitter_user_name':                                      
                    $query2run = 'sql_Input_TwitterUser';
                    takeActionHelper($query2run,$requestDetails);
                    break;                
                case 'lotto_draw_date':                                      
                    $query2run = 'sql_Input_DrawDate';
                    takeActionHelper($query2run,$requestDetails);
                    break;
                case 'lotto_draw_type':                                      
                    $query2run = 'sql_Input_DrawType';
                    takeActionHelper($query2run,$requestDetails);
                    break;               
                case 'lotto_balls_signature':                                      
                    $query2run = 'sql_Input_BallSignature';
                    takeActionHelper($query2run,$requestDetails);
                    break;                
                case 'lotto_submit':                                      
                    $query2run = 'sql_Input_SubmitAll';
                    takeActionHelper($query2run,$requestDetails);
                    break;
                default:
                    # Unknown Request
                    break;
            }
        }
    }

    function takeActionHelper($sql_QueryName,$requestDetails,$dbQueriesFileName = 'Lotto_PHP_DB_Queries.php'){
        $userTimeStamp          = time();
        $userIP                 = getUserIpAddress();
        $requestDetails['lotto_reg_date']= $userTimeStamp;
        $requestDetails['lotto_ip_address']= $userIP;
        
        $dbQueriesFileObj       = include($dbQueriesFileName);
        $sql_Query2run          = $dbQueriesFileObj[$sql_QueryName];
        $sqlStatement_check2run = $sql_Query2run['query_select']['query'];
        $sqlParams_check2run    = $sql_Query2run['query_select']['params'];
        
        $stmtParams2Send=[];

        foreach ($sqlParams_check2run as $key => $key_value) {
            $stmtParams2Send[$key_value]= $requestDetails[$key_value];
        }

        //echo "Hello PHP PDO.<br> \r";
        $extPDO = New EXT_PDO();
        //echo "PHP Extended-PDO Created.<br> \r";
        $results = $extPDO->run($sqlStatement_check2run, $stmtParams2Send)->fetchAll();
        //echo "Query Run Query & Fetch All Results.<br> \r";        
        $output = New DB_Output($results);
        //echo "Results converted to Output.<br> \r";
        echo $output->getOutput().".<br> \r";
        //echo "Output Displayed.<br> \r";
        //echo "Bye PHP Ext PDO.<br> \r";
    }

    function getUserIpAddress(){
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            //ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            //ip pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
    

    function takeActionHelper2($sqlStatement2run,$stmtParams2Send = NULL){                            
        $extPDO = New EXT_PDO();
        echo "Hello PHP Ext PDO Query.<br> \r";
        $results = $extPDO->run($sqlStatement2run, $stmtParams2Send)->fetchAll();
        echo "Hello PHP Ext PDO Output.<br> \r";
        $output = New DB_Output($results);
        #$queryOutputout = $results->fetchAll();
        echo $output->getOutput().".<br> \r";
        #$output = $extPDO->fetch();      
        #$myActive=New DB_Active();
        echo "Bye PHP Ext PDO.<br> \r";
    }
    pOutputShort();
?>
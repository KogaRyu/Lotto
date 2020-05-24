<?php
    include_once("Lotto_PHP_Class_DB_Active.php");
    include_once("Lotto_PHP_Class_DB_ShortCut.php");    
    include_once("Lotto_PHP_Class_DB_Output.php");      
    include_once("Lotto_PHP_Class_DB_HelperFunctions.php");

    function pOutputShort() {
        $extPDO                             = New EXT_PDO();
        $inputFormDetails                   = $_POST;
        $formDetails                        = cleanHtmlInputArray($inputFormDetails);
        
        if($formDetails){
            switch ($formDetails["Request_Sender"]) {
                case 'lotto_twitter_user_name':                                      
                    $query2run              = 'sql_Input_TwitterUser';
                    takeActionHelper($query2run,$formDetails);
                    break;                
                case 'lotto_draw_date':                                      
                    $query2run              = 'sql_Input_DrawDate';
                    takeActionHelper($query2run,$formDetails);
                    break;
                case 'lotto_draw_type':                                      
                    $query2run              = 'sql_Input_DrawType';
                    takeActionHelper($query2run,$formDetails);
                    break;               
                case 'lotto_balls_signature':                                      
                    $query2run              = 'sql_Input_BallSignature';
                    takeActionHelper($query2run,$formDetails);
                    break;                
                case 'lotto_submit':                                      
                    $query2run              = 'sql_Input_SubmitAll';
                    takeActionHelper($query2run,$formDetails);
                    break;
                default:
                    # Unknown Request
                    break;
            }
        }
    }   

    function pOutputLong() {
        echo "Hello PHP Class Creation.<br>";
        $myDB_Class= New DB_Active();
        echo "Hello PHP Class Output.<br>";
        echo $myDB_Class->getOutput();
        echo "Bye PHP Class E.\n";
    }

    function takeActionHelper($sql_QueryName,$formDetails,$dbQueriesFileName = 'Lotto_PHP_DB_Queries.php'){
        $extPDO                                     = New EXT_PDO();
        $results                                    = null;
        $dbQueriesFileObj                           = include($dbQueriesFileName);
        $sql_Query2run                              = $dbQueriesFileObj[$sql_QueryName];
        $sql_QueryType2run                          = 'query_select';
        $check2run_sql_statement                    = $sql_Query2run[$sql_QueryType2run]['query'];
        $check2run_sql_params                       = $sql_Query2run[$sql_QueryType2run]['params'];       
        $formDetails['lotto_reg_date']              = date("Y-m-d H:i:s");
        $formDetails['lotto_ip_address']            = getUserIpAddress();       
        $stmtParams2Send                            = [];

        foreach ($check2run_sql_params as $arrayValue) {
            $stmtParams2Send[$arrayValue]           = $formDetails[$arrayValue];
        }
        
        $results                                = $extPDO->run($check2run_sql_statement, $stmtParams2Send)->fetchAll();            
        if (Count($results)<=0) {
            $sql_QueryType2run                          = 'query_insert';
            $check2run_sql_statement            = $sql_Query2run[$sql_QueryType2run]['query'];
            $check2run_sql_params               = $sql_Query2run[$sql_QueryType2run]['params'];

            foreach ($check2run_sql_params as $arrayValue) {
                $stmtParams2Send[$arrayValue]   = $formDetails[$arrayValue];
            }

            $results                            = $extPDO->run($check2run_sql_statement, $stmtParams2Send)->fetchAll();
        }
        $output                                 = New DB_Output($results);
        echo $output->getOutput().".<br> \r";
    }

    // pOutputShort();
    pOutputLong();
?>
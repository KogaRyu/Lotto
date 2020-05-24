<?php
include_once('Lotto_PHP_DB_Config.php');
include_once('Lotto_PHP_Class_DB_ReadConfig.php');
include_once('Lotto_PHP_Class_DB_Connection.php');
include_once('Lotto_PHP_Class_DB_Statement.php');
include_once('Lotto_PHP_Class_DB_FetchResults.php');
include_once('Lotto_PHP_Class_DB_Output.php');

class DB_Active {
    private $dbConnection;
    private $dbStatement;
    private $dbFetchResults;
    private $dbOutput;

    function __construct(){
        // Form Input
        $postFormInput                   = $_POST;
        $formInput                        = cleanHtmlInputArray($postFormInput);
                
        // DB Connect Config
        $dbConfigFile='Lotto_PHP_DB_Config.php';
        $dbName='db_lottery';

        // DB Queries Config
        $queriesConfigFileName='Lotto_PHP_DB_Queries.php';
        $dbFetchType='FETCH_ASSOC';
        $inputSettingsObj = include($queriesConfigFileName);

        $this->setConnection($dbConfigFile,$dbName='db_lottery');
        $query2run='';
        if($formInput){
            switch ($formInput["Request_Sender"]) {
                case 'lotto_twitter_user_name':                                      
                    $query2run              = 'sql_Input_TwitterUser';
                    break;                
                case 'lotto_draw_date':                                      
                    $query2run              = 'sql_Input_DrawDate';
                    break;
                case 'lotto_draw_type':                                      
                    $query2run              = 'sql_Input_DrawType';
                    break;               
                case 'lotto_balls_signature':                                      
                    $query2run              = 'sql_Input_BallSignature';
                    break;
                case 'lotto_submit_entry':                                      
                    $query2run              = 'sql_Input_BallSignature'; // *** Wanna Check this? ***
                    break;                
                case 'lotto_submit':                                      
                    $query2run              = 'sql_Input_SubmitAll';
                    break;
                default:
                    # Unknown Request
                    exit();
            }
        }
        
        $sqlQueryType2run                      = 'query_select';
        $this->query2action($formInput,$query2run,$sqlQueryType2run,$queriesConfigFileName,$dbFetchType);
        $itemsReturned = count($this->dbFetchResults);
        if ($itemsReturned <= 0) {
            $sqlQueryType2run                  = 'query_insert';
            $this->query2action($formInput,$query2run,$sqlQueryType2run,$queriesConfigFileName,$dbFetchType);
        }
        else {
            $sqlQueryType2run                  = 'query_update';
            // Not updatable: Twitter User,
            $this->query2action($formInput,$query2run,$sqlQueryType2run,$queriesConfigFileName,$dbFetchType);
        }
        $this->setOutput($this->dbFetchResults,$inputDbFormat='table');
    }
    
    private function query2action($formInput,$query2run,$sqlQueryType2run,$queriesConfigFileName,$dbFetchType) {
        $this->setStatement($formInput,$query2run,$sqlQueryType2run,$queriesConfigFileName);
        $this->setFetchResults($this->dbStatement, $dbFetchType);
    }

    private function setConnection($inputDbConfigFile='Lotto_PHP_DB_Config.php',$inputDbName='db_lottery'){
        $holderConnection=New DB_Connection($inputDbConfigFile,$inputDbName);
        $this->dbConnection=$holderConnection->getConnection();
    }

    private function setStatement($formInput,$sql_QueryName,$sqlQueryType2run='query_select',$dbQueryFileName = 'Lotto_PHP_DB_Queries.php'){
        $dbQueryFileObj                           = include($dbQueryFileName);
        $sqlQuery2run                             = $dbQueryFileObj[$sql_QueryName];
        $formInput['lotto_reg_date']              = date("Y-m-d H:i:s");
        $formInput['lotto_ip_address']            = getUserIpAddress();
        $formInput['lotto_submit_entry']          = 1;
        
        $statement2Check=New DB_Statement($this->dbConnection,$formInput, $sqlQuery2run, $sqlQueryType2run);
        $this->dbStatement=$statement2Check->getStatement();        
    }    

    private function setFetchResults($inputStatement, $dbFetchType){
        $holderFetchResults=New DB_FetchResults($inputStatement, $dbFetchType);
        $this->dbFetchResults=$holderFetchResults->getQueryResults();
    }

    private function setOutput($inputDbQueryResult,$inputDbFormat='table'){
        $holderOutput=New DB_Output($inputDbQueryResult,$inputDbFormat);
        $this->dbOutput=$holderOutput->getOutput();
    }

    public function getConnection(){
        return $this->dbConnection;
    }

    public function getStatement(){
        return $this->dbStatement;
    }

    public function getFetchResults(){
        return $this->dbFetchResults;
    }

    public function getOutput(){
        return $this->dbOutput;
    }
}
?>
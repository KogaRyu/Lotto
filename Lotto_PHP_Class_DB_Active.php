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
                case 'lotto_submit':                                      
                    $query2run              = 'sql_Input_SubmitAll';
                    break;
                default:
                    # Unknown Request
                    break;
            }
        }
        $this->setStatement($query2run,$formInput,$queriesConfigFileName);            
        $this->setFetchResults($this->dbStatement, $dbFetchType);
        $this->setOutput($this->dbFetchResults,$inputDbFormat='table');
    }

    function setConnection($inputDbConfigFile='Lotto_PHP_DB_Config.php',$inputDbName='db_lottery'){
        $holderConnection=New DB_Connection($inputDbConfigFile,$inputDbName);
        $this->dbConnection=$holderConnection->getConnection();
    }

    private function setStatement($sql_QueryName,$formInput,$dbQueryFileName = 'Lotto_PHP_DB_Queries.php'){
        $dbQueryFileObj                           = include($dbQueryFileName);
        $sql_Query2run                              = $dbQueryFileObj[$sql_QueryName];
        $sql_QueryType2run                          = 'query_select';
        $check2run_sql_statement                    = $sql_Query2run[$sql_QueryType2run]['query'];
        $check2run_sql_params                       = $sql_Query2run[$sql_QueryType2run]['params'];       
        $formInput['lotto_reg_date']              = date("Y-m-d H:i:s");
        $formInput['lotto_ip_address']            = getUserIpAddress();       
        $stmtParams2Send                            = [];

        foreach ($check2run_sql_params as $arrayValue) {
            $stmtParams2Send[$arrayValue]           = $formInput[$arrayValue];
        }        
        $statement2Check=New DB_Statement($this->dbConnection,$check2run_sql_statement,$stmtParams2Send);
        $this->dbStatement=$statement2Check->getStatement();
                    
        if (Count($this->dbStatement)<=0) {
            $sql_QueryType2run                  = 'query_insert';
            $insert2run_sql_statement            = $sql_Query2run[$sql_QueryType2run]['query'];
            $insert2run_sql_params               = $sql_Query2run[$sql_QueryType2run]['params'];

            foreach ($check2run_sql_params as $arrayValue) {
                $stmtParams2Send[$arrayValue]   = $formInput[$arrayValue];
            }
            $statement2Insert=New DB_Statement($this->dbConnection,$insert2run_sql_statement,$insert2run_sql_params);
            $this->dbStatement=$statement2Insert->getStatement();
        }
    }

    private function setFetchResults($inputStatement){
        $holderFetchResults=New DB_FetchResults($inputStatement);
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
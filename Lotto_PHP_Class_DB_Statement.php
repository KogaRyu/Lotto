<?php
include_once('Lotto_PHP_DB_Config.php');
include_once("Lotto_PHP_Class_DB_Connection.php");

class DB_Statement {
    # Use on the calling File: include("class_lib.php");
    private $dbConnection;
    private $sqlStatement;
    private $sqlQuery;
    private $sqlParams;
    private $resultsString;

    function __construct($dbConnection=NULL, $formInput, $sqlQuery2run='sql_Input_SubmitAll', $sqlQueryType2run='query_select') {
        $this->dbConnection = $dbConnection;
        $sqlInput = $this->pipePrepareInputSettings($formInput, $sqlQuery2run, $sqlQueryType2run);

        $this->sqlQuery = $sqlInput['query'];
        $this->sqlParams = $sqlInput['params'];

        $this->sqlStatement = $this->SQL_Query_2_Run($this->sqlQuery,$this->sqlParams);
    }

    private function pipePrepareInputSettings($formInput, $sqlQuery2run='sql_Input_SubmitAll', $sqlQueryType2run='query_select') {
        $sql2run_statement                      = $sqlQuery2run[$sqlQueryType2run]['query'];
        $sql2run_params                         = $sqlQuery2run[$sqlQueryType2run]['params'];
        $sql2run_paramsHolder                   = null;
        
        foreach ($sql2run_params as $arrayValue) {
            $sql2run_paramsHolder[$arrayValue] = $formInput[$arrayValue];
        }

        return ['query'=>$sql2run_statement,'params'=>$sql2run_paramsHolder];
    }

    private function SQL_Query_2_Run($sqlQuery,$sqlParams) {
        if (!$sqlParams){ // Query has no Parameters
            $stmt = $this->dbConnection->query($sqlQuery);
        }
        else { // Query has Parameters       
            $stmt = $this->dbConnection->prepare($sqlQuery);
            $stmt->execute($sqlParams);
        }
        return $stmt;
    }

    public function getStatement() {
        return $this->sqlStatement;
    }
}
?>

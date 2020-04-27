<?php
include_once('Lotto_PHP_DB_Config.php');
include_once("Lotto_PHP_Class_DB_Connection.php");

class DB_Statement {
    # Use on the calling File: include("class_lib.php");
    private $dbConnection;
    private $sqlStatement;
    private $resultsString;
    private $sqlQuery='';
    private $sqlParams=[];

    function __construct($dbConnection=NULL,$sqlQuery='',$sqlParams=[]) {
        $this->dbConnection = $dbConnection;      
        $this->sqlQuery = $sqlQuery;
        $this->sqlParams = $sqlParams;
        $this->sqlStatement = $this->SQL_Query_2_Run($this->sqlQuery,$this->sqlParams)->fetchAll();
    }

    private function setInputSettings($inputSettings){

    }

    private function SQL_Query_2_Run($sqlQuery='',$sqlParams=[]) {
        if (!$sqlParams){ // Query has no Parameters
            return $this->dbConnection->query($sqlQuery);
        }
        else { // Query has Parameters       
            $stmt = $this->dbConnection->prepare($sqlQuery);
            $stmt->execute($sqlParams);
            return $stmt;
        }
    }

    public function getStatement() {
        return $this->sqlStatement;
    }
}
?>

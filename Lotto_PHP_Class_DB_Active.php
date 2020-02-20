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
        // DB Connect Config
        $dbConfigFile='Lotto_PHP_DB_Config.php';
        $dbName='db_lottery';

        // DB Queries Config
        $queriesconfigFile='Lotto_PHP_DB_Queries.php';
        $selectQueryName='SQL_Select_1';
        $selectQueryParams='query_params';
        $dbFetchType='FETCH_ASSOC';

        $inputSettingsobj= New Read_ConfigFile($queriesconfigFile,$selectQueryName,$selectQueryParams);
  
        $this->setConnection($dbConfigFile='Lotto_PHP_DB_Config.php',$dbName='db_lottery');
        $this->setStatement($this->dbConnection,$inputSettingsobj);            
        $this->setFetchResults($this->dbStatement, $dbFetchType);
        $this->setOutput($this->dbFetchResults,$inputDbFormat='table');
    }

    function setConnection($inputDbConfigFile='Lotto_PHP_DB_Config.php',$inputDbName='db_lottery'){
        $holderConnection=New DB_Connection($inputDbConfigFile,$inputDbName);
        $this->dbConnection=$holderConnection->getConnection();
    }

    private function setStatement($inputConnection,$inputSettings){
        $holderStatement=New DB_Statement($inputConnection,$inputSettings);
        $this->dbStatement=$holderStatement->getStatement();
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
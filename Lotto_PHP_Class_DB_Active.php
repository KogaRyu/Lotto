<?php
include_once('Lotto_PHP_DB_Config.php');
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
        $dbConfigFile='Lotto_PHP_DB_Config.php';
        $dbName='db_lottery';
        $inputSettings=array(# table,user,draw,balls,query,Output
            'table_name'=>'',
            'twitter_user'=>'',
            'draw_type'=>'',
            'draw_date'=>'',
            'balls_signature'=>'',
            'query2Run'=>'SQL_Select_1',
            'results2Output'=>'Results2Table_1'
        );
        
        $this->setConnection($dbConfigFile='Lotto_PHP_DB_Config.php',$dbName='db_lottery');
        $this->setStatement($this->dbConnection,$inputSettings);            
        $this->setFetchResults($this->dbStatement);
        $this->setOutput($this->dbFetchResults,$inputDbFormat='table');
    }

    function setConnection($inputDbConfigFile='Lotto_PHP_DB_Config.php',$inputDbName='db_lottery'){
        $holderConnection=New DB_Connection($inputDbConfigFile,$inputDbName);
        $this->dbConnection=$holderConnection->getConnection();
    }

    function setStatement($inputConnection=NULL,$inputSettings=''){
        $holderStatement=New DB_Statement($inputConnection,$inputSettings);
        $this->dbStatement=$holderStatement->getStatement();
    }

    function setFetchResults($inputStatement=NULL){
        $holderFetchResults=New DB_FetchResults($inputStatement);
        $this->dbFetchResults=$holderFetchResults->getFetchResults();
    }

    function setOutput($inputDbQueryResult=NULL,$inputDbFormat='table'){
        $holderOutput=New DB_Output($inputDbQueryResult,$inputDbFormat);
        $this->dbOutput=$holderOutput->getOutput();
    }

    function getConnection(){
        return $this->dbConnection;
    }

    function getStatement(){
        return $this->dbStatement;
    }

    function getFetchResults(){
        return $this->dbFetchResults;
    }

    function getOutput(){
        return $this->dbOutput;
    }
    
}
?>
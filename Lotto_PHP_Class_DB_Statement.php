<?php
include_once('Lotto_PHP_DB_Config.php');
include_once("Lotto_PHP_Class_DB_Connection.php");

class DB_Statement {
    # Use on the calling File: include("class_lib.php");
    private $dbSqlStatement=NULL;
    private $resultsString;
    private $sqlString;        
    private $currentTable=NULL;

    function __construct($dbConnection=NULL,$inputSettings=[]) {            
        $this->SQL_Query2Run($dbConnection,$inputSettings);
    }

    private function setInputSettings($inputSettings){

    }

    private function SQL_Query2Run($dbConnection,$inputSettings) {
        $query2run=$inputSettings['query2Run'];
        switch ($query2run) {
            case 'SQL_Select_1':
                $this->SQL_Select($dbConnection,$inputSettings); # CRUD
                break;
            case 'SQL_Select_2':
                $this->SQL_Select($dbConnection,$inputSettings); # CRUD
                break;
            case 'SQL_Insert_1':
                $this->SQL_Insert($dbConnection,$inputSettings); # CRUD
                break;
            case 'SQL_Insert_2':
                $this->SQL_Insert($dbConnection,$inputSettings); # CRUD
                break;
            default:
        }
    }

    private function SQL_Select($dbConnection=NULL,$inputSettings,$Select2Execute=1) {
        $this->currentTable= $inputSettings['table_name'];
        if ($Select2Execute==1 || $Select2Execute==2) {
            $this->sqlString=
                "SELECT `twitter_user`,`draw_date`, `draw_type`, COUNT(`balls_signature`)
                FROM $this->currentTable
                WHERE draw_date=:draw_date AND draw_type=:draw_type
                ORDER BY `twitter_user`,`draw_date`, `draw_type`,balls_signature DESC
                ";
        }
        elseif ($Select2Execute==3) {
            $this->sqlString=
                "SELECT `twitter_user`,`draw_date`, `draw_type`, COUNT(`balls_signature`)
                FROM $this->currentTable
                WHERE draw_date=:draw_date AND draw_type=:draw_type
                ORDER BY balls_signature DESC";
        }
        else {
            $this->sqlString="SELECT `twitter_user`,`draw_date`, `draw_type`, COUNT(`balls_signature`) FROM $this->currentTable WHERE draw_date=:draw_date AND draw_type=:draw_type ORDER BY balls_signature DESC";
        } #Remember to Sort by Draw Date & Type
        
        $this->sqlStatement=$dbConnection->prepare($this->sqlString);        
        
        $this->sqlStatement->bindParam(':twitter_user',$inputSettings['twitter_user']);
        $this->sqlStatement->bindParam(':draw_date',$inputSettings['draw_date']);
        $this->sqlStatement->bindParam(':draw_type',$inputSettings['draw_type']);
        $this->sqlStatement->execute();
    }

    private function SQL_Insert($dbConnection,$inputSettings) {            
        try {
            # $ballPlanned;
            $this->currentTable= $inputSettings['table_name'];
            $this->sqlString="INSERT INTO $this->currentTable (`twitter_user`,`draw_date`, `draw_type`, `balls_signature`) VALUES (:twitter_user, :draw_date, :draw_type, :balls_signature)";
            $this->sqlStatement=$dbConnection->prepare($this->sqlString); # If Prepared, Change $this->connection to $this->sqlStatement?
            
            # *** Begin the transaction ***
            $dbConnection->beginTransaction();
            $this->sqlStatement->bindParam(':twitter_user',$inputSettings['twitter_user']);
            $this->sqlStatement->bindParam(':draw_date',$inputSettings['draw_date']);
            $this->sqlStatement->bindParam(':draw_type',$inputSettings['draw_type']);
            $this->sqlStatement->bindParam(':balls_signature',$inputSettings['balls_signature']);
            $this->sqlStatement->execute();
            #$this->sqlStatement->execute($inputSettings['balls_signature']);

            # *** Commit the transaction ***
            $dbConnection->commit();
            echo "New records created successfully";
        }
        catch(PDOException $ex) {
            # *** Roll back the transaction if something failed ***
            $dbConnection->rollback();
            echo "Error: " . $ex->getMessage();
        }
        # *** Terminate ***
        $dbConnection=NULL;
    }

    public function getStatement() {
        return $this->dbSqlStatement;
    }
}
?>

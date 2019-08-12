<?php
    include_once("Lotto_PHP_Class_DB_Connection.php");

    class DB_FetchResults {
        # Use on the calling File: include("class_lib.php");
        private $dbQueryResults=NULL;
        
        function __construct($dbSqlStatement=NULL,$dbFetchType='FETCH_ASSOC') {        
            $this->setQueryResults($dbSqlStatement,$dbFetchType);
        }

        private function setQueryResults($dbSqlStatement,$dbFetchType) { # https://phpdelusions.net/pdo/fetch_modes  
            # FETCH_BOTH: The row is returned in the form of array, where data is duplicated, to be accessed via both numeric and associative indexes
            /*  array (
                'id' => '104', 0 => '104',
                'name' => 'John', 1 => 'John',
                'sex' => 'male', 2 => 'male',
                'car' => 'Toyota', 3 => 'Toyota')
            */

            switch ($dbFetchType) {
                case 'FETCH_BOTH':
                    $this->dbQueryResults=$dbSqlStatement->setFetchMode(PDO::FETCH_BOTH);
                    break;
                case 'FETCH_NUM': # Numeric indices only
                    $this->dbQueryResults=$dbSqlStatement->setFetchMode(PDO::FETCH_NUM);
                    break;
                case 'FETCH_ASSOC': # Associative indices only
                    $this->dbQueryResults=$dbSqlStatement->setFetchMode(PDO::FETCH_ASSOC);
                    break;
                case 'FETCH_KEY_PAIR':
                    $this->dbQueryResults=$dbSqlStatement->setFetchMode(PDO::FETCH_KEY_PAIR);
                    break;
                case 'FETCH_COLUMN':
                    $this->dbQueryResults=$dbSqlStatement->setFetchMode(PDO::FETCH_COLUMN);
                    break;
                case 'FETCH_UNIQUE':
                    $this->dbQueryResults=$dbSqlStatement->setFetchMode(PDO::FETCH_UNIQUE);
                    break;
                case 'FETCH_GROUP':
                    $this->dbQueryResults=$dbSqlStatement->setFetchMode(PDO::FETCH_GROUP);
                    break;
                default:
                    $this->dbQueryResults=$dbSqlStatement->setFetchMode(PDO::FETCH_BOTH);
                    break;
            }
        }
        public function getQueryResults() {      
            return $this->dbQueryResults;
        }

    }
?>

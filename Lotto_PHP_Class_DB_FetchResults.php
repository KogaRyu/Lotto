<?php
    include_once("Lotto_PHP_Class_DB_Connection.php");

    class DB_FetchResults {
        # Use on the calling File: include("class_lib.php");
        private $dbQueryResults;
        
        function __construct($dbSqlStatement,$sqlQuery2run,$dbFetchType='FETCH_ASSOC') {        
            $this->setQueryResults($dbSqlStatement,$sqlQuery2run,$dbFetchType);
        }

        private function setQueryResults($dbSqlStatement,$sqlQuery2run,$dbFetchType) { # https://phpdelusions.net/pdo/fetch_modes
            switch ($sqlQuery2run) {
                case 'query_select':
                    $this->dbQueryResults=$dbSqlStatement->fetchAll(PDO::FETCH_ASSOC);
                    break;
                case 'query_insert':
                    $this->dbQueryResults = $dbSqlStatement->lastInsertId();
                    break;
                case 'query_update':
                    $this->dbQueryResults = $dbSqlStatement->rowCount();
                    break;
                default: // Error
                    $this->dbQueryResults = $dbSqlStatement->errorInfo();
                    break;
            }
        }

        public function getQueryResults() {      
            return $this->dbQueryResults;
        }

        public function funcFetchResults($dbSqlStatement) {
            try {                        
                    $this->dbQueryResults = $dbSqlStatement->lastInsertId();
                }
            catch (Throwable $f) {
                try {                        
                    $this->dbQueryResults = $dbSqlStatement->rowCount();
                }
                catch (Throwable $g) {
                    $this->dbQueryResults = $dbSqlStatement->errorInfo();
                }
            }
        }

    }
?>

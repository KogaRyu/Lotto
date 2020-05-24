<?php
    include_once("Lotto_PHP_Class_DB_Connection.php");

    class DB_FetchResults {
        # Use on the calling File: include("class_lib.php");
        private $dbQueryResults;
        
        function __construct($dbSqlStatement,$dbFetchType='FETCH_ASSOC') {        
            $this->setQueryResults($dbSqlStatement,$dbFetchType);
        }

        private function setQueryResults($dbSqlStatement,$dbFetchType) { # https://phpdelusions.net/pdo/fetch_modes
            try {
                $this->dbQueryResults=$dbSqlStatement->fetchAll(PDO::FETCH_ASSOC);
            }
            catch (Throwable $e) {
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

        public function getQueryResults() {      
            return $this->dbQueryResults;
        }

        public function funcFetchResults($dbSqlStatement) {
            try {                        
                    $this->dbQueryResults = $dbSqlStatement->lastInsertId();
                }
            catch (Throwable $th) {
                try {                        
                    $this->dbQueryResults = $dbSqlStatement->rowCount();
                }
                catch (Throwable $th) {
                    $this->dbQueryResults = $dbSqlStatement->errorInfo();
                }
            }
        }

    }
?>

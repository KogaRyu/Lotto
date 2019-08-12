<?php
    class DB_Connection {
        # Use on the calling File: include("class_lib.php");
        private $dbDsn;
        private $dbUser;
        private $dbPwd;
        # DB  Driver/Engine Type: mysql, mssql, sqlite, sybase
        # https://code.tutsplus.com/tutorials/why-you-should-be-using-phps-pdo-for-database-access--net-12059
        private $dbConnection=NULL;
        
        function __construct($dbConfigfile='Lotto_PHP_DB_Config.php', $dbName='db_lottery'){
            //TODO: Add exception handling
            $dbConfig = include($dbConfigfile);
            $DsnDetails=$dbConfig[$dbName];
            $this->setDsn($DsnDetails);
            $this->setUser($DsnDetails);
            $this->setPwd($DsnDetails);
            $this->setConnection($DsnDetails);
        }

        private function setDsn($DsnDetails) {
            $dbCharset=$DsnDetails['charset'];
            $dbDriver=$DsnDetails['Driver'];
            $dbHost=$DsnDetails['Host'];
            $dbDB=$DsnDetails['DB'];
            
            #$this->dbDsn="$dbDriver:host=$dbHost;dbname=$dbDB;$dbCharset=utf8";
            $this->dbDsn=$dbDriver.":host=".$dbHost.";dbname=".$dbDB.";charset=".$dbCharset;
        }
        
        private function setUser($DsnDetails) {            
            $this->dbUser=$DsnDetails['User'];
        }

        private function setPwd($DsnDetails) {
            $this->dbPwd=$DsnDetails['Password'];
        }
        
        private function setConnection($DsnDetails) {            
            // $dbUser=$DsnDetails['User'];
            // $dbPwd=$DsnDetails['Password'];
            try {
                $this->dbConnection=new PDO($this->dbDsn,$this->dbUser,$this->dbPwd);
                // set the PDO error mode to exception
                $this->dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo "<h3> Successful: DB connection. </h3>";
            }
            catch (PDOException $ex) {
                $myError = $ex->getMessage();
                throw new Exception("<h5> Error: DB connection. $myError</h5>");
                $this->dbConnection=NULL;
            }
        }

        public function getConnection() {
            if ($this->dbConnection==NULL) {
                throw new Exception("<h5> Failure: No Valid Connection. </h5>");
            }                    
            else {
                echo "<h3> Success: Valid Connection. </h3>";
                return $this->dbConnection;
            }
        }
    }
?>

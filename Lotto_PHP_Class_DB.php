<?php
    include('Lotto_PHP_DB_Config.php');
    include("Lotto_PHP_Class_DB_Connection.php");

    class DB_Action {
        private $resultsString;
        private $sqlString;
        private $connection=NULL;
        private $sqlStatement=NULL;
        private $queryResult=NULL;
        private $currentTable=NULL;
        
        function __construct($connectionDetails=array('Server'=>'localhost','DB'=>'db_lottery','User'=>'usr_devuser','Password'=>'DevPass@von24','Query'=>'')) {
            $this->nameServer=$connectionDetails['Server'];
            $this->nameDB=$connectionDetails['DB'];
            $this->userName=$connectionDetails['User'];
            $this->pwd=$connectionDetails['Password'];
            #$this->dsn="mysql:host=$this->nameServer;dbname=$this->nameDB;charset=utf8";
            $this->dsn="mysql:host=".$this->nameServer.";dbname=".$this->nameDB.";charset=utf8";        
            $this->sqlString=$connectionDetails['Query'];
            $this->Connect();
            $mytableName="tblnumbersplanned";
            $inputSettings=array('drawDate'=>'localhost','drawType'=>'db_lottery','userName'=>'usr_devuser');
            $ballsPlanned=array('ball_1'=>'','ball_2'=>'','ball_3'=>'','ball_4'=>'','ball_5'=>'','ball_6'=>'');
            $this->validateInput($inputSettings);
            $this->validateInput($ballsPlanned);
            $this->SQL_Select_1($mytableName, $inputSettings, $ballsPlanned); # CRUD                        
            $this->SQL_Insert($mytableName, $inputSettings, $ballsPlanned); # CRUD            
            $this->QueryResults();
            $this->Results2Table(); # Or
            # $this->Results2JSon(); # Or Whatever
            $this->OutputDB();    
        }

        private function cleanHtmlInput($htmlInput) {
            if( isset($htmlInput) ) {
                $htmlInput = trim($htmlInput);
                if( $htmlInput != '' && $htmlInput != 'none"' ) {
                    $htmlInput = stripslashes($htmlInput);
                    $htmlInput = htmlspecialchars($htmlInput);
                }
                else {
                    exit();
                }
            }
            else {
                $htmlInput=NULL;
                exit();
                }          
            return $htmlInput;
        }

        function validateInput($drawDate,$drawType,$userName,$myNumbers) {

            $inputSettings = array('drawDate' => $drawDate,'drawType' => $drawType,'userName' => $userName);
            $drawDate = $this->makeAssocInput('drawDate');            
            $drawType = $this->makeAssocInput('drawType');
            $userName = $this->makeAssocInput('userName');

            $myNumbersKeys = array('ball_1','ball_2','ball_3','ball_4','ball_5','ball_6');
            $myNumbers = $this->makeAssocInput($myNumbersKeys);

            foreach ($myNumbersKeys as $key => $value) {
                $myNumbers = $this->cleanHtmlInput($myNumbersKeys);
            }

            $listInputs = Array('settingsInput' => $inputSettings,'myNumbersInputs' => $myNumbers);
        }

        function makeAssocInput($keyAssocs, $postMethod = 'POST') {            
            $holder = array();
            if ($postMethod == 'POST') {
                foreach ($keyAssocs as $keyAssoc) {
                    $assocVal = $this->cleanHtmlInput($_POST[$keyAssoc]);
                    array_push($holder,array($keyAssoc => $assocVal));                    
                }                
            }
            else if ($postMethod == 'GET'){
                foreach ($keyAssocs as $keyAssoc) {
                    $assocVal = $this->cleanHtmlInput($_GET[$keyAssoc]);
                    array_push($holder,array($keyAssoc => $assocVal));                    
                }
            }
            else {
                foreach ($keyAssocs as $keyAssoc) {
                    $assocVal = $this->cleanHtmlInput($_REQUEST[$keyAssoc]);
                    array_push($holder,array($keyAssoc => $assocVal));                    
                }
            }  
            return $holder;                       
        }

        private function Connect() {
        }

        private function QueryResults($fetchType='FETCH_ASSOC') { # https://phpdelusions.net/pdo/fetch_modes         
 
        }

        public function OutputDB() {
        }
    }
?>

<?php
    include_once("Lotto_PHP_Class_DB_Connection.php");

    class DB_Output {
        # Use on the calling File: include("class_lib.php");
        private $dbOutput='';
        
        function __construct($dbQueryResult=NULL,$dbFormat='table') {
            $this->setOutput($dbQueryResult,$dbFormat);   
        }

        private function setOutput($dbQueryResult,$dbFormat) { # Make FieldNames & Values Dynamic            
            switch ($dbFormat) {
                case 'table':
                    $this->dbOutput=$this->Results2Table($dbQueryResult);
                    break;
                case 'form': # 
                    $this->dbOutput=$this->Results2Form($dbQueryResult);
                    break;
                case 'json': # 
                    $this->dbOutput=$this->Results2JSon($dbQueryResult);
                    break;
                case 'xml': # 
                    $this->dbOutput=$this->Results2Xml($dbQueryResult);
                    break;
                case 'other': # 
                    $this->dbOutput=$this->Results2Other($dbQueryResult);
                    break;
                default:
                    $this->dbOutput=$this->Results2Error($dbQueryResult);
                    break;
            }
        }

        public function getOutput() {
            echo $this->dbOutput;
        }
        
        private function Results2Table($dbQueryResult) { # Make FieldNames & Values Dynamic            
            if ($dbQueryResult->num_rows > 0) {
                $resultsStructure=$dbQueryResult->fetchAll();
                $this->resultsString="<table>";
                // foreach ($resultsStructure as $myKey=>$myVal) {
                //     $this->resultsString.="<tr><th>".$myKey[0]."</th><th>".$myKey[1]."</th><th>".$myKey[2]."</th><th>".$myKey[3]."</th></tr>";
                // }
                $countHeader=0;
                $this->resultsString.="<tr><th>Draw_Date</th><th>Draw_Type</th><th>Balls_Planned</th></tr>";        
                foreach ($resultsStructure as $myKey=>$myVal){
                    if ($countHeader==0) {
                        # code...
                        $this->resultsString.="<tr><th>".$myKey["drawDate"]."</th><th>".$myKey["drawType"]."</th><th>".$myKey["Balls_Planned"]."</th></tr>";
                    }
                    else {
                        # code...
                        $this->resultsString.="<tr><td>".$myVal["drawDate"]."</td><td>".$myVal["drawType"]."</td><td>".$myVal["Balls_Planned"]."</td></tr>";
                    }
                    $countHeader++;                    
                }
                $this->resultsString.="</table>";
            }
            else {
                $this->resultsString.="0 results";
            }
        }

        private function Results2Form($dbQueryResult) { # Make FieldNames & Values Dynamic            
            if ($this->queryResult->num_rows > 0) {
                $resultsStructure=$this->queryResult->fetchAll();
                $this->resultsString="<table>";
                // foreach ($resultsStructure as $myKey=>$myVal) {
                //     $this->resultsString.="<tr><th>".$myKey[0]."</th><th>".$myKey[1]."</th><th>".$myKey[2]."</th><th>".$myKey[3]."</th></tr>";
                // } `Draw_Date`, `Draw_Type`, `Balls_Planned`
                $this->resultsString.="<tr><th>Draw_Date</th><th>Draw_Type</th><th>Balls_Planned</th></tr>";        
                foreach ($resultsStructure as $myKey=>$myVal){
                    $this->resultsString.="<tr><td>".$myVal["practicenumber"]."</td><td>".$myVal["name"]."</td><td>".$myVal["specialty"]."</td><td>".$myVal["fee"]."</td></tr>";
                }
                $this->resultsString.="</table>";
            }
            else {
                $this->resultsString.="0 results";
            }
        }

        private function Results2JSon($dbQueryResult) { # Make FieldNames & Values Dynamic            
            if ($this->queryResult->num_rows > 0) {
                $resultsStructure=$this->queryResult->fetchAll();
                $this->resultsString="<table>";
                // foreach ($resultsStructure as $myKey=>$myVal) {
                //     $this->resultsString.="<tr><th>".$myKey[0]."</th><th>".$myKey[1]."</th><th>".$myKey[2]."</th><th>".$myKey[3]."</th></tr>";
                // } `Draw_Date`, `Draw_Type`, `Balls_Planned`
                $this->resultsString.="<tr><th>Draw_Date</th><th>Draw_Type</th><th>Balls_Planned</th></tr>";        
                foreach ($resultsStructure as $myKey=>$myVal){
                    $this->resultsString.="<tr><td>".$myVal["practicenumber"]."</td><td>".$myVal["name"]."</td><td>".$myVal["specialty"]."</td><td>".$myVal["fee"]."</td></tr>";
                }
                $this->resultsString.="</table>";
            }
            else {
                $this->resultsString.="0 results";
            }
        }

        private function Results2Xml($dbQueryResult) { # Make FieldNames & Values Dynamic            
            if ($this->queryResult->num_rows > 0) {
                $resultsStructure=$this->queryResult->fetchAll();
                $this->resultsString="<table>";
                // foreach ($resultsStructure as $myKey=>$myVal) {
                //     $this->resultsString.="<tr><th>".$myKey[0]."</th><th>".$myKey[1]."</th><th>".$myKey[2]."</th><th>".$myKey[3]."</th></tr>";
                // } `Draw_Date`, `Draw_Type`, `Balls_Planned`
                $this->resultsString.="<tr><th>Draw_Date</th><th>Draw_Type</th><th>Balls_Planned</th></tr>";        
                foreach ($resultsStructure as $myKey=>$myVal){
                    $this->resultsString.="<tr><td>".$myVal["practicenumber"]."</td><td>".$myVal["name"]."</td><td>".$myVal["specialty"]."</td><td>".$myVal["fee"]."</td></tr>";
                }
                $this->resultsString.="</table>";
            }
            else {
                $this->resultsString.="0 results";
            }
        }

        private function Results2Other($dbQueryResult) { # Make FieldNames & Values Dynamic            
            if ($this->queryResult->num_rows > 0) {
                $resultsStructure=$this->queryResult->fetchAll();
                $this->resultsString="<table>";
                // foreach ($resultsStructure as $myKey=>$myVal) {
                //     $this->resultsString.="<tr><th>".$myKey[0]."</th><th>".$myKey[1]."</th><th>".$myKey[2]."</th><th>".$myKey[3]."</th></tr>";
                // } `Draw_Date`, `Draw_Type`, `Balls_Planned`
                $this->resultsString.="<tr><th>Draw_Date</th><th>Draw_Type</th><th>Balls_Planned</th></tr>";        
                foreach ($resultsStructure as $myKey=>$myVal){
                    $this->resultsString.="<tr><td>".$myVal["practicenumber"]."</td><td>".$myVal["name"]."</td><td>".$myVal["specialty"]."</td><td>".$myVal["fee"]."</td></tr>";
                }
                $this->resultsString.="</table>";
            }
            else {
                $this->resultsString.="0 results";
            }
        }

        private function Results2Error($dbQueryResult) { # Make FieldNames & Values Dynamic            
            if ($this->queryResult->num_rows > 0) {
                $resultsStructure=$this->queryResult->fetchAll();
                $this->resultsString="<table>";
                // foreach ($resultsStructure as $myKey=>$myVal) {
                //     $this->resultsString.="<tr><th>".$myKey[0]."</th><th>".$myKey[1]."</th><th>".$myKey[2]."</th><th>".$myKey[3]."</th></tr>";
                // } `Draw_Date`, `Draw_Type`, `Balls_Planned`
                $this->resultsString.="<tr><th>Draw_Date</th><th>Draw_Type</th><th>Balls_Planned</th></tr>";        
                foreach ($resultsStructure as $myKey=>$myVal){
                    $this->resultsString.="<tr><td>".$myVal["practicenumber"]."</td><td>".$myVal["name"]."</td><td>".$myVal["specialty"]."</td><td>".$myVal["fee"]."</td></tr>";
                }
                $this->resultsString.="</table>";
            }
            else {
                $this->resultsString.="0 results";
            }
        }
    }
?>

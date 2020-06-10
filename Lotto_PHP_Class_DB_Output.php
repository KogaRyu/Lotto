<?php
    include_once("Lotto_PHP_Class_DB_Connection.php");

    class DB_Output {
        # Use on the calling File: include("class_lib.php");
        protected $dbOutput='';
        
        function __construct($dbQueryResult=NULL,$dbFormat='table') {
            $this->setOutput($dbQueryResult,$dbFormat);   
        }

        protected function setOutput($dbQueryResult,$dbFormat) { # Make FieldNames & Values Dynamic            
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
            return $this->dbOutput;
        }
        
        protected function Results2Table($dbQueryResult) { # Make FieldNames & Values Dynamic  
            $resultsString="";          
            if (Count($dbQueryResult) > 1) {
                //$resultsStructure=$dbQueryResult->fetchAll();
                $resultsStructure=$dbQueryResult;#->fetchAll();
                $resultsString="<table>";
                // foreach ($resultsStructure as $myKey=>$myVal) {
                //     $resultsString.="<tr><th>".$myKey[0]."</th><th>".$myKey[1]."</th><th>".$myKey[2]."</th><th>".$myKey[3]."</th></tr>";
                // }
                $countHeader=0;
                $resultsString.="<tr><th>Draw_Date</th><th>Draw_Type</th><th>Balls_Planned</th></tr>";        
                foreach ($resultsStructure as $myKey=>$myVal){
                    if ($countHeader==0) {
                        # code...
                        $resultsString.="<tr><th>".$myKey["drawDate"]."</th><th>".$myKey["drawType"]."</th><th>".$myKey["Balls_Planned"]."</th></tr>";
                    }
                    else {
                        # code...
                        $resultsString.="<tr><td>".$myVal["drawDate"]."</td><td>".$myVal["drawType"]."</td><td>".$myVal["Balls_Planned"]."</td></tr>";
                    }
                    $countHeader++;                    
                }
                $resultsString.="</table>";
            }
            else {
                $resultsString.="0 results <br>";
            }
            return $resultsString;
        }

        protected function Results2Form($dbQueryResult) { # Make FieldNames & Values Dynamic  
            $resultsString="";            
            if ($this->queryResult->num_rows > 0) {
                $resultsStructure=$this->queryResult->fetchAll();
                $resultsString="<table>";
                // foreach ($resultsStructure as $myKey=>$myVal) {
                //     $resultsString.="<tr><th>".$myKey[0]."</th><th>".$myKey[1]."</th><th>".$myKey[2]."</th><th>".$myKey[3]."</th></tr>";
                // } `Draw_Date`, `Draw_Type`, `Balls_Planned`
                $resultsString.="<tr><th>Draw_Date</th><th>Draw_Type</th><th>Balls_Planned</th></tr>";        
                foreach ($resultsStructure as $myKey=>$myVal){
                    $resultsString.="<tr><td>".$myVal["practicenumber"]."</td><td>".$myVal["name"]."</td><td>".$myVal["specialty"]."</td><td>".$myVal["fee"]."</td></tr>";
                }
                $resultsString.="</table>";
            }
            else {
                $resultsString.="0 results";
            }
        }

        protected function Results2JSon($dbQueryResult) { # Make FieldNames & Values Dynamic  
            $resultsString="";            
            if ($this->queryResult->num_rows > 0) {
                $resultsStructure=$this->queryResult->fetchAll();
                $resultsString="<table>";
                // foreach ($resultsStructure as $myKey=>$myVal) {
                //     $resultsString.="<tr><th>".$myKey[0]."</th><th>".$myKey[1]."</th><th>".$myKey[2]."</th><th>".$myKey[3]."</th></tr>";
                // } `Draw_Date`, `Draw_Type`, `Balls_Planned`
                $resultsString.="<tr><th>Draw_Date</th><th>Draw_Type</th><th>Balls_Planned</th></tr>";        
                foreach ($resultsStructure as $myKey=>$myVal){
                    $resultsString.="<tr><td>".$myVal["practicenumber"]."</td><td>".$myVal["name"]."</td><td>".$myVal["specialty"]."</td><td>".$myVal["fee"]."</td></tr>";
                }
                $resultsString.="</table>";
            }
            else {
                $resultsString.="0 results";
            }
        }

        protected function Results2Xml($dbQueryResult) { # Make FieldNames & Values Dynamic  
            $resultsString="";            
            if ($this->queryResult->num_rows > 0) {
                $resultsStructure=$this->queryResult->fetchAll();
                $resultsString="<table>";
                // foreach ($resultsStructure as $myKey=>$myVal) {
                //     $resultsString.="<tr><th>".$myKey[0]."</th><th>".$myKey[1]."</th><th>".$myKey[2]."</th><th>".$myKey[3]."</th></tr>";
                // } `Draw_Date`, `Draw_Type`, `Balls_Planned`
                $resultsString.="<tr><th>Draw_Date</th><th>Draw_Type</th><th>Balls_Planned</th></tr>";        
                foreach ($resultsStructure as $myKey=>$myVal){
                    $resultsString.="<tr><td>".$myVal["practicenumber"]."</td><td>".$myVal["name"]."</td><td>".$myVal["specialty"]."</td><td>".$myVal["fee"]."</td></tr>";
                }
                $resultsString.="</table>";
            }
            else {
                $resultsString.="0 results";
            }
        }

        protected function Results2Other($dbQueryResult) { # Make FieldNames & Values Dynamic  
            $resultsString="";            
            if ($this->queryResult->num_rows > 0) {
                $resultsStructure=$this->queryResult->fetchAll();
                $resultsString="<table>";
                // foreach ($resultsStructure as $myKey=>$myVal) {
                //     $resultsString.="<tr><th>".$myKey[0]."</th><th>".$myKey[1]."</th><th>".$myKey[2]."</th><th>".$myKey[3]."</th></tr>";
                // } `Draw_Date`, `Draw_Type`, `Balls_Planned`
                $resultsString.="<tr><th>Draw_Date</th><th>Draw_Type</th><th>Balls_Planned</th></tr>";        
                foreach ($resultsStructure as $myKey=>$myVal){
                    $resultsString.="<tr><td>".$myVal["practicenumber"]."</td><td>".$myVal["name"]."</td><td>".$myVal["specialty"]."</td><td>".$myVal["fee"]."</td></tr>";
                }
                $resultsString.="</table>";
            }
            else {
                $resultsString.="0 results";
            }
        }

        protected function Results2Error($dbQueryResult) { # Make FieldNames & Values Dynamic  
            $resultsString="";            
            if ($this->queryResult->num_rows > 0) {
                $resultsStructure=$this->queryResult->fetchAll();
                $resultsString="<table>";
                // foreach ($resultsStructure as $myKey=>$myVal) {
                //     $resultsString.="<tr><th>".$myKey[0]."</th><th>".$myKey[1]."</th><th>".$myKey[2]."</th><th>".$myKey[3]."</th></tr>";
                // } `Draw_Date`, `Draw_Type`, `Balls_Planned`
                $resultsString.="<tr><th>Draw_Date</th><th>Draw_Type</th><th>Balls_Planned</th></tr>";        
                foreach ($resultsStructure as $myKey=>$myVal){
                    $resultsString.="<tr><td>".$myVal["practicenumber"]."</td><td>".$myVal["name"]."</td><td>".$myVal["specialty"]."</td><td>".$myVal["fee"]."</td></tr>";
                }
                $resultsString.="</table>";
            }
            else {
                $resultsString.="0 results";
            }
        }
    }
?>

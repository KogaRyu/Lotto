<?php
    // include_once('Lotto_PHP_DB_Config.php');
    include_once("Lotto_PHP_Class_DB_Active.php");
    include_once("Lotto_PHP_Class_DB_ShortCut.php");    
    include_once("Lotto_PHP_Class_DB_Output.php");
    function POutput() {
        echo "Hello PHP.<br>";
        #$myActive=New DB_Active();
        echo "Bye PHP.\n";
    }  
    
    function POutputClass() {
        echo "Hello PHP Class Creation.<br>";
        $myDB_Class= New DB_Active();
        echo "Hello PHP Class Output.<br>";
        echo $myDB_Class->getOutput;        
        #$myActive=New DB_Active();
        echo "Bye PHP Class E.\n";
    } 
   
    function POutputShort() {
        echo "<br> Hello PHP Ext PDO Creation.<br>";
        $extPDO = New EXT_PDO();
        echo "Hello PHP Ext PDO Query.<br>";
        $results = $extPDO->run('Select * From tbl_lottery_Draws')->fetchAll();
        echo "Hello PHP Ext PDO Output.<br>";
        $output = New DB_Output($results);
        #$queryOutputout = $results->fetchAll();
        echo $output->getOutput().".<br>";
        #$output = $extPDO->fetch();      
        #$myActive=New DB_Active();
        echo "Bye PHP Ext PDO.<br>";
    }

    POutputShort();

/*  // Helper Functions
    function withinRange($inputVal, $minVal=1,$maxVal=49) {
        if($inputVal>=$minVal && $inputVal<=$maxVal) {
            return inputVal;
        }
        else {
            $value=NULL;
            exit();
        }
    }

    function cleanHtmlInput($value) {
        if( isset($value) ) {
            $value=trim($value);
            if( $value!="" && $value!="none" ) {
                $value=stripslashes($value);
                $value=htmlspecialchars($value);
            }
            else {
                exit();
            }
        }
        else {
            $value=NULL;
            exit();
            }          
        return $value;
    }

    function validateInput($drawDate,$drawType,$userName,$myNumbers) {

        $inputSettings = array('drawDate'=>$drawDate,'drawType'=>$drawType,'userName'=>$userName);
        $drawDate=makeAssocInput('drawDate');            
        $drawType= makeAssocInput('drawType');
        $userName= makeAssocInput('userName');

        $myNumbersKeys= array('ball_1','ball_2','ball_3','ball_4','ball_5','ball_6');
        $myNumbers=makeAssocInput($myNumbersKeys);

        foreach ($myNumbersKeys as $key => $value) {
            $myNumbers=cleanHtmlInput($myNumbersKeys);
        }

        $listInputs=Array('settingsInput'=>$inputSettings,'myNumbersInputs'=>$myNumbers);
    }

    function DB_Update(){
        $BD_Con = DB_Connect('dblotto');
        $mytableName="tblnumbersplanned";
        $myNumbers = [];
        if(isset($_POST['ball_1']) && isset($_POST['ball_2']) && isset($_POST['ball_3']) && isset($_POST['ball_4']) && isset($_POST['ball_5']) && isset($_POST['ball_6'])) {
            if($_POST['ball_1'] != "none" && $_POST['ball_2'] != "none" && $_POST['ball_3'] != "none" && $_POST['ball_4'] != "none" && $_POST['ball_5'] != "none"&& $_POST['ball_6'] != "none") {
                $myNumbers[1] = $_POST['ball_1'];
                $myNumbers[2] = $_POST['ball_2'];
                $myNumbers[3] = $_POST['ball_3'];
                $myNumbers[4] = $_POST['ball_4'];
                $myNumbers[5] = $_POST['ball_5'];
                $myNumbers[6] = $_POST['ball_6'];
            }
            if ($_POST['doctorsFilter'] == "all") {
                $mySql = 'INSERT INTO books VALUES (null,"Jack Herrington","Code Generation in Action");';
                $myResult = myDisplayAll($BD_Con,$mySql);
            }
            elseif ($_POST['doctorsFilter'] == "charge"){
                $myfee = $_POST['fee'];
                if(!empty($myfee)) {
                    $sqlInsertBall = "INSERT INTO $mytableName (`ID`,`Draw_Date`, `Draw_Type`, `Balls_Planned`, `ID_User`) VALUES (Null, $_POST['drawDate'], $_POST['drawType'], $myNumbers[$i], $_POST['userName']) WHERE fee < :fee;";                    
                    $myResult = $DB_Connection->prepare($sqlInsertBall);
                    $myResult->bindParam(':fee',$myfee);
                    $myResult->execute();
                    $myResult = myDisplaySome($BD_Con,$sqlInsertBall,$myfee);
                }
                else{
                    echo "<h1> Choose to Return All or Below the fee!</h1>";
                }
            }
        }
    }

    function makeAssocInput($keyAssocs, $postMethod='POST') {            
        $holder=array();
        if ($postMethod == 'POST') {
            foreach ($keyAssocs as $keyAssoc) {
                $assocVal=cleanHtmlInput($_POST[$keyAssoc]);
                array_push($holder,array($keyAssoc=>$assocVal));                    
            }                
        }
        else {
            foreach ($keyAssocs as $keyAssoc) {
                $assocVal=cleanHtmlInput($_GET[$keyAssoc]);
                array_push($holder,array($keyAssoc=>$assocVal));                    
            }
        } 
        return $holder;                       
    }
*/

?>
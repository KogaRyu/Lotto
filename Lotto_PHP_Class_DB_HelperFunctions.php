<?php
    // include_once('Lotto_PHP_DB_Config.php');
    include_once("Lotto_PHP_Class_DB_Active.php");
    include_once("Lotto_PHP_Class_DB_ShortCut.php");    
    include_once("Lotto_PHP_Class_DB_Output.php");


    // Helper Functions
    function withinRange($inputVal, $minVal=1,$maxVal=49) {
        if($inputVal>=$minVal && $inputVal<=$maxVal) {
            return $inputVal;
        }
        else {
            $value=NULL;
            exit();
        }
    }

    function cleanHtmlInput($value) {
        if(isset($value) && !empty($value) && $value!='' && strtolower($value)!='none') {
            $value  = filter_var($value, FILTER_SANITIZE_STRING); 
            $value  = trim($value);       
            $value  = htmlspecialchars($value);
            $value  = htmlentities($value);            
            $value  = stripslashes($value);
            $value  = strip_tags($value);
        }
        else {
            $value  = NULL;
        }
        return $value;
    }
    function cleanHtmlInputArray($assocArray2Clean) {
        $cleanAssocArray = [];
        
        foreach($assocArray2Clean as $arraKeys => $arrayValues) {
            $cleanAssocArray[$arraKeys] = cleanHtmlInput($arrayValues);
        }        
        return $cleanAssocArray;
    }

    function validateInput($drawDate,$drawType,$userName,$myNumbers) {
        // function validateInput($myDrawDetails,$myBallzNumbers) {
        $mySettingsInputs = array(  // Draw details
                                    'drawDate'=>$drawDate,
                                    'drawType'=>$drawType,
                                    'userName'=>$userName
                                );
        $mySettingsInputsArray=makeAssocInput($mySettingsInputs);

        $myNumbersKeys= array(  // Balls List
                                'ball_1' => $myNumbers['ball_1'],
                                'ball_2' => $myNumbers['ball_2'],
                                'ball_3' => $myNumbers['ball_3'],
                                'ball_4' => $myNumbers['ball_4'],
                                'ball_5' => $myNumbers['ball_5'],
                                'ball_6' => $myNumbers['ball_6']
                            );
        $myNumbersArray=makeAssocInput($myNumbersKeys);

        $listInputs=Array('settingsInput'=>$mySettingsInputsArray,'myNumbersInput'=>$myNumbersArray);
    }

    function makeAssocInput($keyAssocs, $postMethod='POST') {            
        $holder=array();
        if ($postMethod == 'POST') {
            foreach ($keyAssocs as $keyAssoc) {
                $assocVal = cleanHtmlInput($_POST[$keyAssoc]);
                array_push($holder,array($keyAssoc=>$assocVal));                    
            }                
        }
        else if ($postMethod == 'GET') {
            foreach ($keyAssocs as $keyAssoc) {
                $assocVal = cleanHtmlInput($_GET[$keyAssoc]);
                array_push($holder,array($keyAssoc=>$assocVal));                    
            }
        }
        else if($postMethod == 'REQUEST'){
            foreach ($keyAssocs as $keyAssoc) {
                $assocVal=cleanHtmlInput($_GET[$keyAssoc]);
                array_push($holder,array($keyAssoc=>$assocVal));                    
            }
        }
        else {
            echo "Put, Delete etc are not yet implemented";
        }
        return $holder;                       
    }
/* 
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
 */

?>
function submitRequest2Server1() {
    let elementIdNameList = ['combo_this','combo_specific','combo_history',
                            'combo_each_Number','combo_Least_Recurring_Number','combo_Most_Recurring_Number',
                            'combo_Never_Played_Combination','combo_Least_Played_Combination','combo_Most_Played_Combination'];    
    let queryString2Server = 'Query:Select';
    let sendMethod = 'POST';
    let serverFileURL = 'Lotto_PHP_Class_DB_Talk2World.php';
    let asyncSync = true;
    let contentType = 'application/x-www-form-urlencoded';
    let userName = '';
    let passWord = '';

    //let callbackFunction=updateInnerElement;    
    let XHR=XHR_Connection();    

    sendXHR2Server(XHR,updateInnerElement,elementIdNameList,queryString2Server,sendMethod,serverFileURL,asyncSync,contentType,userName,passWord);
}

function submitRequest2Server(queryString2Server = 'Submit') {
    let elementIdNameList = ['combo_this', 'combo_specific', 'combo_history',
                             'combo_each_Number', 'combo_Least_Recurring_Number', 'combo_Most_Recurring_Number',
                             'combo_Never_Played_Combination', 'combo_Least_Played_Combination', 'combo_Most_Played_Combination'
                            ];    
    
    let sendMethod = 'POST';
    let serverFileURL = 'Lotto_PHP_Class_DB_Talk2World.php';
    let asyncSync = true;
    let contentType = 'application/x-www-form-urlencoded';
    let userName = '';
    let passWord = '';

    //let callbackFunction=updateInnerElement;    
    let XHR = XHR_Connection();
    try {
        queryString2Server = checkTargetSender(any);
        sendXHR2Server(XHR, updateInnerElement, elementIdNameList, queryString2Server, sendMethod, serverFileURL, asyncSync, contentType, userName, passWord);
    }
    catch (err) {
        alert(err);
        sendXHR2Server(XHR, updateInnerElement, elementIdNameList, queryString2Server, sendMethod, serverFileURL, asyncSync, contentType, userName, passWord);
    }
}
// ********************************************

function checkTargetSender(eventTarget) {
    let senderTarget = eventTarget.target;
    let senderTargetTagName = "";    
    let senderTargetName = "";
    let senderTargetId = eventTarget.target.getAttribute("id");
    
    switch (senderTargetId) {
        case "twitter_user_name":
            // User Name
            senderTargetName = senderTargetId;
            break;
        case "draw_type":
            // Draw Type
            senderTargetName = senderTargetId;
            break;
        case "check_WeekDay":
            // Week Day
            senderTargetName = senderTargetId;
            break;
        case "check_BallSignature":
            // Balls Signature
            senderTargetName = senderTargetId;   
            break;
        default: // Main SubmitButton
            // Main Submit Button
            senderTargetName = "Submit";
            break;
    }
    return senderTargetName;
}
// ********************************************

function XHR_Connection() {
    let XHR_Object=null;
    if (window.XMLHttpRequest) { // code for IE7+, Opera 8.0+, Firefox, Chrome, Safari.
        try {
            XHR_Object=new XMLHttpRequest();        
        }
        catch (e)  {
            alert("Could not create New Connection Object")
        }
    }
    else if (window.ActiveXObject){ // Internet Explorer Browsers
        try {   // Msxml2.XHR: code for IE6, IE
            XHR_Object=new ActiveXObject('Msxml2.XHR');
        }
        catch (e)  {   // Even Older IE
            try {   // Microsoft.XHR: code for IE6, IE5
                XHR_Object=new ActiveXObject('Microsoft.XHR');
            }
            catch (e) {    // Browser atttempts failed
                XHR_Object=false;
                alert("Could not create Both of Old Connection Objects")
            }
        }    
    }
    else{ //  No known Connection Object Type
        alert("Unknown Connection Object Type")
    }
    return XHR_Object;
}
// ********************************************

function sendXHR2Server(XHR,callbackFunction,elementIdName,queryString2Server,sendMethod,serverFileURL,asyncSync,contentType,userName,passWord) {
    if (sendMethod=='POST') {
        XHR.onreadystatechange=function(){
            if (XHR.readyState == 4) { // Received Ok
                if(XHR.status == 200) { // Status 200
                    // The below could be any other function
                    alert("Connected" + "<br>"+ " - Ready State: " + XHR.readyState +  "<br>"+ " - Status: " + XHR.status+  "<br>"+ " - Status Text: " + XHR.statusText); 
                    callbackFunction(XHR,elementIdName);
                    
                }
                else{   // Status other
                    // The below could be any other function
                    alert("Not Connect" + "<br>"+ " - Ready State: " + XHR.readyState +  "<br>"+ " - Status: " + XHR.status+  "<br>"+ " - Status Text: " + XHR.statusText);                  
                    callbackFunction(XHR,elementIdName);
                }
            }   
        };
        XHR.open(sendMethod,serverFileURL,asyncSync);
        XHR.setRequestHeader("Content-type",contentType);
        XHR.send(queryString2Server)
    }
    else if (sendMethod=='REQUEST') {
        XHR.onreadystatechange=function(){
            if (XHR.readyState == 4) { // Received Ok
                if(XHR.status == 200) { // Status 200
                    // The below could be any other function
                    alert("Connected" + "<br>"+ " - Ready State: " + XHR.readyState +  "<br>"+ " - Status: " + XHR.status+  "<br>"+ " - Status Text: " + XHR.statusText); 
                    callbackFunction(XHR,elementIdName);
                    
                }
                else{   // Status other
                    // The below could be any other function
                    alert("Not Connect" + "<br>"+ " - Ready State: " + XHR.readyState +  "<br>"+ " - Status: " + XHR.status+  "<br>"+ " - Status Text: " + XHR.statusText);                  
                    callbackFunction(XHR,elementIdName);
                }
            }   
        };
        XHR.open(sendMethod,serverFileURL,asyncSync);
        XHR.setRequestHeader("Content-type",contentType);
        XHR.send(queryString2Server)
    }
    else if (sendMethod=='GET') {
        XHR.onreadystatechange=function(){
            if (XHR.readyState == 4) { // Received Ok
                if(XHR.status == 200) { // Status 200
                    // The below could be any other function
                    alert("Connected" + "<br>"+ " - Ready State: " + XHR.readyState +  "<br>"+ " - Status: " + XHR.status+  "<br>"+ " - Status Text: " + XHR.statusText); 
                    callbackFunction(XHR,elementIdName);
                }
                else{   // Status other
                    // The below could be any other function
                    alert("Not Connect" + "<br>"+ " - Ready State: " + XHR.readyState +  "<br>"+ " - Status: " + XHR.status+  "<br>"+ " - Status Text: " + XHR.statusText);                  
                    callbackFunction(XHR,elementIdName);
                }
            }   
        }
        XHR.open(sendMethod,serverFileURL+queryString2Server,asyncSync);
        XHR.send();
    }
    else {  //   "Unknown or Undefined method of sending"
        alert("Unknown method of sending");      
    }
}

function sendXHR2Server2(XHR,callbackFunction,elementIdName,queryString2Server,sendMethod,serverFileURL,asyncSync,contentType,userName,passWord) { 
    if (sendMethod=='GET') {
        XHR.onreadystatechange=processStatusChange(callbackFunction,XHR,elementIdName);  //  Update the Inner Element
        XHR.open(sendMethod,serverFileURL+queryString2Server,asyncSync);
        XHR.send();
    }
    else if (sendMethod=='POST') {
        XHR.onreadystatechange=processStatusChange(callbackFunction,XHR,elementIdName);  //  Update the Inner Element
        XHR.open(sendMethod,serverFileURL,asyncSync);
        XHR.setRequestHeader("Content-type",contentType);
        XHR.send(queryString2Server)
    }
    else {  //   "Unknown or Undefined method of sending"
        alert("Unknown method of sending");      
    }
}
// ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

function processStatusChange(callbackFunction,XHR,elementIdName) {
    if (XHR.readyState == 4) { // Received Ok
        if(XHR.status == 200) { // Status 200
            // The below could be any other function
            alert("Connected" + "<br>"+ " - Ready State: " + XHR.readyState +  "<br>"+ " - Status: " + XHR.status+  "<br>"+ " - Status Text: " + XHR.statusText); 
            callbackFunction(XHR,elementIdName);
            
        }
        else{   // Status other
            // The below could be any other function
            alert("Not Connect" + "<br>"+ " - Ready State: " + XHR.readyState +  "<br>"+ " - Status: " + XHR.status+  "<br>"+ " - Status Text: " + XHR.statusText);                  
            callbackFunction(XHR,elementIdName);
        }
    }      
}
// ********************************************

function updateInnerElement(XHR,elementIdNameList){
    let displayElementList = [];
    elementIdNameList.forEach(
        function(elementIdName){        
            let displayElement = document.getElementById(elementIdName);
            displayElement.innerHTML = getDisplayText(XHR);
            displayElementList.push(displayElement);
        }
    );
}

function updateInnerElement2(XHR,elementIdNameList){
    counter = 0;
    let displayElementList = [];
    elementIdNameList.forEach(
        function(elementIdName){
            displayElementList[counter] = document.getElementById(elementIdName);    
            displayElementList[counter].innerHTML = getDisplayText(XHR); 
            counter++;
        }
    );
}
// ********************************************

function getDisplayText(XHR){
    let textHolder =    "<p>Status: "+"<br>"+
                        "- Ready State: "+XHR.readyState+"<br>"+
                        "- Status: "+XHR.status+"<br>"+
                        "- Status Text: "+XHR.statusText+"<br>"+
                        "<br>"+
                        "Response Text: "+XHR.responseText+"<br>"+
                        "</p>";
    return textHolder;
}
// ********************************************

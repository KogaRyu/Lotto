// ********************************************
// ********************************************

function submitRequest2Server(queryString2Server = '') {
    let settingsSend2Server         = fnSettingsSend2Server();
    let XHR                         = XHR_Connection();
    try {
        let senderFeedback          = checkTargetExpectedSender(event);
        let senderIsExpectedSender  = senderFeedback[0];
        let expectedSenderName      = senderFeedback[1];

        if (senderIsExpectedSender) {
            if (expectedSenderName == "lotto_ball_x") {
                orderDigits(ball_sign,ballz);
            } else {
                queryString2Server  = "Request Sender"+"="+expectedSenderName +"&"+ makeServerStringData(serverString2Object);
                //orderDigits(ball_sign,ballz);
                sendXHR2Server(XHR, updateInnerElement, settingsSend2Server.elementIdNameList, queryString2Server, settingsSend2Server.sendMethod, settingsSend2Server.serverFileURL, settingsSend2Server.asyncSync, settingsSend2Server.contentType, settingsSend2Server.userName, settingsSend2Server.passWord);
            }
        } else {
            alert("Unknown Sender: "+ expectedSenderName);
        }
        
    }
    catch (err) {
        alert(err);
        sendXHR2Server(XHR, updateInnerElement, settingsSend2Server.elementIdNameList, queryString2Server, settingsSend2Server.sendMethod, settingsSend2Server.serverFileURL, settingsSend2Server.asyncSync, settingsSend2Server.contentType, settingsSend2Server.userName, settingsSend2Server.passWord);
    }
}
// ********************************************

function makeServerStringData(serverString2Object, dataSeperator = "&"){    // dataSeperator = "&" OR "\r\n"
    let serverString2Query  = "";
    let serverString2Keys   = Object.keys(serverString2Object);
    
    for (let dataElementName of serverString2Keys) {
        serverString2Query += serverString2Query=="" ? serverString2Object[dataElementName].id+"="+serverString2Object[dataElementName].value : dataSeperator+serverString2Object[dataElementName].id+"="+serverString2Object[dataElementName].value;
    }
    return serverString2Query;
}
// ********************************************

function checkTargetExpectedSender(event) {
    let senderTarget                = event.target;
    let senderExpectedSender        = false;    
    let senderTargetName            = "";
    let senderTargetId              = event.target.getAttribute("id");
    
    switch (senderTargetId) {
        case "lotto_twitter_user_name":
            // User Name
            senderTargetName        = senderTargetId;
            senderExpectedSender    = true;
            break;
        case "lotto_draw_type":
            // Draw Type
            senderTargetName        = senderTargetId;
            senderExpectedSender    = true;
            break;
        case "lotto_draw_date":
            // Draw Date
            senderTargetName        = senderTargetId;
            senderExpectedSender    = true;
            break;
        case "lotto_balls_signature":
            // Balls Signature
            senderTargetName        = senderTargetId; 
            senderExpectedSender    = true;  
            break;
        case "lotto_submit_entry":
            // Submit
            senderTargetName        = senderTargetId; 
            senderExpectedSender    = true;  
        case "lotto_submit":
            // Submit
            senderTargetName        = senderTargetId;
            senderExpectedSender    = true;   
            break;
        default:            
            let checkBalls          = senderTargetId.search(/b[lotto_ball_][/d]{1}/i);
            if (checkBalls){                
                senderTargetName    = "lotto_ball_x";
                senderExpectedSender= true;
            }
            break;
    }
    return [senderExpectedSender, senderTargetName];
}
// ********************************************

function XHR_Connection() {
    let XHR_Object          = null;
    if (window.XMLHttpRequest) { // code for IE7+, Opera 8.0+, Firefox, Chrome, Safari.
        try {
            XHR_Object      = new XMLHttpRequest();        
        }
        catch (e)  {
            alert("Could not create New Connection Object")
        }
    }
    else if (window.ActiveXObject){ // Internet Explorer Browsers
        try {   // Msxml2.XHR: code for IE6, IE
            XHR_Object      = new ActiveXObject('Msxml2.XHR');
        }
        catch (e)  {   // Even Older IE
            try {   // Microsoft.XHR: code for IE6, IE5
                XHR_Object  = new ActiveXObject('Microsoft.XHR');
            }
            catch (e) {    // Browser atttempts failed
                XHR_Object  = false;
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
        XHR.onreadystatechange  = function(){
            processStatusChange(callbackFunction,XHR,elementIdName);  
        };
        XHR.open(sendMethod,serverFileURL,asyncSync);
        XHR.setRequestHeader("Content-type",contentType);
        XHR.send(queryString2Server);
    }
    else if (sendMethod=='REQUEST') {
        XHR.onreadystatechange  = function(){
            processStatusChange(callbackFunction,XHR,elementIdName);  
        };
        XHR.open(sendMethod,serverFileURL,asyncSync);
        XHR.setRequestHeader("Content-type",contentType);
        XHR.send(queryString2Server);
    }
    else if (sendMethod=='GET') {
        XHR.onreadystatechange  = function(){
            processStatusChange(callbackFunction,XHR,elementIdName);  
        };
        XHR.open(sendMethod,serverFileURL+queryString2Server,asyncSync);
        XHR.send();
    }
    else {  //   "Unknown or Undefined method of sending"
        alert("Unknown method of sending");      
    }
}
// ********************************************

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
    let displayElementList                          = {};
    for(elementIdName of elementIdNameList){    
        let displayElement                          = document.getElementById(elementIdName);
        displayElementList[elementIdName]           = displayElement;
        
        // Extract the relevant Data and put in displayElement.innerHTML
        // displayElement[AppicableElement].innerHTML = relevantResponseText["AppicableElement"]
        let relevantResponseText                    = getDisplayText(XHR);
        displayElementList[elementIdName].innerHTML = relevantResponseText; // relevantResponseText["elementIdName"]
        
    }
}
// ********************************************

function getDisplayText(XHR){
    let textHolder =    "<p>Status: "+"<br>"+
                        "- Ready State: "+XHR.readyState+"<br>"+
                        "- Status: "+XHR.status+"<br>"+
                        "- Status Text: "+XHR.statusText+"<br>"+
                        "<br>"+
                        "Response Text: "+"<br>"+
                        "- " + XHR.responseText+"<br>"+
                        "</p>";
    return textHolder;
}
// ********************************************
// ********************************************
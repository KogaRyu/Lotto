// submitRequest2Server(function2Excecute,elementIdName,XHR,queryString2Server, sendMethod ="GET", serverFileURL="getuser.php?q=",asyncSync=true,contentType="application/x-www-form-urlencoded",userName='',passWord='')
// submitRequest2Server(updateInnerElement,'combo_this',XHR,'Select', 'GET', 'getuser.php?q=',true,'application/x-www-form-urlencoded','UserName','Secret')
// var XHR=null;
// XHR = XHR_Connection();

function submitForm() { 
    var xhr; 
    try {
        xhr = new ActiveXObject('Msxml2.XHR');
    }
    catch (e) {
        try {
            xhr = new ActiveXObject('Microsoft.XHR');
        }
        catch (e2) {
          try {
              xhr = new XHRRequest();
            }
          catch (e3) {
              xhr = false;
            }
        }
    }
   
    xhr.onreadystatechange  = function() { 
         if(xhr.readyState  == 4) {
            var combo_this = document.getElementById("combo_this").firstChild();
            if(xhr.status  == 200) {
                combo_this.innerHTML="Received:"  + xhr.responseText;
            }                 
            else {
                combo_this.innerHTML="Error code " + xhr.status;
            }                
        }
    }; 
 
   xhr.open("GET", "Lotto_PHP.php",  true); 
   xhr.send(null); 
} 
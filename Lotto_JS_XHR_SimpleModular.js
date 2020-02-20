// submitRequest2Server(function2Excecute,elementIdName,XHR,queryString2Server, sendMethod ="GET", serverFileURL="getuser.php?q=",asyncSync=true,contentType="application/x-www-form-urlencoded",userName='',passWord='')
// submitRequest2Server(updateInnerElement,'combo_this',XHR,'Select', 'GET', 'getuser.php?q=',true,'application/x-www-form-urlencoded','UserName','Secret')
// let XHR=null;
// XHR = XHR_Connection();

function submitForm() {
    let url='Lotto_PHP_Class_DB_Talk2World.php';
    let xhr=null; 
    try {
        xhr = new XMLHttpRequest();
    }
    catch (e) {
        try {
            xhr = new ActiveXObject('Microsoft.XHR');
        }
        catch (e2) {
          try {
              xhr = new ActiveXObject('Msxml2.XHR');
            }
          catch (e3) {
              xhr = false;
            }
        }
    }
   
    xhr.onreadystatechange  = function() { 
         if(xhr.readyState  == 4) {
            let myDocComboThis = document.getElementById("combo_this");
            if(this.status  == 200) {
                myDocComboThis.innerHTML="Received:"  + this.responseText;
            }                 
            else {
                myDocComboThis.innerHTML="Error code " + this.status;
            }                
        }
    }; 
 
   xhr.open("POST", url, true);
   xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
   xhr.send(); 
} 
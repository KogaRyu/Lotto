function DB_Test() {
    let url='Lotto_PHP_Class_DB_Talk2World.php';
    let XHR_Object=new XMLHttpRequest();
    XHR_Object.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
            
            // Responses
            let myRespComboThis=this.responseText;
            let myRespComboSpecific=this.responseText;
            let myRespComboEachNumber=this.responseText;

            // Output Places
            let myDocComboThis=document.getElementById("combo_this");
            let myDocComboSpecific=document.getElementById("combo_specific");
            let myDocComboEachNumber=document.getElementById("combo_each_Number");

            //Response to Outputs            
            myDocComboThis.innerHTML=myRespComboThis;
            myDocComboSpecific.innerHTML=myRespComboSpecific;
            myDocComboEachNumber.innerHTML=myRespComboEachNumber;
        }
    };
    // XHR_Object.open("GET", url, true);
    XHR_Object.open("POST", url, true);
    XHR_Object.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    XHR_Object.send();
}
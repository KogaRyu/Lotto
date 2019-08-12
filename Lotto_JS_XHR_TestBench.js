function DB_Test() {
    let url='Lotto_PHP_Class_DB_Talk2World.php';
    let XHR_Object=new XMLHttpRequest();
    XHR_Object.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
            let myDoc=document.getElementById("combo_this");
            let myResp=this.responseText;
            myDoc.innerHTML=myResp;
        }
    };
    // XHR_Object.open("GET", url, true);
    XHR_Object.open("POST", url, true);
    XHR_Object.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    XHR_Object.send();
}
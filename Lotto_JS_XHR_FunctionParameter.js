function DB_Pull(url, cFunction) {
    var xhttp;
    xhttp=new XHRRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            cFunction(this);
        }
    };
    xhttp.open("GET", url, true);
    xhttp.send();
}
function myFunction(xhttp) {
    document.getElementById("combo_this").innerHTML = xhttp.responseText;
}
// ***************************************************************
function DB_Add(url, cFunction) {
    var xhttp;
    xhttp=new XHRRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            cFunction(this);
        }
    };
    xhttp.open("GET", url, true);
    xhttp.send();
}
function myFunction(xhttp) {
    document.getElementById("combo_this").innerHTML = xhttp.responseText;
}
var requestObj = null;
var respuesta = null;

function iniciarXMLR(url, data, fn) {
    requestObj = new XMLHttpRequest();

    requestObj.open("POST", url, true);
    requestObj.onreadystatechange = function () {
        if (requestObj.status == 200 && requestObj.readyState == 4) {
            if (fn != null) {
                respuesta = JSON.parse(requestObj.responseText);
                fn(respuesta);
            }
        }
    };
    requestObj.send(data);
}

function funcManejadora() {
    if (requestObj.status == 200) {
        if (requestObj.readyState == 4) {
            respuesta = JSON.parse(requestObj.responseText);
        }
    }
}

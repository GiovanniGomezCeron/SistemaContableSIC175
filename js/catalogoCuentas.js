window.addEventListener("load", cargar);

var item;
var modify = null;
var detalle = null;
var eliminar = null;
var cuentaSeleccionada = null;
var codigoModified = null;
var operacion = "";

function cargar() {
    var collectionCuentas = document.querySelectorAll(".btnMostrarCuenta");
    var collectionCuentasAll = document.querySelectorAll("tr");

    initNotification();

    var btnNCuenta = document.querySelector(".btnSubmit");
    btnNCuenta.addEventListener("click", desplegarFormCuentasT);

    document.querySelector(".closeDetalleCuenta").addEventListener("click",ocultarDetalleCuentas);

    for (var i = 0; i < collectionCuentas.length; i++) {
        collectionCuentas[i].addEventListener("click", showHideCuenta);
    }

    var actual = null;
    for (var i = 0; i < collectionCuentasAll.length; i++) {
        actual = collectionCuentasAll[i];
        if (!actual.classList.contains("listaMayor") && !actual.classList.contains("rubrosCuenta")) {
            collectionCuentasAll[i].addEventListener("click", activeDetailsCuentas);
        }
    }

    modify = document.querySelector("#btnModificarCuenta");
    modify.addEventListener("click", modificarCuenta);

    detalle = document.querySelector("#btnDetalleCuenta");
    detalle.addEventListener("click", detalleCuenta);

    eliminar = document.querySelector("#btnEliminarCuenta");
    eliminar.addEventListener("click", eliminarCuenta);
}


function showHideCuenta() {
    var item = this.parentNode.parentNode;
    var itemAct = item;
    var codigo = item.cells[0].innerText;
    var codigoAct = codigo;
    var pDisplay = "none";
    var pPropiedad = "visibility_on";

    var text = this.innerText.toLowerCase();

    if (text.startsWith("v")) {
        if (text === "visibility_on") {
            pDisplay = "inline-block";
            pPropiedad = "visibility_off";
        }

    } else {
        pPropiedad = "expand_more";
        if (text === "expand_more") {
            pDisplay = "inline-block";
            pPropiedad = "expand_less";
        }
    }

    while ((itemAct = itemAct.nextElementSibling) != null && ((itemAct.cells[0].innerText).startsWith(codigo))) {
        itemAct.style = "display:" + pDisplay;
    }
    item.cells[2].children[0].innerText = pPropiedad;
}

function activeDetailsCuentas() {
    modify.classList.remove("disabled");
    detalle.classList.remove("disabled");
    eliminar.classList.remove("disabled");
    if(cuentaSeleccionada!=null){
        cuentaSeleccionada.cells[4].children[0].classList.add("hide");
    }
    cuentaSeleccionada = this;

   
    this.cells[4].children[0].classList.remove("hide");
}


//PARA MOSTRAR EL DETALLE DE UNA CUENTA EN PARTICULAR
function detalleCuenta() {
    var code = cuentaSeleccionada.cells[0].innerText;
    var url = "?o=" + btoa("request") + "&&a=" + "=" + btoa("detalleCuenta") + "&&codigo=" + btoa(code);

    iniciarXMLR(url, code, seteoDetalleCuenta);

    document.querySelector(".detalleCuenta").classList.remove("hide");

}

//LLENANDO EL FORMULARIO DE DETALLE DE CUENTA CON INFORMACION
function seteoDetalleCuenta(data) {
    document.querySelector(".codigoValor").innerText = data.codigo;
    document.querySelector(".nombreValor").innerText = data.nombre;
    document.querySelector(".elementoValor").innerText = data.elemento;
    document.querySelector(".rubroValor").innerText = data.rubro;
    document.querySelector(".tipoCuentaValor").innerText = "Cuenta " + data.tipo;
    document.querySelector(".tipoSaldoValor").innerText = "Saldo " + data.tipoSaldo;

}

//PARA MODIFICAR LOS DATOS DE UNA CUENTA EN PARTICULAR
function modificarCuenta() {
    var code = cuentaSeleccionada.cells[0].innerText;
    var url = "?o=" + btoa("request") + "&a=" + btoa("detalleCuenta") + "&codigo=" + btoa(code);
    iniciarXMLR(url, code, setearFormulario);
}

function eliminarCuenta() {

}

//SETEO DE DATOS EN FORMULARIO PARA MODIFICAR
function setearFormulario(data) {
    var codeField = document.querySelector("#codigoCuenta");
    codeField.value = data.codigo;
    document.querySelector("#cuenta").value = data.nombre;
    document.querySelector("#tipoElemento").value = data.ec;
    document.querySelector("#tipoRubro").value = data.rc;
    document.querySelector("#tipoSaldo").value = data.ts;
    document.querySelector("#tipoCuenta").value = data.tc;

    codeField.setAttribute("disabled","true");
    codigoModified = codeField.value;

    document.querySelector("#btnEnviarFormCuenta").value = "Modificar Cuenta";

    operacion = "Modificar";
    desplegarFormCuentasT();
}

function desplegarFormCuentasT() {
    form = document.querySelector("#seccionFormCuenta");
    form.classList.remove("hide");
}

function ocultarDetalleCuentas() {
    this.closest(".detalleCuenta").classList.add("hide");
}

//archivo JS que controla:
//DASHBOARD
//GESTOR DE CUENTAS

var form = null;
var event = null;
var itemActual = null;

window.onload = function () {
    var items = document.querySelectorAll(".itemList");

    if (items.length > 0) {
        for (var i = 0; i < items.length; i++) {
            items[i].addEventListener("click", eventClick);
        }
    }

    initNotification();

    if (typeof cargarLibroDiarioJS == "function") {
        cargarLibroDiarioJS();
    }

    //item de barra lateral para abrir formulario Cuenta
    document.querySelector("#addCuenta").addEventListener("click", desplegarFormCuentas);

    //btn cerrar formulario cuenta 
    var collecBtn = document.querySelectorAll(".btnCerrar");

    for (var j = 0; j < collecBtn.length; j++) {
        collecBtn[j].addEventListener("click", ocultarFormCuentas);
    }



    //btn para documemto de operacion

    var collectionOperacion = document.querySelectorAll(".itemOperacion");
    for (var i = 0; i < collectionOperacion.length; i++) {
        collectionOperacion[i].addEventListener("click", despleagarOperacion);
    }

    itemActual = collectionOperacion[0];

    //evento inicio de ciclo contable
    var btnIniciarCi = document.querySelector(".startCicloCont");


    if (btnIniciarCi != null) {
        btnIniciarCi.addEventListener("click", iniciarCicloCont);
    }



    //btn Enviar Form cuenta
    var btnEnviar = document.querySelector("#btnEnviarFormCuenta");

    if (btnEnviar != null) {
        btnEnviar.addEventListener("click", enviarFormCuenta);
    }



    //funcion para establecer eventos a la barra lateral (li)
    function eventClick() {

        var section = this.querySelector(".subnivel");

        if (section.classList.contains("hide")) {
            section.classList.remove("hide");
        } else {
            section.classList.add("hide");
        }

    }


    function desplegarFormCuentas() {
        form = document.querySelector("#seccionFormCuenta");
        form.classList.remove("hide");
    }

    function despleagarOperacion() {

        var item = document.querySelector("." + itemActual.role);
        itemActual.classList.remove("activated");

        item.classList.add("hide");

        itemActual = this;

        var i = document.querySelector("." + this.role);
        i.classList.remove("hide");

        this.classList.add("activated");
    }

    //funcion para enviar el formulario cuenta
    function enviarFormCuenta(e) {
        e.preventDefault();

        var cuenta = {
            nombre: document.getElementById("cuenta").value,
            codigo: document.getElementById("codigoCuenta").value,
            tipoCuenta: parseInt(document.getElementById("tipoCuenta").value),
            tipoElemento: parseInt(document.getElementById("tipoElemento").value),
            rubro: parseInt(document.getElementById("tipoRubro").value),
            saldo: parseInt(document.getElementById("tipoSaldo").value),
        };

        var url = "?o=" + btoa("request") + "&&a=";
        var mensaje = "Cuenta registrada correctamente";
        var fn = null;

        if (operacion == "Modificar") {
            url += btoa("modificarCuenta");
            mensaje = "Cuenta modificada correctamente";
            fn = cerrarFormCuenta;
            location.href = location.href;

        } else {
            var cuentaPrincipal = buscarCuentaPrincipal(cuenta.codigo);
            cuenta.cuentaPrincipal = cuentaPrincipal;
            restablecerFormulario();
            url += btoa("ingresoCuenta");
        }


        iniciarXMLR(url, JSON.stringify(cuenta), fn);

        showNotify(mensaje, 2);

        document.querySelector("#codigoCuenta").focus();

    }

}

function iniciarCicloCont() {
    var url = "?o=" + btoa("request") + "&a=" + btoa("inicioCicloContable");
    iniciarXMLR(url, null, null);
}

function ocultarFormCuentas() {
    document.querySelector("#seccionFormCuenta").classList.add("hide");
    document.querySelector("#btnEnviarFormCuenta").value = "Agregar Cuenta";
    location.href = location.href;
}

function cerrarFormCuenta(data) {
    ocultarFormCuentas();
}

function buscarCuentaPrincipal(codigo) {
    switch (codigo.length) {

        case 2:
                return codigo.substring(0,1);
                break;
        case 4:
                return codigo.substring(0, 2);
                break;

        case 6:
                return codigo.substring(0, 4);
                break;
        
        case 8:
                return codigo.substring(0,6);
                break;

        case 10:
                return codigo.substring(0,8);
                break;
    }
}

function restablecerFormulario() {
    document.getElementById("cuenta").value = "";
    document.getElementById("codigoCuenta").value = "";
    document.getElementById("tipoCuenta").selectedIndex = 0,
        document.getElementById("tipoElemento").selectedIndex = 0;
    document.getElementById("tipoRubro").selectedIndex = 0;
    document.getElementById("tipoSaldo").selectedIndex = 0;
}

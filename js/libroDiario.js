var vDebe = 0;
var vHaber = 0;
var transaccion = {};
var data = {};
var operacion = "ingresar";
var filaSeleccionada = null;
var debeModificar = 0, haberModificar = 0;
var seccionDebeGlobal = 0, seccionHaberGlobal = 0;
var accionModificar = null;
var archivo = "Registro";

function cargarLibroDiarioJS() {


    var btnAsentar = document.querySelector("#asentar");
    btnAsentar.addEventListener("click", cargarDatosLibroDiario);

    //para btn de seleccionar fecha
    document.querySelector("#seleccionarFecha").addEventListener("click", obtenerFecha);

    //para btn procesar transaccion
    document.querySelector(".btnTransaccion").addEventListener("click", guardarTransaccion);

    transaccion = { cuentas: [] };

    seccionDebeGlobal = document.querySelector("#saldoDebeGlobal");
    seccionHaberGlobal = document.querySelector("#saldoHaberGlobal");

    //eventos de editar partida
    var collEditPart = document.querySelectorAll(".editarPartidas");
    var collElmPart  = document.querySelectorAll(".eliminarPartidaOp");
    var collRestaurar = document.querySelectorAll(".restaurarPartida");


    if (collEditPart.length > 0) {
        
        for (var i = 0; i < collEditPart.length; i++) {
            if (!collEditPart[i].classList.contains("inabilitado")) {
                collEditPart[i].addEventListener("click", mostrarFomularioPartida);
                collElmPart[i].addEventListener("click", eliminarPartida);
            }
        }
              
        for (var j = 0; j < collRestaurar.length; j++) {
           console.log(collRestaurar[j]);
            //if(!collRestaurar[j].classList.contains("inabilitado")){
                collRestaurar[j].addEventListener("click",restaurarPartida);
            //}
        }

        document.querySelector("#btnCerrarFormPartida").addEventListener("click", setearDatosFormularioPartida);

        archivo = "Lista";

        document.querySelector(".btnTransaccion").value = "Modificar Transacción";
    }
}




function cargarDatosLibroDiario(datos) {
    if (Object.prototype.toString.call(datos) == "[object PointerEvent]") {
        data.codigoCuenta = document.querySelector("#cuentasListado").value;
        data.cuenta = document.querySelector("#cuentasListado").selectedOptions[0].label;
        data.monto = parseFloat(document.querySelector("#montoOperar").value);
        data.accion = "cargar";
    } else {
        data = datos;

    }


    obtenerFecha();

    if (document.querySelector(".btnAbonar").checked) {
        data.accion = "abonar";

    }

    setearDatos();

    document.querySelector("#montoOperar").value = "";
    document.querySelector("#cuentasListado").selectedIndex = 0;
    document.querySelector(".fechaTransaccion").value = "";

}

function setearDatos() {

    if (operacion == "ingresar") {

        var table = null;
        if (archivo == "Registro") {
            table = document.querySelector("#tableCuentasLBM");
        } else {
            table = document.querySelector(".edicionPartida");
        }


        var fila = document.createElement("tr");
        fila.classList.add("vanishIn");
        fila.classList.add("magictime");

        if (data.fecha != undefined && data.fecha != "") {
            setearFecha();
        }

        var concepto = document.createElement("td");
        concepto.innerText = data.cuenta;

        var debe = document.createElement("td");
        var haber = document.createElement("td");


        if (data.accion == "cargar") {
            debe.innerText = "$" + data.monto;
            haber.innerText = "";
            vDebe += data.monto;
            transaccion.cuentas.push([data.codigoCuenta, data.monto, 0.00]);

            seccionDebeGlobal.innerText = "$" + vDebe;
        } else {
            haber.innerText = "$" + data.monto;
            debe.innerText = "";
            vHaber += data.monto;
            transaccion.cuentas.push([data.codigoCuenta, 0.00, data.monto]);
            seccionHaberGlobal.innerText = "$" + vHaber;
        }

        if (archivo != "Registro") {
            transaccion.cuentas[transaccion.cuentas.length - 1].push(data.codeDetallePartida);
            data.codeDetallePartida = 0;
        }

        var operaciones = document.createElement("td");

        var imgEditar = document.createElement("img");
        imgEditar.src = "img/editar/editar2.png";
        imgEditar.classList.add("btnOperaciones");

        imgEditar.addEventListener("click", editar);

        var imgEliminar = document.createElement("img");
        imgEliminar.src = "img/editar/delete3.png";
        imgEliminar.classList.add("btnOperaciones");

        imgEliminar.addEventListener("click", eliminarAsiento);

        operaciones.appendChild(imgEditar);
        operaciones.appendChild(imgEliminar);


        var codigo = document.createElement("td");
        //codigo.innerText = document.querySelector("#cuentasListado").value;
        codigo.innerText = data.codigoCuenta;

        fila.appendChild(codigo);
        fila.appendChild(concepto);
        fila.appendChild(debe);
        fila.appendChild(haber);
        fila.appendChild(operaciones);

        table.appendChild(fila);

    } else {
        modificarAsiento();
    }

    balanceoPatida();

}



function guardarTransaccion(e) {

    e.preventDefault();


    transaccion.saldoDebe = vDebe;
    transaccion.saldoHaber = vHaber;

    transaccion.concepto = document.querySelector("#conceptoTransaccion").value;

    transaccion.fecha = data.fecha;

    var opAjax = "ingresoAsiento";
    var fn = completarGuardadoTransaccion;


    if (archivo != "Registro") {
        opAjax = "editarAsiento";
        fn = completarModificacionTransaccion;

        transaccion.partida = data.partida;
    }

    console.log(transaccion);

    var url = "?o=" + btoa("request") + "&a=" + btoa(opAjax);

    if (vDebe == vHaber) {
        this.value = "Guardando Transaccion...";
        iniciarXMLR(url, JSON.stringify(transaccion), fn);
    } else {
        alert("La partida está desbalanceada!");
    }

}

function completarModificacionTransaccion(data) {
    showNotify("Partida Modificada!", 4);

    setearDatosFormularioPartida(null);


}



function completarGuardadoTransaccion(data) {
    showNotify("Partida Guardada!", 4);

    var rPartida = document.querySelector(".partidaTitulo");
    var partidadValue = rPartida.innerText;
    var partida = parseInt(partidadValue.substring(partidadValue.indexOf("#") + 1, partidadValue.length));

    rPartida.innerText = "Partida #" + (partida + 1);
    data.fecha = "";

    document.querySelector("#conceptoTransaccion").value = "";
    document.querySelector(".btnTransaccion").value = "Guardar Transacción";

    seccionDebeGlobal.innerText = "$0.00";
    seccionHaberGlobal.innerText = "$0.00";

    vDebe  = 0;
    vHaber = 0;
   
    transaccion = {cuentas: []};

    resetPartida(null);
}



function obtenerFecha() {

    var inputFecha = document.querySelector("#fechaTransaccion");

    if (inputFecha.getAttribute("disabled") == null && inputFecha.value != "") {

        data.fecha = document.querySelector("#fechaTransaccion").value;

        setearFecha();
    }

}



function setearFecha() {

    document.querySelector("#fechaTransaccion").setAttribute("disabled", "true");
    document.querySelector("#fechaTransaccion").value = "";

    var arreglo = ["Enero", "Febrero", "Marzo", "Abril", "Mayo",
        "Junio", "Julio", "Agosto", "Septiembre", "Octubre",
        "Noviembre", "Diciembre"];

    var mes = parseInt(data.fecha.substring(5, 7)) - 1;
    var anio = data.fecha.substring(0, 4);
    var dia = data.fecha.substring(8, 10);

    var fechaConvert = dia + " de " + arreglo[mes] + " de " + anio;

    if (archivo == "Registro") {
        document.querySelector("#fechaValor").innerText = fechaConvert;
        document.querySelector("#fechaTrasaccion").classList.remove("hide");
    } else {
        document.querySelector(".fechaListadoValor").innerText = fechaConvert;
        document.querySelector(".fechaListado").classList.remove("hide");
    }

}



function resetPartida() {

    var table = document.querySelector("#tableCuentasLBM");

    while (table.rows.length > 1) {
        table.deleteRow(1);
    }

    data.fecha = "";
    document.querySelector("#fechaTrasaccion").classList.add("hide");
    document.querySelector("#fechaTransaccion").removeAttribute("disabled");
    document.querySelector("#advertenciaTransaccion").classList.add("hide");

}



function eliminarAsiento() {
    var tr = this.parentNode.parentNode;
    var table = tr.parentNode;

    var debe = tr.children[2].innerText;
    var haber = tr.children[3].innerText;

    if (debe != "") {
        vDebe -= parseFloat(debe.substring(1, debe.lenght));
        seccionDebeGlobal.innerText = "$" + vDebe;
    } else {
        vHaber -= parseFloat(haber.substring(1, haber.lenght));
        seccionHaberGlobal.innerText = "$" + vHaber;
    }

    var index = tr.rowIndex;

    if (index == 1) {
        transaccion.cuentas.shift();

    } else if (index == table.rows.length - 1) {
        transaccion.cuentas.pop();

    } else {
        var arrayIzquierda = transaccion.cuentas.slice(0, index - 1);
        var arrayDerecha = transaccion.cuentas.slice(index, table.rows.length - 1);
        var arrayNuevo = [...arrayIzquierda, ...arrayDerecha];
        transaccion.cuentas = arrayNuevo;
    }

    table.deleteRow(tr.rowIndex);
    balanceoPatida(table.rows.length);
}



function balanceoPatida(rows) {
    var advertencia = document.querySelector("#advertenciaTransaccion");
    if (rows != null && rows == 1) {
        advertencia.classList.add("hide");
        return;
    }

    if (vDebe != vHaber) {
        advertencia.children[0].innerText = "error_outline";
        advertencia.children[1].innerText = "Transacción desbalanceada";
        advertencia.classList.add("bgAdvertenciaError");
        advertencia.classList.remove("bgAdvertenciaCheck");
    } else {
        advertencia.children[0].innerText = "check";
        advertencia.children[1].innerText = "Transacción balanceada";
        advertencia.classList.add("bgAdvertenciaCheck");
        advertencia.classList.remove("bgAdvertenciaError");
    }
    advertencia.classList.remove("hide");
}



function editar() {

    var tr = this.parentNode.parentNode;

    var debe = tr.children[2].innerText;
    var haber = tr.children[3].innerText;
    var saldo = 0;

    if (debe != "") {
        document.querySelector("#rCorriente").checked = "true";
        saldo = debe.substring(1, debe.length);
        debeModificar = parseFloat(saldo);

    } else {
        document.querySelector("#rNoCorriente").checked = "true";
        saldo = haber.substring(1, haber.length);
        haberModificar = parseFloat(saldo);
    }

    document.querySelector("#montoOperar").value = saldo;

    document.querySelector("#asentar").value = "mode_edit";

    operacion = "modificar";

    filaSeleccionada = tr;

    document.querySelector("#cuentasListado").value = tr.children[0].innerText;

    accionModificar = "abonar";
    if (tr.children[2].innerText != "") {
        accionModificar = "cargar";
    }


}



function modificarAsiento() {

    filaSeleccionada.children[0].innerText = data.codigoCuenta;
    filaSeleccionada.children[1].innerText = data.cuenta;

    if (accionModificar == data.accion) {
        if (data.accion == "cargar") {
            filaSeleccionada.children[2].innerText = "$" + data.monto;
            filaSeleccionada.children[3].innerText = "";
            vDebe = vDebe - debeModificar;
            vDebe = vDebe + parseFloat(data.monto);

            transaccion.cuentas[filaSeleccionada.rowIndex - 1][1] = data.monto;
            seccionDebeGlobal.innerText = "$" + vDebe;
        } else {

            filaSeleccionada.children[3].innerText = "$" + data.monto;
            filaSeleccionada.children[2].innerText = "";
            vHaber = vHaber - haberModificar;
            vHaber = vHaber + parseFloat(data.monto);

            seccionHaberGlobal.innerText = "$" + vHaber;

            transaccion.cuentas[filaSeleccionada.rowIndex - 1][2] = data.monto;
        }
    } else {

        if (data.accion == "cargar") {
            vDebe += data.monto;
            vHaber -= debeModificar;
            filaSeleccionada.children[2].innerText = "$" + data.monto;
            filaSeleccionada.children[3].innerText = "";

            transaccion.cuentas[filaSeleccionada.rowIndex - 1][1] = data.monto;
            transaccion.cuentas[filaSeleccionada.rowIndex - 1][2] = 0.00;

        } else {

            vHaber += data.monto;
            vDebe -= debeModificar;

            filaSeleccionada.children[3].innerText = "$" + data.monto;
            filaSeleccionada.children[2].innerText = "";

            transaccion.cuentas[filaSeleccionada.rowIndex - 1][1] = 0.00;
            transaccion.cuentas[filaSeleccionada.rowIndex - 1][2] = data.monto;

        }
    }

    //transaccion.cuentas[filaSeleccionada.rowIndex - 1][0] = data.cuenta;
    transaccion.cuentas[filaSeleccionada.rowIndex - 1][0] = data.codigoCuenta;

    seccionHaberGlobal.innerText = "$" + vHaber;
    seccionDebeGlobal.innerText = "$" + vDebe;
    operacion = "ingresar";
    document.querySelector("#asentar").value = "save";


    //modificar 
    balanceoPatida(null);
}



function setearDatosFormularioPartida(data) {
    var form = document.querySelector(".seccionRegPartida");
    if (form.classList.contains("hide")) {
        form.classList.remove("hide");
    } else {
        form.classList.add("hide");
    }

    if (data != null && this.id!="btnCerrarFormPartida") {
        procesar(data);
    }
}
function mostrarFomularioPartida() {
    var partida = this.parentNode.children[4].closest(".partida").children[1].innerText.substring(9);
    partida = parseFloat(partida) - 1;

    var url = "?o=" + btoa("request") + "&&a=" + btoa("consultarPartida") + "&&code=" + btoa(partida);
    iniciarXMLR(url, null, setearDatosFormularioPartida)

}


function procesar(datos) {
    var parametros = {};

    for (var i = 0; i < datos.length; i++) {
        parametros.codigoCuenta = datos[i].cuenta;
        parametros.cuenta = datos[i].nombre;
        parametros.codeDetallePartida = datos[i].idDetallePartida;


        parametros.accion = "abonar";
        parametros.monto = parseFloat(datos[i].saldoHaber);

        if (datos[i].saldoDebe != "0.00") {
            parametros.accion = "cargar";
            parametros.monto = parseFloat(datos[i].saldoDebe);
        }
        cargarDatosLibroDiario(parametros);

    }


    document.querySelector("#conceptoTransaccion").value = datos[0].concepto;

    data.fecha = datos[0].fecha;
    data.partida = datos[0].partida;

    setearFecha();
}


function eliminarPartida(){
   
    iniciarAlerta(eliminarPartidaOperacion,{type:"alerta.png",mensaje:"¿Esta segura/o de eliminar partida?",data:this});
}

function eliminarPartidaOperacion(data){
    var partida = data.data.nextElementSibling.nextElementSibling.nextElementSibling;
    var nPartida = parseFloat(partida.children[1].innerText.substring(9))-1;

    var url = "?o="+btoa("request")+"&&a="+btoa("eliminarPartida")+"&&code="+btoa(nPartida);
    iniciarXMLR(url,null,load);

}

function load(){
    location.href=location.href;
}


function restaurarPartida(){
  alert();
   
}
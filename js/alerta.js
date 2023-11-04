function iniciarAlerta(funSucces,data){
    document.querySelector(".btnCerrarAdvertencia").addEventListener("click",mostrarOcultarAlerta);
    document.querySelector("#opcionAceptar").addEventListener("click",()=>funSucces(data));
    document.querySelector("#opcionDenegar").addEventListener("click",cerrarAlerta);

    document.querySelector("#mensajeAdvertencia").innerText = data.mensaje;
    document.querySelector("#imgAlerta").src="img/libroDiario/"+data.type;

    mostrarOcultarAlerta();
    
}


function mostrarOcultarAlerta(){
    var alerta = document.querySelector("#seccionAdvertencia");

    if(alerta.classList.contains("hide")){
        alerta.classList.remove("hide");
    }else{
        alerta.classList.add("hide");
    }
}

function cerrarAlerta(){
    mostrarOcultarAlerta();
}


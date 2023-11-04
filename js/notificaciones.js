var notify = null;

function initNotification(){
    document.querySelector("#closeNotify").addEventListener("click",closeNotify);
    notify = document.querySelector("#notificacion");

}

function closeNotify(){
    this.parentElement.classList.add("hide");
}

function showNotify(mensaje,bgColor){
    document.querySelector("#parrafo").innerText=mensaje;

    if(bgColor==1){
        notify.classList.add("bgGreen");
    }else if(bgColor==2){
        notify.classList.add("bgBlue");
    }else if(bgColor==3){
        notify.classList.add("bgRed");
    }else if(bgColor==4){
        notify.classList.add("bgOrange");
    }
    show();

}

function show(){
    notify.classList.remove("hide");
}
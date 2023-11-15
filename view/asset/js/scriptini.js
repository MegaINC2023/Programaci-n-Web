document.getElementById("btn__iniciar-sesion").addEventListener("click", iniciarSesion);
document.getElementById("btn__tu").addEventListener("click", register);
window.addEventListener("resize", anchoPage);

//Declarando variables
var formulario_login = document.querySelector(".formulario__login");
var formulario_tu = document.querySelector(".formulario__tu");
var contenedor_login_tu = document.querySelector(".contenedor__login-tu");
var caja_trasera_login = document.querySelector(".caja__trasera-login");
var caja_trasera_tu = document.querySelector(".caja__trasera-tu");

    //FUNCIONES

function anchoPage(){

    if (window.innerWidth > 850){
        caja_trasera_tu.style.display = "block";
        caja_trasera_login.style.display = "block";
    }else{
        caja_trasera_tu.style.display = "block";
        caja_trasera_tu.style.opacity = "1";
        caja_trasera_login.style.display = "none";
        formulario_login.style.display = "block";
        contenedor_login_tu.style.left = "0px";
        formulario_tu.style.display = "none";   
    }
}

anchoPage();


    function iniciarSesion(){
        if (window.innerWidth > 850){
            formulario_login.style.display = "block";
            contenedor_login_tu.style.left = "10px";
            formulario_tu.style.display = "none";
            caja_trasera_tu.style.opacity = "1";
            caja_trasera_login.style.opacity = "0";
        }else{
            formulario_login.style.display = "block";
            contenedor_login_tu.style.left = "0px";
            formulario_tu.style.display = "none";
            caja_trasera_tu.style.display = "block";
            caja_trasera_login.style.display = "none";
        }
    }

    function tu(){
        if (window.innerWidth > 850){
            formulario_yu.style.display = "block";
            contenedor_login_tu.style.left = "410px";
            formulario_login.style.display = "none";
            caja_trasera_tu.style.opacity = "0";
            caja_trasera_login.style.opacity = "1";
        }else{
            formulario_tu.style.display = "block";
            contenedor_login_tu.style.left = "0px";
            formulario_login.style.display = "none";
            caja_trasera_tu.style.display = "none";
            caja_trasera_login.style.display = "block";
            caja_trasera_login.style.opacity = "1";
        }
}
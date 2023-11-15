var check=document.querySelector(".check");
check.addEventListener('click',idioma);

function idioma (){
   let id=check.cheched;
   if(id==true) {
    location.href="../index.php";
   }else{
        location.href="eng/index.php"
   }

}
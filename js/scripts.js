var scrolled;
var user_menu;

window.onload = function (){

    /* ------------------ home page / pin bar (todos, interesses) ------------------ */

    document.getElementById("interesses").style.color = "white";
    document.getElementById("todos").style.color = "#1D1D1D";

    document.getElementById("interesses").onclick = function (){
        document.getElementById("selector").style.left = "0%";
        document.getElementById("interesses").style.color = "white";
        document.getElementById("todos").style.color = "#1D1D1D";
    }

    document.getElementById("todos").onclick = function (){
        document.getElementById("selector").style.left = "50%";
        document.getElementById("interesses").style.color = "#1D1D1D";
        document.getElementById("todos").style.color = "white";
    }

    /* ------------------ scroll event / nav-bar -------------------- */

    scrolled = window.scrollY;
    if (scrolled !== 0){
        document.getElementById("nav-bar").style.backgroundColor = "#f28792";
    } else{
        document.getElementById("nav-bar").style.backgroundColor = "transparent";
    }

    window.addEventListener("scroll", function (){
        scrolled = window.scrollY;
        if (scrolled !== 0){
            document.getElementById("nav-bar").style.backgroundColor = "#f28792";
        } else{
            document.getElementById("nav-bar").style.backgroundColor = "transparent";
        }
        }
    )

    /* ------------------ user menu / btn -------------------- */

    user_menu = false;
    document.getElementById("btn_user_menu_mobile").onclick = function (){
        if (user_menu === false){
            document.getElementById("panel_user_menu_mobile").style.display = "block";
            document.body.style.overflow = "hidden";
            user_menu = true;
        }
    }

    document.getElementById("background_user_menu").onclick = function (){
        if (user_menu === true){
            document.getElementById("panel_user_menu_mobile").style.display = "none";
            document.body.style.overflow = "auto";
            user_menu = false;
        }
    }

}
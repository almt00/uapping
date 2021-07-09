var scrolled;
var user_menu;

window.onload = function (){

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
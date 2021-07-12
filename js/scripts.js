var scrolled;
var user_menu;
var normal_user, admin_user, backoffice_user;

window.onload = function (){

    /* ------------------ scroll event / nav-bar -------------------- */

        scrolled = window.scrollY;
        if (scrolled !== 0){
            if (normal_user === true){
                document.getElementById("nav-bar").style.backgroundColor = "#f28792";
            } else if (admin_user === true){
                document.getElementById("nav-bar").style.backgroundColor = "#E18AC7";
            } else if (backoffice_user === true){
                document.getElementById("nav-bar").style.backgroundColor = "#FC855D";
            }
        } else{
            document.getElementById("nav-bar").style.backgroundColor = "transparent";
        }

        window.addEventListener("scroll", function (){
                scrolled = window.scrollY;
                if (scrolled !== 0){
                    if (normal_user === true){
                        document.getElementById("nav-bar").style.backgroundColor = "#f28792";
                    } else if (admin_user === true){
                        document.getElementById("nav-bar").style.backgroundColor = "#E18AC7";
                    } else if (backoffice_user === true){
                        document.getElementById("nav-bar").style.backgroundColor = "#FC855D";
                    }
                } else{
                    document.getElementById("nav-bar").style.backgroundColor = "transparent";
                }
            }
        )

    if(admin_user === true){
        document.getElementById("role_admin_header").style.display = "inline";
    } else if(backoffice_user === true){
        document.getElementById("role_backoffice_header").style.display = "inline";
    }

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
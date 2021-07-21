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
        document.getElementById("home_page_header").style.display = "none"
        document.getElementById("home_page_header_admin").style.display = "inline"
        document.getElementById("home_page_header_backoffice").style.display = "none"
    } else if(backoffice_user === true){
        document.getElementById("role_backoffice_header").style.display = "inline";
        document.getElementById("home_page_header").style.display = "none"
        document.getElementById("home_page_header_admin").style.display = "none"
        document.getElementById("home_page_header_backoffice").style.display = "inline"
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
            document.getElementById("menu_profile").style.display = "block";
            document.getElementById("change_avatar").style.display = "none";

            document.getElementById("profile_avatar").style.backgroundImage = 'url("assets/img/user_profile.png")'; // CAMINHO IMAGEM JÁ GUARDADA NA BD
            document.getElementById("avatar_1").checked = false;
            document.getElementById("avatar_2").checked = false;
            document.getElementById("avatar_3").checked = false;
            document.getElementById("avatar_4").checked = false;
            document.getElementById("avatar_5").checked = false;
            document.getElementById("avatar_6").checked = false;

            user_menu = false;
        }
    }

    document.getElementById("avatar").onclick = function (){
        document.getElementById("menu_profile").style.display = "none";
        document.getElementById("change_avatar").style.display = "block";
    }

    /* inputs */

    var avatar_id;

    document.getElementById("avatar_1").onclick = function (){
        if (document.getElementById("avatar_1").checked === true){
            avatar_id = 1;
            check_avatar(avatar_id);
        }
    }

    document.getElementById("avatar_2").onclick = function (){
        if (document.getElementById("avatar_2").checked === true){
            avatar_id = 2;
            check_avatar(avatar_id);
        }
    }

    document.getElementById("avatar_3").onclick = function (){
        if (document.getElementById("avatar_3").checked === true){
            avatar_id = 3;
            check_avatar(avatar_id);
        }
    }

    document.getElementById("avatar_4").onclick = function (){
        if (document.getElementById("avatar_4").checked === true){
            avatar_id = 4
            check_avatar(avatar_id);
        }
    }

    document.getElementById("avatar_5").onclick = function (){
        if (document.getElementById("avatar_5").checked === true){
            avatar_id = 5;
            check_avatar(avatar_id);
        }
    }

    document.getElementById("avatar_6").onclick = function (){
        if (document.getElementById("avatar_6").checked === true){
            avatar_id = 6;
            check_avatar(avatar_id);
        }
    }

    function check_avatar(avatar_id){
        switch (avatar_id){
            case 1: document.getElementById("profile_avatar").style.backgroundImage = 'url("assets/avatares/avatar_branco.svg")'; break;
            case 2: document.getElementById("profile_avatar").style.backgroundImage = 'url("assets/avatares/avatar_cinza.svg")'; break;
            case 3: document.getElementById("profile_avatar").style.backgroundImage = 'url("assets/avatares/avatar_azul.svg")'; break;
            case 4: document.getElementById("profile_avatar").style.backgroundImage = 'url("assets/avatares/avatar_vermelho.svg")'; break;
            case 5: document.getElementById("profile_avatar").style.backgroundImage = 'url("assets/avatares/avatar_roxo.svg")'; break;
            case 6: document.getElementById("profile_avatar").style.backgroundImage = 'url("assets/avatares/avatar_amarelo.svg")'; break;
        }
    }

}
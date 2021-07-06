var interesses_menu;

/* ------------------ home page / pin bar (todos, interesses) ------------------ */

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

/* ------------------ interesses / btn home_page (eventos) -------------------- */

interesses_menu = false;
document.getElementById("btn_interesses").onclick = function (){
    if (interesses_menu === false){
        document.getElementById("panel_interesses_menu_mobile").style.display = "block";
        setTimeout(function (){
            document.getElementById("interesses_menu").style.bottom = "0";
        },10)
        document.body.style.overflow = "hidden";
        interesses_menu = true;
    }
}

document.getElementById("background_interesses_menu").onclick = function (){
    if (interesses_menu === true){
        document.getElementById("panel_interesses_menu_mobile").style.display = "none";
        document.getElementById("interesses_menu").style.bottom = "-32rem";
        document.body.style.overflow = "auto";
        interesses_menu = false;
    }
}
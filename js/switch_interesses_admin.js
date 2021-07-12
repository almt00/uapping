var interesses_menu;
var checkpills_1, checkpills_2, checkpills_3, checkpills_4, checkpills_5;

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



checkpills_1 = false;
document.getElementById("checkpills_1").onclick = function (){
    if (checkpills_1 === false){
        checkpills_1 = true;
        document.getElementById("checkpills-input-1").checked = true;
        document.getElementById("checkpills-text-1").style.color = "#378FED";
    } else{
        checkpills_1 = false;
        document.getElementById("checkpills-input-1").checked = false;
        document.getElementById("checkpills-text-1").style.color = "#979797";
    }
}

checkpills_2 = false;
document.getElementById("checkpills_2").onclick = function (){
    if (checkpills_2 === false){
        checkpills_2 = true;
        document.getElementById("checkpills-input-2").checked = true;
        document.getElementById("checkpills-text-2").style.color = "#378FED";
    } else{
        checkpills_2 = false;
        document.getElementById("checkpills-input-2").checked = false;
        document.getElementById("checkpills-text-2").style.color = "#979797";
    }
}
checkpills_3 = false;
document.getElementById("checkpills_3").onclick = function (){
    if (checkpills_3 === false){
        checkpills_3 = true;
        document.getElementById("checkpills-input-3").checked = true;
        document.getElementById("checkpills-text-3").style.color = "#378FED";
    } else{
        checkpills_3 = false;
        document.getElementById("checkpills-input-3").checked = false;
        document.getElementById("checkpills-text-3").style.color = "#979797";
    }
}

checkpills_4 = false;
document.getElementById("checkpills_4").onclick = function (){
    if (checkpills_4 === false){
        checkpills_4 = true;
        document.getElementById("checkpills-input-4").checked = true;
        document.getElementById("checkpills-text-4").style.color = "#378FED";
    } else{
        checkpills_4 = false;
        document.getElementById("checkpills-input-4").checked = false;
        document.getElementById("checkpills-text-4").style.color = "#979797";
    }
}

checkpills_5 = false;
document.getElementById("checkpills_5").onclick = function (){
    if (checkpills_5 === false){
        checkpills_5 = true;
        document.getElementById("checkpills-input-5").checked = true;
        document.getElementById("checkpills-text-5").style.color = "#378FED";
    } else{
        checkpills_5 = false;
        document.getElementById("checkpills-input-5").checked = false;
        document.getElementById("checkpills-text-5").style.color = "#979797";
    }
}


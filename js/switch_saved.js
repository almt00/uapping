
/* ------------------ home page / pin bar (todos, interesses) ------------------ */

document.getElementById("ativos").onclick = function (){
    document.getElementById("selector").style.left = "0%";
    document.getElementById("ativos").style.color = "white";
    document.getElementById("passados").style.color = "#1D1D1D";
    document.getElementById("text_saved_ativos").style.display = "block";
    document.getElementById("text_saved_passados").style.display = "none";
}

document.getElementById("passados").onclick = function (){
    document.getElementById("selector").style.left = "50%";
    document.getElementById("ativos").style.color = "#1D1D1D";
    document.getElementById("passados").style.color = "white";
    document.getElementById("text_saved_ativos").style.display = "none";
    document.getElementById("text_saved_passados").style.display = "block";
}
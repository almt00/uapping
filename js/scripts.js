
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

}
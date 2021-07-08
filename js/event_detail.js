var capa_scroll;

/* ------------------ card topo / capa evento ------------------ */

capa_scroll = window.scrollY;
if (capa_scroll > 400){
    document.getElementById("capa_evento").style.display = "none";
} else{
    document.getElementById("capa_evento").style.display = "flex";
}

window.addEventListener("scroll", function (){
    capa_scroll = window.scrollY;
        if (capa_scroll > 400){
            document.getElementById("capa_evento").style.display = "none";
        } else{
            document.getElementById("capa_evento").style.display = "flex";
        }
    }
)

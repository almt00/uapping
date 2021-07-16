var capa_scroll;

$(document).ready(function () {
    $('.save').on('click', function () {
        var id = $(this).attr('name');

        console.log(id);
        $.ajax({
            url: 'components/bd_insert_saved.php', //Jquery carrega serverside.php
            data: 'id_evento=' + id, // Envia o valor do botão clicado
            dataType: 'json', //escolhe o tipo de dados
            type: 'GET', //por default, mas pode ser POST
        })
            .done(function (data) {
                console.log("success")
                //createHTMLDinamyc("eventos_template","eventos_conteudo", data);

            })
            .fail(function () { // Se existir um erro no pedido
                console.log("nop")
                //$('#eventos').html('Data error'); // Escreve mensagem de erro na listagem de vinhos
            })
        ;
        return false; // keeps the page from not refreshing
    });

});


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

document.getElementById("btn_back").onclick = function () {
    window.history.back();
}

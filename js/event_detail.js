var capa_scroll;
var $add, $remove

$add = $("#addGuardado");
$remove = $("#removeGuardado");

    $remove.on('click', function () {
        $remove.hide();
        $add.show();
        var id = $(this).attr('name');

        $.ajax({
            url: 'components/bd_insert_saved.php', //Jquery carrega serverside.php
            data: 'id_evento=' + id, // Envia o valor do botão clicado
            dataType: 'json', //escolhe o tipo de dados
            type: 'GET', //por default, mas pode ser POST
        })
            .done(function (data) {
                console.log("success add")
            })
            .fail(function () { // Se existir um erro no pedido
                //console.log("nop")
                //$('#eventos').html('Data error'); // Escreve mensagem de erro na listagem de vinhos
            })
        ;
        return false; // keeps the page from not refreshing
    });

    $add.on("click", function() {
        $remove.show();
        $add.hide();
        var id = $(this).attr('name');

        $.ajax({
            url: 'components/bd_search_saved_delete.php', //Jquery carrega serverside.php
            data: 'id_evento=' + id, // Envia o valor do botão clicado
            dataType: 'json', //escolhe o tipo de dados
            type: 'GET', //por default, mas pode ser POST
        })
            .done(function (data) {
                console.log("success delete")
            })
            .fail(function () { // Se existir um erro no pedido
                console.log("nop")
                //$('#eventos').html('Data error'); // Escreve mensagem de erro na listagem de vinhos
            })
        ;
        return false; // keeps the page from not refreshing

        // do your AJAX stuff to remove the favourite here

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

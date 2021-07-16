$(document).ready(function () {
    $('.capture_saved_id').on('click', function () {
        var name_switch = this.id;

        console.log(name_switch);
        $.ajax({
            url: 'components/bd_search_saved.php', //Jquery carrega serverside.php
            data: 'name_switch=' + name_switch, // Envia o valor do botão clicado
            dataType: 'json', //escolhe o tipo de dados
            type: 'GET', //por default, mas pode ser POST
        })
/*
            .done(function (data) {
                createHTMLDinamyc("eventos_template","eventos_conteudo", data);

            })
            .fail(function () { // Se existir um erro no pedido
                $('#eventos').html('Data error'); // Escreve mensagem de erro na listagem de vinhos
            })
        ;
        return false; // keeps the page from not refreshing */
    });

});

/*
function createHTMLDinamyc(templateId, placeID, data) {
    var raw_template = document.getElementById(templateId).innerText;
    var compiled_template = Handlebars.compile(raw_template);
    var ourGeneratedHTML = compiled_template(data);
    var place = document.getElementById(placeID);
    place.innerHTML = ourGeneratedHTML;
}*/

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

$(document).ready(function () {
    var $add, $remove

    $remove = $(".remove");
//quero que haja um evento no futuro, neste documento ao clicar procura a classe remove
    $(document).on("click", ".remove", function() {

        var id = $(this).attr('name');
        console.log(id);

        $.ajax({
            url: 'bd/bd_search_saved_delete.php', //Jquery carrega serverside.php
            data: 'id_evento=' + id, // Envia o valor do botão clicado
            dataType: 'json', //escolhe o tipo de dados
            type: 'GET', //por default, mas pode ser POST
        })
            .done(function (data) {
                window.location.reload();
            })
            .fail(function () { // Se existir um erro no pedido
                console.log("nop")
                //$('#eventos').html('Data error'); // Escreve mensagem de erro na listagem de vinhos
            })
        ;
        return false; // keeps the page from not refreshing
    });

});



$(document).ready(function () {
    $('.capture_saved_id').on('click', function () {
        var name_switch = this.id;

        $("#eventos_guardados_load").removeAttr("style").hide();

        $.ajax({
            url: 'bd/bd_search_saved.php', //Jquery carrega serverside.php
            data: 'name_switch=' + name_switch, // Envia o valor do botão clicado
            dataType: 'json', //escolhe o tipo de dados
            type: 'GET', //por default, mas pode ser POST
        })

            .done(function (data) {
                createHTMLDinamyc("eventos_guardados_template", "eventos_guardados_conteudo", data);
            })

            .fail(function () { // Se existir um erro no pedido
                $('#eventos_guardados_conteudo').html('Data error'); // Escreve mensagem de erro
            })
        ;
        return false; // keeps the page from not refreshing */
    });

});

Handlebars.registerHelper('formatDate', function (dateString) {
    return new Handlebars.SafeString(
        moment(dateString).format("DD/MM")
    );
});
Handlebars.registerHelper('concat', function (prefix, id) {
    return (prefix + id);
});


function createHTMLDinamyc(templateId, placeID, data) {
    var raw_template = document.getElementById(templateId).innerText;
    var compiled_template = Handlebars.compile(raw_template);
    var ourGeneratedHTML = compiled_template(data);
    var place = document.getElementById(placeID);
    place.innerHTML = ourGeneratedHTML;
}

/* ------------------ home page / pin bar (todos, interesses) ------------------ */

document.getElementById("ativos").onclick = function () {
    document.getElementById("selector").style.left = "0%";
    document.getElementById("ativos").style.color = "white";
    document.getElementById("passados").style.color = "#1D1D1D";
    document.getElementById("text_saved_ativos").style.display = "block";
    document.getElementById("text_saved_passados").style.display = "none";
}

document.getElementById("passados").onclick = function () {
    document.getElementById("selector").style.left = "50%";
    document.getElementById("ativos").style.color = "#1D1D1D";
    document.getElementById("passados").style.color = "white";
    document.getElementById("text_saved_ativos").style.display = "none";
    document.getElementById("text_saved_passados").style.display = "block";
}

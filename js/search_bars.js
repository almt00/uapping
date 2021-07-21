/* ------------------ home page Backoffice Users / search bar ------------------ */
$(document).ready(function () {
    console.log('teste');
    $('#search-bar').on('keyup', function () {
        console.log('keyup');

        var search = this.value;
        console.log('search: ' + search);
        $.ajax({
            url: 'bd/bd_search_users.php', //Jquery carrega serverside.php
            data: 'search=' + search, // Envia o valor do botão clicado
            dataType: 'json', //escolhe o tipo de dados
            type: 'GET', //por default, mas pode ser POST
        })
            .done(function (data) {
                console.log('sucesso');

                $("#eventos_load").removeAttr("style").hide();
                if (data == "") {
                    document.getElementById("eventos_conteudo").innerHTML = "Infelizmente. Não há resultados para a sua pesquisa..";
                    document.getElementById("eventos_conteudo").style.margin = "auto";
                    document.getElementById("selector").style.left = "50%";
                    document.getElementById("interesses").style.color = "#1D1D1D";
                    document.getElementById("todos").style.color = "white";
                    document.getElementById("eventos_load").style.display = "none";

                } else {
                    createHTMLDinamyc("eventos_template", "eventos_conteudo", data);
                }

            })
            .fail(function () { // Se existir um erro no pedido
                console.log('erro');
                $('#eventos').html('Data error'); // Escreve mensagem de erro
            });
        return false; // keeps the page from not refreshing
    });
});

Handlebars.registerHelper('role', function (admin_normal) {
    if (admin_normal == 1) {
        return 'admin';
    } else {
        return 'normal';
    }
});

/*Handlebars.registerHelper('ban', function (ativo, id_user) {
    if (ativo == 1) {
        document.getElementById(""+id_user+"").src = "assets/img/ban_cinza.svg";
        document.getElementById(""+id_user+"").className = "ban";
        console.log('ativo');
    }

    if (ativo != 1) {
        document.getElementById(""+id_user+"").src = "assets/img/ban_vermelho.svg";
        document.getElementById(""+id_user+"").className = "unban";
        console.log('banido');
        console.log(document.getElementById(""+id_user+""));
    }
});*/


// ban utilizador
$(document).on('click', ".ban", function () { // remover
    this.src = "assets/img/ban_vermelho.svg";
    $(this).attr("class", "unban");
    var id = $(this).attr('id');

    $.ajax({
        url: 'bd/bd_user_ban.php', //Jquery carrega serverside.php
        data: 'id_user=' + id, // Envia o valor do botão clicado
        dataType: 'json', //escolhe o tipo de dados
        type: 'GET', //por default, mas pode ser POST
    })
        .done(function (data) {
            console.log("add")
        })
        .fail(function () { // Se existir um erro no pedido

        })
    ;
    return false; // keeps the page from not refreshing
});

//unban utilizador
$(document).on('click', ".unban", function () { // remover
    this.src = "assets/img/ban_cinza.svg";
    $(this).attr("class", "ban");
    var id = $(this).attr('id');

    $.ajax({
        url: 'bd/bd_user_unban.php', //Jquery carrega serverside.php
        data: 'id_user=' + id, // Envia o valor do botão clicado
        dataType: 'json', //escolhe o tipo de dados
        type: 'GET', //por default, mas pode ser POST
    })
        .done(function (data) {
        })
        .fail(function () { // Se existir um erro no pedido
        })
    ;
    return false; // keeps the page from not refreshing
});

function createHTMLDinamyc(templateId, placeID, data) {
    var raw_template = document.getElementById(templateId).innerText;
    var compiled_template = Handlebars.compile(raw_template);
    var ourGeneratedHTML = compiled_template(data);
    var place = document.getElementById(placeID);
    place.innerHTML = ourGeneratedHTML;
}

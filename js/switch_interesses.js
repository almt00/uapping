var interesses_menu;
var checkpills_1, checkpills_2, checkpills_3, checkpills_4, checkpills_5;

/* ------------------ home page / pin bar (todos, interesses) ------------------ */

$(document).ready(function () {
    $('.capture_id').on('click', function () {
        var id_switch = this.id;

        $.ajax({
            url: 'components/bd_eventos.php', //Jquery carrega serverside.php
            data: 'id_switch=' + id_switch, // Envia o valor do botão clicado
            dataType: 'json', //escolhe o tipo de dados
            type: 'GET', //por default, mas pode ser POST
        })
            .done(function (data) {
                createHTMLDinamyc("eventos_template", "eventos_conteudo", data);

            })
            .fail(function () { // Se existir um erro no pedido
                $('#eventos').html('Data error'); // Escreve mensagem de erro na listagem de vinhos
            })
        ;
        return false; // keeps the page from not refreshing
    });
});
// teste search
$(document).ready(function () {
    console.log('teste');
    $('#search-bar').on('keyup', function () {
        console.log('keyup');
        var search = this.value;
        console.log('search: ' + search);
        $.ajax({
            url: 'components/bd_search.php', //Jquery carrega serverside.php
            data: 'search=' + search , // Envia o valor do botão clicado
            dataType: 'json', //escolhe o tipo de dados
            type: 'GET', //por default, mas pode ser POST
        })
            .done(function (data) {
                console.log('sucesso');

                createHTMLDinamyc("eventos_template", "eventos_conteudo", data);
            })
            .fail(function () { // Se existir um erro no pedido
                console.log('erro');
                $('#eventos').html('Data error'); // Escreve mensagem de erro na listagem de vinhos
            });
        return false; // keeps the page from not refreshing
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


document.getElementById("interesses").onclick = function () {
    document.getElementById("selector").style.left = "0%";
    document.getElementById("interesses").style.color = "white";
    document.getElementById("todos").style.color = "#1D1D1D";
    document.getElementById("eventos_load").style.display = "none";

}

document.getElementById("todos").onclick = function () {
    document.getElementById("selector").style.left = "50%";
    document.getElementById("interesses").style.color = "#1D1D1D";
    document.getElementById("todos").style.color = "white";
    document.getElementById("eventos_load").style.display = "none";
}

/* ------------------ interesses / btn home_page (eventos) -------------------- */


interesses_menu = false;
document.getElementById("btn_interesses").onclick = function () {
    if (interesses_menu === false) {
        document.getElementById("panel_interesses_menu_mobile").style.display = "block";
        setTimeout(function () {
            document.getElementById("interesses_menu").style.bottom = "0";
        }, 10)
        document.body.style.overflow = "hidden";
        interesses_menu = true;
    }
}


document.getElementById("background_interesses_menu").onclick = function () {
    if (interesses_menu === true) {
        document.getElementById("panel_interesses_menu_mobile").style.display = "none";
        document.getElementById("interesses_menu").style.bottom = "-32rem";
        document.body.style.overflow = "auto";
        interesses_menu = false;
    }
}

$(document).ready(function () {
    $('#btn_interesses').on('click', function () {

        $.ajax({
            url: 'components/bd_pills_interesses.php', //Jquery carrega serverside.php
            //data: 'filtro=' + filtro, // Envia o valor do botão clicado
            dataType: 'json', //escolhe o tipo de dados
            type: 'GET', //por default, mas pode ser POST
        })
            .done(function (data) {
                createHTMLDinamyc("pills_interesses_template", "pills_interesses_conteudo", data);

            })
            .fail(function () { // Se existir um erro no pedido
                $('#checkpills').html('Data error'); // Escreve mensagem de erro na listagem de vinhos
            })
        ;
        return false; // keeps the page from not refreshing
    });
});

/*
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
*/

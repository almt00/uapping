/* ------------------ HOME PAGE NÚCLEOS / (OFICCIAIS E CRIAÇÕES) ------------------ */

$(document).ready(function (){
    $(".esconde").hide(); //PARA ESCONDER O INPUT QUE PERMITE PROCURA DE NUCLEOS FANTASMA
});

/* ------------------------------ OFICIAIS E CRIAÇÕES / BTN ------------------------------------ */

document.getElementById("oficiais").onclick = function (){
    document.getElementById("selector").style.left = "0%";
    document.getElementById("oficiais").style.color = "white";
    document.getElementById("criacoes").style.color = "#1D1D1D";
    document.getElementById("text_nucleo_oficiais").style.display = "block";
    document.getElementById("text_nucleo_criacoes").style.display = "none";
    document.getElementById("nucleos_oficiais").style.display = "block";
    document.getElementById("nucleos_criacoes").style.display = "none";
    document.getElementById("search-bar-oficial").style.display = "block";//MOSTRA INPUT OFICIAIS
    document.getElementById("search-bar-fantasma").style.display = "none";//ESCONDE INPUT CRIAÇÕES

}

document.getElementById("criacoes").onclick = function (){
    document.getElementById("selector").style.left = "50%";
    document.getElementById("oficiais").style.color = "#1D1D1D";
    document.getElementById("criacoes").style.color = "white";
    document.getElementById("text_nucleo_oficiais").style.display = "none";
    document.getElementById("text_nucleo_criacoes").style.display = "block";
    document.getElementById("nucleos_oficiais").style.display = "none";
    document.getElementById("nucleos_criacoes").style.display = "block";
    document.getElementById("search-bar-oficial").style.display = "none";//ESCONDE INPUT OFICIAIS
    document.getElementById("search-bar-fantasma").style.display = "block";//MOSTRA INPUT CRIAÇÕES

}


/* ---------------------------------- ADERIR A NÚCLEO FANTASMA -------------------------------------*/

$(document).ready(function () {
    $(document).on('click', ".aderir_fantasma", function () {// ATRIBUIR SVG

        var $this = $(this);
        this.src="assets/criacoes_nucleos/aderiu_criacoes.svg";
        $(this).attr("class","aderiu_fantasma");

        var id = $(this).attr('id');

        $.ajax({
            url: 'bd/bd_nucleo_join.php', //Jquery carrega serverside.php
            data: 'id_nucleo=' + id, // Envia o valor do botão clicado
            dataType: 'json', //escolhe o tipo de dados
            type: 'GET', //por default, mas pode ser POST
        })
            .done(function (data) {
            })
            .fail(function () { // SE PEDIDO NÃO FOR ACEITE
            })
        ;
        return false; // keeps the page from not refreshing
    });

    /* ------------------------------- SAIR DE NÚCLEO FANTASMA -----------------------------------*/

    $(document).on('click', ".aderiu_fantasma", function () { // REMOVER SVG
        console.log('click');
        var $this = $(this);
        this.src="assets/criacoes_nucleos/aderir_criacoes.svg";
        $(this).attr("class","aderir_fantasma");

        var id = $(this).attr('id');

        $.ajax({
            url: 'bd/bd_nucleo_quit.php', //Jquery carrega serverside.php
            data: 'id_nucleo=' + id, // Envia o valor do botão clicado
            dataType: 'json', //escolhe o tipo de dados
            type: 'GET', //por default, mas pode ser POST
        })
            .done(function (data) {
            })
            .fail(function () { // SE PEDIDO NÃO FOR ACEITE
            })
        ;
        return false; // keeps the page from not refreshing
    });
});


/* ------------------------------ NUCLEOS OFICIAIS / SEARCH INPUT ------------------------------ */

$(document).ready(function () {

    $('#search-bar-oficial').on('keyup', function () {// RECONHECE CADA TECLA PRESSIONADA
        var search = this.value; //ATRIBUI VALOR DO INPUT OFICIAIS

        $.ajax({
            url: 'bd/bd_search_nucleo_oficial.php', //Jquery carrega serverside.php
            data: 'search=' + search, // Envia o valor do botão clicado
            dataType: 'json', //escolhe o tipo de dados
            type: 'GET', //por default, mas pode ser POST
        })
            .done(function (data) {
                $("#eventos_load").removeAttr("style").hide();

                if(data == ""){
                    document.getElementById("eventos_conteudo").innerHTML = "Infelizmente. Não há resultados para a sua pesquisa..";
                    document.getElementById("eventos_conteudo").style.margin= "auto";
                    document.getElementById("eventos_load").style.display = "none";

                }else{
                    //PERMITE APRESENTAR DIV COM TEMPLATE HANDLEBARS
                    createHTMLDinamyc("template_oficiais", "eventos_conteudo", data);
                }

            })
            .fail(function () { // Se existir um erro no pedido
                console.log('erro');
                $('#eventos').html('Data error'); // MENSAGEM ERRO
            });
        return false; // keeps the page from not refreshing
    });
});

/* ------------------------------ NUCLEOS CRIAÇÕES / SEARCH INPUT ------------------------------ */
$(document).ready(function () {

    $('#search-bar-fantasma').on('keyup', function () {// RECONHECE CADA TECLA PRESSIONADA
        var search = this.value;//ATRIBUI VALOR DO INPUT CRIAÇÕES

        $.ajax({
            url: 'bd/bd_search_nucleo_fantasma.php', //Jquery carrega serverside.php
            data: 'search=' + search, // Envia o valor do botão clicado
            dataType: 'json', //escolhe o tipo de dados
            type: 'GET', //por default, mas pode ser POST
        })
            .done(function (data) {
                $(".esconde_conteudo").css('display','none');
                if(data == ""){
                    console.log("Não injecta template");
                    document.getElementById("eventos_conteudo").innerHTML = "Infelizmente. Não há resultados para a sua pesquisa..";
                    document.getElementById("eventos_conteudo").style.margin= "auto";
                    document.getElementById("eventos_load").style.display = "none";

                }else{
                    //PERMITE APRESENTAR DIV COM TEMPLATE HANDLEBARS
                    createHTMLDinamyc("template_fantasmas", "phantom", data);
                }

            })
            .fail(function () { // Se existir um erro no pedido
                console.log('erro');
                $('#eventos').html('Data error'); // MENSAGEM ERRO
            });
        return false; // keeps the page from not refreshing
    });
});

/* ------------------ FUNÇÃO HANDLEBARS ------------------ */

function createHTMLDinamyc(templateId, placeID, data) {
    var raw_template = document.getElementById(templateId).innerText;
    var compiled_template = Handlebars.compile(raw_template);
    var ourGeneratedHTML = compiled_template(data);
    var place = document.getElementById(placeID);
    place.innerHTML = ourGeneratedHTML;
}


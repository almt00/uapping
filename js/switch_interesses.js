var interesses_menu;
//var checkpills_1, checkpills_2, checkpills_3, checkpills_4, checkpills_5; //ISTO SERIA PARA OS PILLS DO FILTRO DA HOMEPAGE CASO ESTIVESSE A FUNCIONAR
var capture_id_is_active = false;
var capture_id = null;
var offset;

/* ------------------ HOMEPAGE / AJAX EVENTOS ------------------ */

$(document).ready(function () {
    $('.capture_id').on('click', function () { //CLICANDO NA CLASSE QUE ESTÁ NO SWITCH

        var id_switch = this.id; //VAI CAPTURAR O VALOR DO ID DE CADA BOTAO

        $(".pills_datas").css("background-color", "#ffffff54"); //CORES PILLS DATA
        $(".pills_datas").css("color", "#B25959");

        $.ajax({
            url: 'bd/bd_eventos.php',
            data: 'id_switch=' + id_switch, // VALOR INTERESSES / TODOS
            dataType: 'json',
            type: 'GET',
        })
            .done(function (data) {
                $("#eventos_load").removeAttr("style").hide(); //REMOVE A PARTE DOS EVENTOS QUE VEM SEM O AJAX DA PÁGINA

                createHTMLDinamyc("eventos_template", "eventos_conteudo", data);
                //HANDLEBARS QUE COLOCA O QUE ESTÁ NO (EVENTOS TEMPLATE + A DATA) A APARECER NA DIV VAZIA EVENTOS CONTEUDO

            })
            .fail(function () {
                $('#eventos').html('Data error'); // Escreve mensagem de erro
            })
        ;
        return false; // keeps the page from not refreshing
    });
});

/* ------------------ HOMEPAGE / SEARCH BAR ------------------ */
$(document).ready(function () {
    $('#search-bar').on('keyup', function () { //TECLA RELEASED
        document.getElementById("eventos_conteudo").style.margin= "auto";
        document.getElementById("selector").style.left = "50%";
        document.getElementById("interesses").style.color = "#1D1D1D";
        document.getElementById("todos").style.color = "white";
        document.getElementById("eventos_load").style.display = "none";

        var search = this.value; //CAPTURA O VALOR
        $.ajax({
            url: 'bd/bd_search.php',
            data: 'search=' + search, // VALOR PESQUISADO
            dataType: 'json',
            type: 'GET',
        })
            .done(function (data) {
                $("#eventos_load").removeAttr("style").hide(); //LIMPA A DIV DOS EVENTOS QUE VEM SEM SER VIA AJAX

                if(data == ""){ //NÃO HAVENDO RESULTADO
                    document.getElementById("eventos_conteudo").innerHTML = "<p class='text-center p-3'>Infelizmente não há resultados para a sua pesquisa...</p>";
                    //MUDAR VISUALMENTE O SWITCH PARA TODOS

                }else{
                    createHTMLDinamyc("eventos_template", "eventos_conteudo", data);
                }

            })
            .fail(function () {
                $('#eventos').html('Data error'); // MENSAGEM ERRO
            });
        return false; // keeps the page from not refreshing
    });
});

/* ------------------ HOMEPAGE / PILLS FILTRAR EVENTOS DATA ------------------ */
$(document).ready(function () {
    $(".pills_datas").on('click', function () {
        var date = this.id;
        //TODOS OS PILLS FICAM IGUAIS CROMÁTICAMENTE COMO SE NAO FOSSEM CLICADOS
        $(".pills_datas").css("background-color", "#ffffff54");
        $(".pills_datas").css("color", "#B25959");
        //CLICANDO NO PILL MUDA DE COR
        $(this).css("background-color", "#F6CCAD")
        $(this).css("color", "#BA6C33")
        //MUDANÇA DO SWITCH PARA TODOS
        document.getElementById("selector").style.left = "50%";
        document.getElementById("interesses").style.color = "#1D1D1D";
        document.getElementById("todos").style.color = "white";
        document.getElementById("eventos_load").style.display = "none";

        $.ajax({
            url: 'bd/bd_pill_filter.php', //Jquery carrega serverside.php
            data: 'date=' + date, // Envia o valor do botão clicado
            dataType: 'json', //escolhe o tipo de dados
            type: 'GET', //por default, mas pode ser POST
        })
            .done(function (data) {
                $("#eventos_load").removeAttr("style").hide();

                if(data == ""){
                    document.getElementById("eventos_conteudo").innerHTML = "<p class='text-center p-3'>Infelizmente não há resultados para a sua pesquisa...</p>";
                }else{
                    createHTMLDinamyc("eventos_template", "eventos_conteudo", data);
                }
            })
            .fail(function () {
                $('#eventos').html('Data error'); // MENSAGEM ERRO
            });
        return false; // keeps the page from not refreshing
    });
});


/* ------------------ HOMEPAGE / SAVED ------------------*/

$add = $(".save"); //BOTAO COM CLASSE SAVE
$remove = $(".remove"); //BOTAO COM CLASSE REMOVE

$(document).ready(function () {
    //NO MOMENTO DO ONCLICK (BINDING) NÃO EXISTE O ELEMENTO COM A CLASSE SAVE. TEM QUE HAVER A INCLUSAO DE UM ELEMENTO QUE EXISTA.
    $(document).on('click', ".save", function () {
        $(this).hide(); //ESCONDE O BOTAO
        $(this).next().show() //MOSTRA O PRÓXIMO BOTAO (ORDEM HTML)

        var id = $(this).attr('name'); //ATRIBUTO NOME VAI COM O ID DO EVENTO

        $.ajax({
            url: 'bd/bd_insert_saved.php',
            data: 'id_evento=' + id,
            dataType: 'json',
            type: 'GET',
        })
            .done(function (data) {
            })
            .fail(function () {
                $('#eventos').html('Data error'); // MENSAGEM ERRO
            })
        ;
        return false; // keeps the page from not refreshing
    });

    $(document).on('click', ".remove", function () {
        $(this).hide(); //ESCONDE O BOTAO
        $(this).prev().show() //MOSTRA O BOTAO ANTERIOR (ORDEM HTML)

        var id = $(this).attr('name');

        $.ajax({
            url: 'bd/bd_search_saved_delete.php',
            data: 'id_evento=' + id,
            dataType: 'json',
            type: 'GET',
        })
            .done(function (data) {
            })
            .fail(function () {
                $('#eventos').html('Data error'); // MENSAGEM ERRO
            })
        ;
        return false; // keeps the page from not refreshing
    });

});

/* ------------------ HOMEPAGE BACKOFFICE / SEARCH BAR ------------------ */
$(document).ready(function () {

    $('#search-bar-backoffice').on('keyup', function () {

        var search = this.value;
        $.ajax({
            url: 'bd/bd_search.php', //Jquery carrega serverside.php
            data: 'search=' + search, // Envia o valor do botão clicado
            dataType: 'json', //escolhe o tipo de dados
            type: 'GET', //por default, mas pode ser POST
        })
            .done(function (data) {

                $("#eventos_load").removeAttr("style").hide();
                if(data == ""){
                    document.getElementById("eventos_conteudo").innerHTML = "<p class='text-center p-3'>Infelizmente não há resultados para a sua pesquisa...</p>";
                    document.getElementById("eventos_conteudo").style.margin= "auto";
                    // MUDA SWITCH PARA TODOS

                }else{
                    createHTMLDinamyc("eventos_template", "eventos_conteudo", data);
                }

            })
            .fail(function () {
                $('#eventos').html('Data error'); // MENSAGEM ERRO
            });
        return false; // keeps the page from not refreshing
    });
});

/* ------------------ HOMEPAGE NUCLEO / SEARCH BAR ------------------ */
$(document).ready(function () {
    $('#search-bar-nucleo').on('keyup', function () {

        var search = this.value;

        $.ajax({
            url: 'bd/bd_search_nucleo.php',
            data: 'search=' + search ,
            dataType: 'json',
            type: 'GET',
        })
            .done(function (data) {

                $("#eventos_load").removeAttr("style").hide();

                if(data == ""){
                    document.getElementById("eventos_conteudo").innerHTML = "<p class='text-center p-3'>Infelizmente não há resultados para a sua pesquisa...</p>";
                    document.getElementById("eventos_conteudo").style.margin= "auto";
                    document.getElementById("eventos_load").style.display = "none";

                }else{
                    createHTMLDinamyc("eventos_template", "eventos_conteudo", data);
                }
            })
            .fail(function () {
                $('#eventos').html('Data error'); // MENSAGEM ERRO
            });
        return false; // keeps the page from not refreshing
    });
});
/* ------------------------------------------------------------------------------ */


Handlebars.registerHelper('formatDate', function (dateString) {
    return new Handlebars.SafeString(
        moment(dateString).format("DD/MM")
    );
});

/* ------------------ PARTILHAR ------------------ */

Handlebars.registerHelper('sharehb', function (name, id) {
    const toShare = {
        title: "Partilhar evento:"+name+"",
        text: "Olha só este evento na UA chamado "+name+" !",
        url: "https://labmm.clients.ua.pt/deca_20L4/deca_20L4_32/evento_detail.php?id_evento="+id+"" // mudar qdo for o servidor normal senao n da
    };
     const button = document.getElementById('share_'+id+'');
    $(document).on('click', '.save_share_'+id,async () => {
        try {
            await navigator.share(toShare); // Will trigger the native "share" feature
            button.textContent = 'Shared !';
        } catch (err) {
            button.textContent = 'Something went wrong';
            console.log(err);
        }
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


$(document).ready(function () {
    $('#btn_interesses').on('click', function () {
        window.location.href = "em_contrucao.php";

        //NAO CONSEGUIMOS COLOCAR OS FILTROS QUANDO SE CLICA NO BOTAO DE FILTRAR
    /*
        $.ajax({
            url: 'bd/bd_pills_interesses.php', //Jquery carrega serverside.php
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

     */
    });
});

/* ------------------ FILTRAR INTERESSES / BTN HOMEPAGE / ANIMACAO --------------------

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
*/


/* ------INFINITE SCROLL QUE FUNCIONAVA, MAS QUE MEXIA COM OUTRAS PARTES DA PLATAFORMA,
JÁ QUE ESCOLHEMOS AVANÇAR COM ESTA PARTE UM POUCO TARDE---- */

/*
$(document).ready(function () {

    var offset = 0;


    $('.capture_id').on('click', function () {
        offset = 0;
        click = true;
        var id_switch = this.id;
        capture_id = this.id;
        capture_id_is_active = true;

        $(".pills_datas").css("background-color", "#ffffff54");
        $(".pills_datas").css("color", "#B25959");



        $.ajax({
            url: 'bd/bd_eventos.php', //Jquery carrega serverside.php
            data: 'id_switch=' + id_switch + '&offset='+ offset, // Envia o valor do botão clicado
            dataType: 'json', //escolhe o tipo de dados
            type: 'GET', //por default, mas pode ser POST

        })
            .done(function (data) {
                $("#eventos_load").removeAttr("style").hide();
                if(data != ""){
                    offset++
                    document.getElementById("eventos_conteudo").innerHTML = "";
                    createHTMLDinamyc("eventos_template", "eventos_conteudo", data);

                }else{
                    console.log("sem info no array")
                }
            })
            .fail(function () { // Se existir um erro no pedido
                $('#eventos').html('Data error'); // Escreve mensagem de erro
            })
        ;
        return false; // keeps the page from not refreshing
    });

    $(window).scroll(function() {
        if($(window).scrollTop() + $(window).height() >= $(document).height() && capture_id_is_active) {
            $.ajax({
                url: 'bd/bd_eventos.php', //Jquery carrega serverside.php
                data: 'id_switch=' + capture_id + '&offset='+ offset, // Envia o valor do botão clicado
                dataType: 'json', //escolhe o tipo de dados
                type: 'GET', //por default, mas pode ser POST
            })
                .done(function (data) {
                    $("#eventos_load").removeAttr("style").hide();

                    if(data != ""){
                            offset++
                        //$("#eventos-conteudo").append(data);
                        createHTMLDinamyc("eventos_template", "eventos_conteudo", data);
                    }else{
                        console.log("sem info no array")
                    }
                })
                .fail(function () { // Se existir um erro no pedido
                    $('#eventos').html('Data error'); // Escreve mensagem de erro
                })
            ;

        }
    });

});

/*
 */

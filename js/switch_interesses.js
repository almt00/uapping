var interesses_menu;
var checkpills_1, checkpills_2, checkpills_3, checkpills_4, checkpills_5;
var capture_id_is_active = false;
var capture_id = null;
var offset;

/* ------------------ home page / pin bar (todos, interesses) ------------------ */


$(document).ready(function () {

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
});

/* ------------------ home page / search bar ------------------ */
$(document).ready(function () {
    console.log('teste');
    $('#search-bar').on('keyup', function () {
        console.log('keyup');

        var search = this.value;
        console.log('search: ' + search);
        $.ajax({
            url: 'bd/bd_search.php', //Jquery carrega serverside.php
            data: 'search=' + search, // Envia o valor do botão clicado
            dataType: 'json', //escolhe o tipo de dados
            type: 'GET', //por default, mas pode ser POST
        })
            .done(function (data) {
                console.log('sucesso');

                $("#eventos_load").removeAttr("style").hide();
                if(data == ""){
                    document.getElementById("eventos_conteudo").innerHTML = "Infelizmente. Não há resultados para a sua pesquisa..";
                    document.getElementById("eventos_conteudo").style.margin= "auto";
                    document.getElementById("selector").style.left = "50%";
                    document.getElementById("interesses").style.color = "#1D1D1D";
                    document.getElementById("todos").style.color = "white";
                    document.getElementById("eventos_load").style.display = "none";

                }else{
                    createHTMLDinamyc("eventos_template", "eventos_conteudo", data);
                }

            })
            .fail(function () { // Se existir um erro no pedido
                console.log('erro');
                $('#eventos').html('Data error'); // Escreve mensagem de erro na listagem de vinhos
            });
        return false; // keeps the page from not refreshing
    });
});

/* ------------------ home page / pills filtrar eventos por data ------------------ */
$(document).ready(function () {
    $(".pills_datas").on('click', function () {
        var date = this.id;
        //todos os pills iguais
        $(".pills_datas").css("background-color", "#ffffff54");
        $(".pills_datas").css("color", "#B25959");
        //miguel arranjas forma do pill do dia sendo clicado mudar de cor.
        $(this).css("background-color", "#F6CCAD")
        $(this).css("color", "#BA6C33")

        $.ajax({
            url: 'bd/bd_pill_filter.php', //Jquery carrega serverside.php
            data: 'date=' + date, // Envia o valor do botão clicado
            dataType: 'json', //escolhe o tipo de dados
            type: 'GET', //por default, mas pode ser POST
        })
            .done(function (data) {
                $("#eventos_load").removeAttr("style").hide();

                if(data == ""){
                    document.getElementById("eventos_conteudo").innerHTML = "Infelizmente. Não há eventos nessa data..";

                }else{
                    createHTMLDinamyc("eventos_template", "eventos_conteudo", data);
                }

            })
            .fail(function () { // Se existir um erro no pedido
                $('#eventos').html('Engano'); // Escreve mensagem de erro na listagem de vinhos
            });
        return false; // keeps the page from not refreshing
    });
});

/* ------------------ home page / saved ------------------*/

$add = $(".save");
$remove = $(".remove");

$(document).ready(function () {
    $(document).on('click', ".save", function () {
        var $this = $(this);
        $this.hide();
        $this.next().show()

        var id = $(this).attr('name');

        $.ajax({
            url: 'bd/bd_insert_saved.php', //Jquery carrega serverside.php
            data: 'id_evento=' + id, // Envia o valor do botão clicado
            dataType: 'json', //escolhe o tipo de dados
            type: 'GET', //por default, mas pode ser POST
        })
            .done(function (data) {
                console.log("add")
            })
            .fail(function () { // Se existir um erro no pedido
                //console.log("nop")
                //$('#eventos').html('Data error'); // Escreve mensagem de erro na listagem de vinhos
            })
        ;
        return false; // keeps the page from not refreshing
    });

    $(document).on('click', ".remove", function () {
        var $this = $(this);
        $this.hide();
        $this.prev().show()

        var id = $(this).attr('name');

        $.ajax({
            url: 'bd/bd_search_saved_delete.php', //Jquery carrega serverside.php
            data: 'id_evento=' + id, // Envia o valor do botão clicado
            dataType: 'json', //escolhe o tipo de dados
            type: 'GET', //por default, mas pode ser POST
        })
            .done(function (data) {
                console.log("delete")
            })
            .fail(function () { // Se existir um erro no pedido
                console.log("nop")
                //$('#eventos').html('Data error'); // Escreve mensagem de erro na listagem de vinhos
            })
        ;
        return false; // keeps the page from not refreshing
    });

});

/* ------------------ home page backoffice / search bar ------------------ */
$(document).ready(function () {
    console.log('teste');
    $('#search-bar-backoffice').on('keyup', function () {
        console.log('keyup');

        var search = this.value;
        console.log('search: ' + search);
        $.ajax({
            url: 'bd/bd_search.php', //Jquery carrega serverside.php
            data: 'search=' + search, // Envia o valor do botão clicado
            dataType: 'json', //escolhe o tipo de dados
            type: 'GET', //por default, mas pode ser POST
        })
            .done(function (data) {
                console.log('sucesso');

                $("#eventos_load").removeAttr("style").hide();
                if(data == ""){
                    document.getElementById("eventos_conteudo").innerHTML = "Infelizmente. Não há resultados para a sua pesquisa..";
                    document.getElementById("eventos_conteudo").style.margin= "auto";
                    document.getElementById("selector").style.left = "50%";
                    document.getElementById("interesses").style.color = "#1D1D1D";
                    document.getElementById("todos").style.color = "white";
                    document.getElementById("eventos_load").style.display = "none";

                }else{
                    createHTMLDinamyc("eventos_template", "eventos_conteudo", data);
                }

            })
            .fail(function () { // Se existir um erro no pedido
                console.log('erro');
                $('#eventos').html('Data error'); // Escreve mensagem de erro na listagem de vinhos
            });
        return false; // keeps the page from not refreshing
    });
});
/* ------------------------------------------------------------------------------ */


/* ------------------ home page nucleo / search bar ------------------ */
$(document).ready(function () {
    console.log('teste');
    $('#search-bar-nucleo').on('keyup', function () {
        console.log('keyup');
        //var nucleo = sessionStorage.getItem("id_nucleo_admin");
        var search = this.value;
        console.log('search: ' + search);
        //console.log('nucleo: ' + nucleo);
        $.ajax({
            url: 'bd/bd_search_nucleo.php', //Jquery carrega serverside.php
            data: 'search=' + search , // Envia o valor do botão clicado 'value1='+val1+'&value2='+val2
            dataType: 'json', //escolhe o tipo de dados
            type: 'GET', //por default, mas pode ser POST
        })
            .done(function (data) {
                console.log('sucesso');

                $("#eventos_load").removeAttr("style").hide();
                if(data == ""){
                    document.getElementById("eventos_conteudo").innerHTML = "Infelizmente. Não há resultados para a sua pesquisa..";
                    document.getElementById("eventos_conteudo").style.margin= "auto";
                    document.getElementById("selector").style.left = "50%";
                    document.getElementById("interesses").style.color = "#1D1D1D";
                    document.getElementById("todos").style.color = "white";
                    document.getElementById("eventos_load").style.display = "none";

                }else{
                    createHTMLDinamyc("eventos_template", "eventos_conteudo", data);
                }

            })
            .fail(function () { // Se existir um erro no pedido
                console.log('horrores');
                $('#eventos').html('Data error'); // Escreve mensagem de erro na listagem de vinhos
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

Handlebars.registerHelper('sharehb', function (name, id) {
    const toShare = {
        title: "Partilhar evento:"+name+"",
        text: "Olha só este evento na UA chamado "+name+" !",
        url: "http://localhost/UAPPING/evento_detail.php?id_evento="+id+"" // mudar qdo for o servidor normal senao n da
    };
     const button = document.getElementById('share_'+id+'');
    $(document).on('click', '.save_share_'+id,async () => {
        console.log('click');
        try {
            await navigator.share(toShare); // Will trigger the native "share" feature
            button.textContent = 'Shared !';
        } catch (err) {
            button.textContent = 'Something went wrong';
            console.log(err);
        }
    });
});


function createHTMLDinamyc(templateId, placeID, data) {
    var raw_template = document.getElementById(templateId).innerText;
    var compiled_template = Handlebars.compile(raw_template);
    var ourGeneratedHTML = compiled_template(data);
    var place = document.getElementById(placeID);
    place.innerHTML += ourGeneratedHTML;
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

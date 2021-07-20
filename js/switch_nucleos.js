var interesses_menu;

/* ------------------ home page / pin bar (oficiais, criacoes) ------------------ */

document.getElementById("oficiais").onclick = function (){
    document.getElementById("selector").style.left = "0%";
    document.getElementById("oficiais").style.color = "white";
    document.getElementById("criacoes").style.color = "#1D1D1D";
    document.getElementById("text_nucleo_oficiais").style.display = "block";
    document.getElementById("text_nucleo_criacoes").style.display = "none";
    document.getElementById("nucleos_oficiais").style.display = "block";
    document.getElementById("nucleos_criacoes").style.display = "none";
}

document.getElementById("criacoes").onclick = function (){
    document.getElementById("selector").style.left = "50%";
    document.getElementById("oficiais").style.color = "#1D1D1D";
    document.getElementById("criacoes").style.color = "white";
    document.getElementById("text_nucleo_oficiais").style.display = "none";
    document.getElementById("text_nucleo_criacoes").style.display = "block";
    document.getElementById("nucleos_oficiais").style.display = "none";
    document.getElementById("nucleos_criacoes").style.display = "block";
}


/* ------------------ nucleos fantasma ------------------*/

$(document).ready(function () {
    $(document).on('click', ".aderir_fantasma", function () { //aderir
        //$(document).on('click', ".aderir_criacoes", function () {

        console.log('click');
        var $this = $(this);
        this.src="assets/criacoes_nucleos/aderiu_criacoes.svg";
        //$this.hide();
        //$this.next().show()

        var id = $(this).attr('id');

        $.ajax({
            url: 'bd/bd_nucleo_join.php', //Jquery carrega serverside.php
            data: 'id_nucleo=' + id, // Envia o valor do botão clicado
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

    $(document).on('click', ".aderiu_fantasma", function () { // remover
        //$(document).on('click', ".aderir_criacoes", function () {

        console.log('click');
        var $this = $(this);
        this.src="assets/criacoes_nucleos/aderir_criacoes.svg";
        //$this.hide();
        //$this.next().show()

        var id = $(this).attr('id');

        $.ajax({
            url: 'bd/bd_nucleo_quit.php', //Jquery carrega serverside.php
            data: 'id_nucleo=' + id, // Envia o valor do botão clicado
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
});


/* ------------------ interesses / btn home_page (eventos) --------------------

interesses_menu = false;
document.getElementById("btn_interesses").onclick = function (){
    if (interesses_menu === false){
        document.getElementById("panel_interesses_menu_mobile").style.display = "block";
        setTimeout(function (){
            document.getElementById("interesses_menu").style.bottom = "0";
        },10)
        document.body.style.overflow = "hidden";
        interesses_menu = true;
    }
}

document.getElementById("background_interesses_menu").onclick = function (){
    if (interesses_menu === true){
        document.getElementById("panel_interesses_menu_mobile").style.display = "none";
        document.getElementById("interesses_menu").style.bottom = "-32rem";
        document.body.style.overflow = "auto";
        interesses_menu = false;
    }
}*/
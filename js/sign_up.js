var sign_up_page;
var interesses, avancar_interesse;
var v_pass, v_email;

// CONSOANTE O DEPARTAMENTO FILTRAGEM CURSOS VIA AJAX
$(document).ready(function () {
    //.CHANGE PORQUE SENDO UM SELECTOR O VALOR ESTÁ SEMPRE A MUDAR
    $('#departamentos').on('change', function () {
        var val = $(this).val(); // PEGA NO VALOR DO DEPARTAMENTO ESCOLHIDO

        $.ajax({
            url: 'bd/bd_cursos.php', // QUERY
            data: 'departamento=' + val, // ENVIA VALOR DO BOTAO DO DEPARTAMENTO ESCOLHIDO POR QUERY STRING
            dataType: 'json', // TIPO DE DADOS
            type: 'GET', // ACHAMOS QUE ERA MAIS SIMPLES TESTAR USANDO O MÉTODO GET
        })
            .done(function (data) {
                //HANDLEBARS ARGUMENTOS
                createHTMLDinamyc("cursos_template", "cursos", data);
            })
            .fail(function () { // SE EXISTIR ERRO NO PEDIDO
                $('#selector').html('Data error'); // ESCREVE MENSAGEM
            })
        ;
        return false; // keeps the page from not refreshing
    });
});

//FUNÇÃO HANDLEBARS
function createHTMLDinamyc(templateId, placeID, data) {
    var raw_template = document.getElementById(templateId).innerText;
    var compiled_template = Handlebars.compile(raw_template);
    var ourGeneratedHTML = compiled_template(data);
    var place = document.getElementById(placeID);
    place.innerHTML = ourGeneratedHTML;
}

//PASSOS DO SIGN-UP
window.onload = function () {
    sign_up_page = 1;
    document.getElementById("submit").disabled = true;

    document.getElementById("submit").onmouseover = function () {
        if (document.getElementById("submit").disabled === false) {
            document.getElementById("submit").style.background = "linear-gradient(90deg, rgba(0,172,121,1) 0%, rgba(0,162,46,1) 100%)";
        } else {
            document.getElementById("submit").style.background = "linear-gradient(90deg, rgba(0,116,82,1) 0%, rgba(0,112,32,1) 100%)";
        }
    }

    document.getElementById("submit").onmouseout = function () {
        if (document.getElementById("submit").disabled === false) {
            document.getElementById("submit").style.background = "linear-gradient(90deg, rgba(0,205,144,1) 0%, rgba(0,195,55,1) 100%)";
        } else {
            document.getElementById("submit").style.background = "linear-gradient(90deg, rgba(0,116,82,1) 0%, rgba(0,112,32,1) 100%)";
        }
    }

    document.getElementById("header_3").style.display = "none";
    document.getElementById("header_4").style.display = "none";

    document.getElementById("nome").style.display = "block";
    document.getElementById("username").style.display = "block";
    document.getElementById("email").style.display = "block";
    document.getElementById("pass").style.display = "block";
    document.getElementById("pass_confirm").style.display = "block";

    document.getElementById("avancar_sign_up").onclick = function () {
        sign_up("avancar");
    }

    document.getElementById("voltar_sign_up").onclick = function () {
        sign_up("recuar");
    }

    document.getElementById("d2").onclick = function () {
        if (document.getElementById("submit").disabled === true) {
            document.getElementById("submit").disabled = false;
            document.getElementById("submit").style.background = "linear-gradient(90deg, rgba(0,205,144,1) 0%, rgba(0,195,55,1) 100%)";
        } else {
            document.getElementById("submit").disabled = true;
            document.getElementById("submit").style.background = "linear-gradient(90deg, rgba(0,116,82,1) 0%, rgba(0,112,32,1) 100%)";
        }
    }

    function interesses_check(interesses){
        if (document.getElementById("interesse_" + interesses).checked === true){
            avancar_interesse = true;
        }
    }

    function verify_pass(){
        if (document.getElementById("pass").value == ""){
            document.getElementById("pass").style.backgroundColor = "#ff6161";
            document.getElementById("feedback_pass_verify").innerHTML = "Password inválida";
            v_pass = false;
        } else if (document.getElementById("pass_confirm").value != document.getElementById("pass").value){
            document.getElementById("pass").style.backgroundColor = "white";
            document.getElementById("pass_confirm").style.backgroundColor = "#ff6161";
            document.getElementById("feedback_pass_verify").innerHTML = "Confirmação da password inválida";
            v_pass = false;
        } else{
            document.getElementById("pass").style.backgroundColor = "white";
            document.getElementById("pass_confirm").style.backgroundColor = "white";
            v_pass = true;
            document.getElementById("feedback_pass").style.display = "none";
        }
    }

    function verify_mail(){
        if (document.getElementById("email").value.indexOf("@ua.pt") != -1){
            v_email = true;
            document.getElementById("feedback_email").style.display = "none";
        } else{
            document.getElementById("feedback_email_verify").innerHTML = "Insere um email da UA válido";
            v_email = false;
        }
    }

    function sign_up(direct) {
        if (direct === "avancar") {
            switch (sign_up_page) {
                case 1:
                    verify_mail();
                    verify_pass();
                    if (v_pass === true && v_email === true){
                        v_pass = false;
                        v_email = false;
                        document.getElementById("nome").style.display = "none";
                        document.getElementById("nome_icon").style.display = "none";
                        document.getElementById("username").style.display = "none";
                        document.getElementById("username_icon").style.display = "none";
                        document.getElementById("email").style.display = "none";
                        document.getElementById("email_icon").style.display = "none";
                        document.getElementById("pass").style.display = "none";
                        document.getElementById("pass_icon").style.display = "none";
                        document.getElementById("pass_confirm").style.display = "none";
                        document.getElementById("feedback_pass").style.display = "none";
                        document.getElementById("feedback_email").style.display = "none";
                        document.getElementById("header_1").style.display = "none";

                        document.getElementById("departamentos").style.display = "inline-block";
                        document.getElementById("cursos").style.display = "inline-block";

                        document.getElementById("header_3").style.display = "block";
                        document.getElementById("header_6").innerHTML = "Insere os teus";
                        document.getElementById("header_3").innerHTML = "Dados da UA";
                        sign_up_page = 2;
                    } else{
                        if (v_pass != true){
                            document.getElementById("feedback_pass").style.display = "block";
                        }
                        if (v_email != true){
                            document.getElementById("feedback_email").style.display = "block";
                        }

                    }
                    break;
                case 2:
                    document.getElementById("departamentos").style.display = "none";
                    document.getElementById("cursos").style.display = "none";

                    document.getElementById("interesses_card").style.display = "flex";

                    document.getElementById("header_6").innerHTML = "Seleciona os teus";
                    document.getElementById("header_3").innerHTML = "interesses";
                    sign_up_page = 3;

                    break;
                case 3:
                    // NÃO DEIXA AVANÇAR SEM ESCOLHER UM INTERESSE PELO MENOS
                    for (interesses = 1; interesses <= 5; interesses++) {
                        switch (interesses){
                            case 1: interesses_check(interesses); break;
                            case 2: interesses_check(interesses); break;
                            case 3: interesses_check(interesses); break;
                            case 4: interesses_check(interesses); break;
                            case 5: interesses_check(interesses); break;
                        }
                    }
                    if(avancar_interesse === true){
                        avancar_interesse = false;
                        document.getElementById("termos_sign_up").style.display = "flex";
                        document.getElementById("submit").style.display = "block";
                        document.getElementById("avancar_sign_up").style.display = "none";
                        document.getElementById("check_2").style.display = "block";
                        document.getElementById("interesses_card").style.display = "none";
                        document.getElementById("feedback_interesses").style.display = "none";

                        document.getElementById("header_6").style.display = "none";
                        document.getElementById("header_3").style.display = "none";
                        document.getElementById("header_4").style.display = "block";
                        document.getElementById("header_4").innerHTML = "Termos";

                        sign_up_page = 4;
                    } else{
                        document.getElementById("feedback_interesses").style.display = "block";
                    }
                    break;
            }
        } else {
            switch (sign_up_page) {
                case 1:
                    window.location.href = 'index.php';
                case 2:
                    document.getElementById("nome").style.display = "block";
                    document.getElementById("nome_icon").style.display = "block";
                    document.getElementById("username").style.display = "block";
                    document.getElementById("username_icon").style.display = "block";
                    document.getElementById("email").style.display = "block";
                    document.getElementById("email_icon").style.display = "block";
                    document.getElementById("pass").style.display = "block";
                    document.getElementById("pass_icon").style.display = "block";
                    document.getElementById("pass_confirm").style.display = "block";

                    document.getElementById("departamentos").style.display = "none";
                    document.getElementById("cursos").style.display = "none";

                    document.getElementById("header_1").style.display = "block";
                    document.getElementById("header_6").innerHTML = "Cria a tua conta";
                    document.getElementById("header_3").style.display = "none";

                    sign_up_page = 1;

                    break;
                case 3:
                    document.getElementById("departamentos").style.display = "inline-block";
                    document.getElementById("cursos").style.display = "inline-block";
                    document.getElementById("interesses_card").style.display = "none";
                    document.getElementById("feedback_interesses").style.display = "none";

                    document.getElementById("header_6").innerHTML = "Insere os teus";
                    document.getElementById("header_3").innerHTML = "Dados da UA";
                    document.getElementById("avancar_sign_up").disabled = false;

                    sign_up_page = 2;
                    break;
                case 4:
                    document.getElementById("termos_sign_up").style.display = "none";
                    document.getElementById("submit").style.display = "none";
                    document.getElementById("avancar_sign_up").style.display = "block";
                    document.getElementById("check_2").style.display = "none";

                    document.getElementById("interesses_card").style.display = "flex";

                    document.getElementById("header_6").style.display = "block";
                    document.getElementById("header_3").style.display = "block";
                    document.getElementById("header_4").style.display = "none";
                    document.getElementById("header_6").innerHTML = "Seleciona os teus";
                    document.getElementById("header_3").innerHTML = "interesses";
                    sign_up_page = 3;
                    break;
            }
        }
    }
}
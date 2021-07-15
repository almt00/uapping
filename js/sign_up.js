var sign_up_page;
var check;

$(document).ready(function () {
    $('#departamentos').on('change', function () {
        var val = $(this).val();

        $.ajax({
            url: 'components/bd_cursos.php', //Jquery carrega serverside.php
            data: 'departamento=' + val, // Envia o valor do botão clicado
            dataType: 'json', //escolhe o tipo de dados
            type: 'GET', //por default, mas pode ser POST
        })
            .done(function (data) {

                createHTMLDinamyc("cursos_template", "cursos", data);

            })
            .fail(function () { // Se existir um erro no pedido
                $('#selector').html('Data error'); // Escreve mensagem de erro na listagem de vinhos
            })
        ;
        return false; // keeps the page from not refreshing
    });
});


function createHTMLDinamyc(templateId, placeID, data) {
    var raw_template = document.getElementById(templateId).innerText;
    var compiled_template = Handlebars.compile(raw_template);
    var ourGeneratedHTML = compiled_template(data);
    var place = document.getElementById(placeID);
    place.innerHTML = ourGeneratedHTML;
}

window.onload = function () {
    sign_up_page = 1;
    check = false;
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

    document.getElementById("d1").onclick = function () {
        if (check === false) {
            document.getElementById("credenciais").style.display = "block";
            check = true;
        } else {
            document.getElementById("credenciais").style.display = "none";
            document.getElementById("credenciais").value = "";
            check = false;
        }
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

    function sign_up(direct) {
        if (direct === "avancar") {
            switch (sign_up_page) {
                case 1:
                    document.getElementById("nome").style.display = "none";
                    document.getElementById("nome_icon").style.display = "none";
                    document.getElementById("username").style.display = "none";
                    document.getElementById("username_icon").style.display = "none";
                    document.getElementById("email").style.display = "none";
                    document.getElementById("email_icon").style.display = "none";
                    document.getElementById("pass").style.display = "none";
                    document.getElementById("pass_icon").style.display = "none";
                    document.getElementById("pass_confirm").style.display = "none";
                    document.getElementById("header_1").style.display = "none";

                    document.getElementById("departamentos").style.display = "inline-block";
                    document.getElementById("cursos").style.display = "inline-block";
                    document.getElementById("hr_meca").style.display = "block";
                    document.getElementById("check").style.display = "block";

                    document.getElementById("header_3").style.display = "block";
                    document.getElementById("header_6").innerHTML = "Insere os teus";
                    document.getElementById("header_3").innerHTML = "Dados da UA";
                    sign_up_page = 2;
                    break;
                case 2:
                    document.getElementById("departamentos").style.display = "none";
                    document.getElementById("cursos").style.display = "none";
                    document.getElementById("hr_meca").style.display = "none";
                    document.getElementById("check").style.display = "none";
                    document.getElementById("credenciais").style.display = "none";

                    document.getElementById("interesses_card").style.display = "flex";

                    document.getElementById("header_6").innerHTML = "Seleciona os teus";
                    document.getElementById("header_3").innerHTML = "interesses";
                    sign_up_page = 3;

                    break;
                case 3:
                    document.getElementById("termos_sign_up").style.display = "flex";
                    document.getElementById("submit").style.display = "block";
                    document.getElementById("avancar_sign_up").style.display = "none";
                    document.getElementById("check_2").style.display = "block";
                    document.getElementById("interesses_card").style.display = "none";

                    document.getElementById("header_6").style.display = "none";
                    document.getElementById("header_3").style.display = "none";
                    document.getElementById("header_4").style.display = "block";
                    document.getElementById("header_4").innerHTML = "Termos";

                    sign_up_page = 4;
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
                    document.getElementById("hr_meca").style.display = "none";
                    document.getElementById("check").style.display = "none";

                    document.getElementById("header_1").style.display = "block";
                    document.getElementById("header_6").innerHTML = "Cria a tua conta";
                    document.getElementById("header_3").style.display = "none";

                    sign_up_page = 1;

                    break;
                case 3:
                    document.getElementById("departamentos").style.display = "inline-block";
                    document.getElementById("cursos").style.display = "inline-block";
                    document.getElementById("hr_meca").style.display = "block";
                    document.getElementById("check").style.display = "block";
                    document.getElementById("interesses_card").style.display = "none";

                    document.getElementById("header_6").innerHTML = "Insere os teus";
                    document.getElementById("header_3").innerHTML = "Dados da UA";
                    document.getElementById("avancar_sign_up").disabled = false;
                    if (check === true) {
                        document.getElementById("credenciais").style.display = "block";
                    }
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
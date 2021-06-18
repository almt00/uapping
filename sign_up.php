<!DOCTYPE html>
<html lang="pt">
<head>

    <title> Uapping </title>
    <?php include_once "helpers/help_css.php"?>

    <?php include_once "helpers/help_meta.php"?>

</head>
<body class="background_roxo">

<main class="container-fluid overflow-hidden">
    <section class="row justify-content-center align-items-center mt-5 mt-md-5">
        <article class="col-md-12 text-md-center">
            <h1 id="header_1" class="sign-up-h1"> Bem Vindo! </h1>
            <h6 id="header_6" class="sign-up-h6"> Cria a tua conta </h6>
            <h1 id="header_3" class="sign-up-h1"> </h1>
            <h1 id="header_4" class="sign-up-h4"> </h1>
        </article>
    </section>

   <section class="row justify-content-center mt-3 mt-md-3">
       <article class="col-md-6">
           <form action="home_page.php" method="post" id="sign_up">
               <section class="row justify-content-center form-section">
                    <article class="col-12">
                        <input id="nome" required="required" class="input_sign_up mb-3 mb-md-3" type="text" name="nome" size="24" placeholder="nome completo">
                        <input id="username" required="required" class="input_sign_up mb-3 mb-md-3" type="text" name="username" size="24" placeholder="username">
                        <input id="email" required="required" class="input_sign_up mb-3 mb-md-3" type="email" name="email" size="24" placeholder="email">
                        <input id="pass" required="required" class="input_sign_up mb-3 mb-md-3" type="password" name="pass" size="24" placeholder="password">
                        <input id="pass_confirm" required="required" class="input_sign_up mb-3 mb-md-3" type="password" name="pass_confirm" size="24" placeholder="confirma a password">
                        <select required="required" class="custom-select select_sign_up mb-3 mb-md-3" id="departamentos" name="departamento" form="sign_up">
                            <option value> Departamentos </option>
                            <option value="24"> Ambiente e Ordenamento </option>
                            <option value="1"> Biologia </option>
                            <option value="3"> Ciências Médicas </option>
                            <option value="4"> Ciências Sociais, Politicas e do Território </option>
                            <option value="5"> Comunicação e Arte </option>
                            <option value="6"> Economia, Gestão, Engenharia Industrial e Turismo </option>
                            <option value="7"> Educação e Psicologia </option>
                            <option value="10"> Eletrónica, Telecomunicações e Informática </option>
                            <option value="12"> Engenharia Civil </option>
                            <option value="15"> Engenharia de Materiais e Cerâmica </option>
                            <option value="16"> Engenharia Mecânica </option>
                            <option value="17"> Física </option>
                            <option value="18"> Geociências </option>
                            <option value="19"> Línguas e Culturas </option>
                            <option value="20"> Matemática </option>
                            <option value="21"> Química </option>
                            <option value="22"> Escola Superior de Design, Gestão e Tecnologia da Produção </option>
                            <option value="23"> Escola Superior de Saúde </option>
                        </select>
                        <select required="required" class="custom-select select_sign_up mb-2 mb-md-2" id="cursos" name="curso" form="sign_up">
                            <option value> Cursos </option>
                            <option value="1"> Música </option>
                            <option value="3"> Novas Tecnologias da Comunicação </option>
                            <option value="4"> Design </option>
                        </select>
                        <div id="hr_meca" class="border_bottom_meca"></div>
                        <label id="check" class="box"> Já pertenço à direção de um núcleo
                            <input type="checkbox" id="d1">
                            <span class="checkmark-1"></span>
                        </label>
                        <input id="credenciais" class="input_sign_up mt-3 mt-md-3" type="text" name="credenciais" size="24" placeholder="credenciais">

                        <section class="row" id="interesses">
                            <article class="col-12">
                                <section class="row justify-content-center">
                                    <article class="col-6 check-interesse check-int-1 text-left">
                                        <input type="checkbox">
                                    </article>
                                    <article class="col-6 check-interesse check-int-2 text-right">
                                        <input type="checkbox">
                                    </article>
                                </section>
                                <section class="row justify-content-center mt-3">
                                    <article class="col-6 check-interesse check-int-3 text-left">
                                        <input type="checkbox">
                                    </article>
                                    <article class="col-6 check-interesse check-int-4 text-right">
                                        <input type="checkbox">
                                    </article>
                                </section>
                                <section class="row justify-content-center mt-3">
                                    <article class="col-6 check-interesse check-int-5 text-left">
                                        <input type="checkbox">
                                    </article>
                                    <article class="col-6 check-interesse text-right">
                                    </article>
                                </section>
                            </article>
                        </section>
                        <section id="termos_sign_up" class="row justify-content-center">
                            <article class="col-9 col-md-12">
                                <p class="termos_info text-justify"> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                                    do eiusmod tempor incididunt ut labore et dolore magna aliqua. Elementum facilisis leo vel
                                    fringilla. Volutpat ac tincidunt vitae semper quis lectus. Convallis tellus id interdum velit.
                                    Non diam phasellus vestibulum lorem sed risus ultricies tristique. Semper auctor neque vitae
                                    tempus. Dui id ornare arcu odio ut sem. Elementum nibh tellus molestie nunc non. Egestas quis
                                    ipsum suspendisse ultrices gravida dictum fusce ut. Ac ut consequat semper viverra. </p>

                            </article>
                        </section>
                        <label id="check_2" class="box-2"> Concordo com os termos <br> de utilização e privacidade
                            <input type="checkbox" id="d2">
                            <span class="checkmark"></span>
                        </label>
                    </article>
               </section>
               <section class="row justify-content-center mt-3 mt-md-3">
                   <article class="col-md-12 mt-5 mt-md-5">
                       <input type="submit" class="mb-2 mb-md-2" value="Enviar" id="submit">
                       <button id="avancar_sign_up" class="mb-2 mb-md-2" type="button"> Avançar </button>
                       <button id="voltar_sign_up" type="button"> Voltar </button>
                   </article>
               </section>
           </form>
       </article>
    </section>
</main>

<script src="js/sign_up.js"></script>

</body>
</html>

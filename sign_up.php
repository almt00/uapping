<!DOCTYPE html>
<html lang="pt">
<head>

    <?php include_once "helpers/help_css.php" ?>

    <?php include_once "helpers/help_meta.php" ?>

    <?php include_once "helpers/help_js.php" ?>

</head>
<body class="background_roxo">

<main class="container-fluid overflow-hidden">
    <section class="row justify-content-center align-items-center mt-5 mt-md-5">
        <article class="col-12 text-md-center">
            <div class="div-icons-sign-up">
                <h1 id="header_1" class="sign-up-h1"> Bem Vindo! </h1>
                <h6 id="header_6" class="sign-up-h6"> Cria a tua conta </h6>
                <h1 id="header_3" class="sign-up-h1"></h1>
                <h1 id="header_4" class="sign-up-h4"></h1>
            </div>
        </article>
    </section>

    <section class="row justify-content-center mt-3 mt-md-3">
        <article class="col-md-6">
            <form action="scripts/sc_registo.php" method="post" id="sign_up">
                <section class="row justify-content-center form-section">
                    <article class="col-12 px-4">
                        <div class="div-icons-sign-up text-center position-relative">
                            <img id="nome_icon" class="icon-sign_up_1" src="assets/img/input_profile_icon.svg"
                                 alt="profile_icon">
                            <img id="username_icon" class="icon-sign_up_2" src="assets/img/input_profile_icon.svg"
                                 alt="profile_icon">
                            <img id="email_icon" class="icon-sign_up_3" src="assets/img/input_mail_icon.svg"
                                 alt="profile_icon">
                            <img id="pass_icon" class="icon-sign_up_4" src="assets/img/input_pass_icon.svg"
                                 alt="profile_icon">
                        </div>
                        <input id="nome" required="" class="input_sign_up mb-3 mb-md-3" type="text" name="nome"
                               size="24" placeholder="nome completo">
                        <input id="username" required="" class="input_sign_up mb-3 mb-md-3" type="text"
                               name="username" size="24" placeholder="username">
                        <input id="email" required="" class="input_sign_up mb-3 mb-md-3" type="email"
                               name="email" size="24" placeholder="exemplo@ua.pt">
                        <input id="pass" required="" class="input_sign_up mb-3 mb-md-3" type="password"
                               name="pass" size="24" placeholder="password">
                        <input id="pass_confirm" required="" class="input_sign_up mb-3 mb-md-3" type="password"
                               name="pass_confirm" size="24" placeholder="confirma a password">
                        <select required="" class="custom-select select_sign_up mb-3 mb-md-3" id="departamentos"
                                name="departamento" form="sign_up">
                            <option value="0" >Seleciona departamento</option>
                            <?php
                            require_once "connections/connection.php";
                            $link = new_db_connection();
                            $stmt = mysqli_stmt_init($link);
                            $query = "SELECT id_departamento, nome_departamento FROM departamentos";
                            if (mysqli_stmt_prepare($stmt, $query)) {
                                if (mysqli_stmt_execute($stmt)) {
                                    mysqli_stmt_bind_result($stmt, $id_departamento, $nome_departamento);
                                    while (mysqli_stmt_fetch($stmt)) {
                                        echo '<option value="' . $id_departamento . '">' . $nome_departamento . '</option>';
                                    }
                                } else {
                                    echo "Error:" . mysqli_stmt_error($stmt);
                                }
                                mysqli_stmt_close($stmt);
                            } else {
                                echo("Error description: " . mysqli_error($link));
                            }
                            ?>
                        </select>
                        <select required="required" class="custom-select select_sign_up mb-2 mb-md-2" id="cursos"
                                name="curso" form="sign_up">
                            <option value="0">Cursos</option>


                            <?php
                            /*
                            $stmt = mysqli_stmt_init($link);
                            $query = "SELECT id_curso, nome_curso, ref_id_departamento FROM cursos";
                            if (mysqli_stmt_prepare($stmt, $query)) {
                                if (mysqli_stmt_execute($stmt)) {
                                    mysqli_stmt_bind_result($stmt, $id_curso, $nome_curso, $ref_id_departamento);
                                    while (mysqli_stmt_fetch($stmt)) {*/

                            //echo '<option value="' . $id_curso . '"> ' . $nome_curso . '</option>';
                            /*}
                        } else {
                            echo "Error:" . mysqli_stmt_error($stmt);
                        }
                        mysqli_stmt_close($stmt);
                    } else {
                        echo("Error description: " . mysqli_error($link));
                    }*/
                            ?>
                        </select>

                        <section class="row" id="interesses_card">
                            <article class="col-12">
                                <section class="row justify-content-center">
                                    <?php
                                    $stmt = mysqli_stmt_init($link);
                                    $query = "SELECT id_interesse, nome_interesse, icone_interesse FROM interesses";
                                    if (mysqli_stmt_prepare($stmt, $query)) {
                                        if (mysqli_stmt_execute($stmt)) {
                                            mysqli_stmt_bind_result($stmt, $id_interesse, $nome_interesse, $icone_interesse);
                                            while (mysqli_stmt_fetch($stmt)) {
                                                ?>
                                                <article
                                                        class="col-6 check-interesse text-left mb-3 check-int-<?= $id_interesse ?>">
                                                    <input name="interesses[]" id='interesse_<?= $id_interesse ?>'
                                                           type="checkbox" value='<?= $id_interesse ?>'>
                                                </article>

                                                <!--<article class="col-6 check-interesse text-left mb-3"
                                                         style='background-image: url("assets/img/<?/*= $icone_interesse */ ?>"); background-repeat: no-repeat'>
                                                    <input id='interesse_<?/*=$id_interesse*/ ?>' type="checkbox" value='<?/*= $id_interesse */ ?>' >
                                                </article>-->
                                                <?php
                                            }
                                        } else {
                                            echo "Error:" . mysqli_stmt_error($stmt);
                                        }
                                        mysqli_stmt_close($stmt);
                                    } else {
                                        echo("Error description: " . mysqli_error($link));
                                    }
                                    mysqli_close($link);
                                    ?>
                                    <!-- <article class="col-6 check-interesse check-int-1 text-left">
                                         <input type="checkbox" value=$id_interesse>
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
                                 </section>-->

                            </article>
                        </section>
                        <section class="row">
                            <article class="col-12">
                                <div id="feedback_interesses" style="display: none;" class="text-center alert alert-danger p-2 m-3"><p class="text-dark m-0">Selecione pelo menos um interesse!</p></div>
                            </article>
                        </section>

                        <section id="termos_sign_up" class="row justify-content-center">
                            <article class="col-11 col-md-12">
                                <p class="termos_info text-justify"> Lorem ipsum dolor sit amet, consectetur adipiscing
                                    elit, sed
                                    do eiusmod tempor incididunt ut labore et dolore magna aliqua. Elementum facilisis
                                    leo vel
                                    fringilla. Volutpat ac tincidunt vitae semper quis lectus. Convallis tellus id
                                    interdum velit.
                                    Non diam phasellus vestibulum lorem sed risus ultricies tristique. Semper auctor
                                    neque vitae
                                    tempus. Dui id ornare arcu odio ut sem. Elementum nibh tellus molestie nunc non.
                                    Egestas quis
                                    ipsum suspendisse ultrices gravida dictum fusce ut. Ac ut consequat semper
                                    viverra. </p>

                            </article>
                        </section>
                        <label id="check_2" class="box-2"> Concordo com os termos <br> de utilização e privacidade
                            <input type="checkbox" id="d2">
                            <span class="checkmark"></span>
                        </label>
                    </article>
                </section>
                <section class="row justify-content-center mt-3 mt-md-3">
                    <article class="col-md-12 mt-5 mt-md-5 px-4">
                        <input type="submit" class="mb-2 mb-md-2" value="Enviar" id="submit">
                        <button id="avancar_sign_up" class="mb-2 mb-md-2" type="button"> Avançar</button>
                        <button id="voltar_sign_up" class="mb-5" type="button"> Voltar</button>
                    </article>
                </section>
            </form>
        </article>
    </section>
</main>

<script id="cursos_template" type="text/x-handlebars-template">
    {{#each this}}
    <option id="selector" value="{{id_curso}}">{{nome_curso}}</option>
    {{/each}}
</script>

<script src="js/sign_up.js"></script>

</body>
</html>

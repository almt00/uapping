<!DOCTYPE html>
<html lang="pt">
<head>

    <?php include_once "helpers/help_css.php" ?>

    <?php include_once "helpers/help_meta.php" ?>

</head>
<body class="background_roxo">

<main class="container-fluid overflow-hidden">
    <section class="row justify-content-center align-items-center mt-5 mt-md-5">
        <article class="col-12 text-center">
            <img class="logo-text-log-in" src="assets/img/logo_texto_branco.svg">
            <img class="logo-icon-log-in" src="assets/img/logo_icon.svg">
        </article>
        <article class="col-12 text-md-center">
            <div class="div-icons-sign-up">
                <h2 class="log-in-h2"> Iniciar Sessão </h2>
            </div>
        </article>
    </section>

    <section class="row justify-content-center mt-3 mt-md-3">
        <article class="col-md-6">
            <form action="scripts/sc_login.php" method="post" id="sign_up">
                <section class="row justify-content-center">
                    <article class="col-12 px-4">
                        <div class="div-icons-sign-up text-center position-relative">
                            <img id="email_icon" class="icon-sign_up_1" src="assets/img/input_profile_icon.svg"
                                 alt="profile_icon">
                            <img id="pass_icon" class="icon-sign_up_2" src="assets/img/input_pass_icon.svg"
                                 alt="profile_icon">
                        </div>
                        <input id="email" required="" style="display:block;" class="input_sign_up mb-3 mb-md-3"
                               type="email"
                               name="email" size="24" placeholder="email">
                        <input id="pass" required="" style="display:block;" class="input_sign_up mb-3 mb-md-3"
                               type="password"
                               name="pass" size="24" placeholder="password">
                        <?php
                        if (isset($_GET['msg'])) {
                            switch ($_GET['msg']) {
                                case 1:
                                    echo '<div class="text-center"><p class="text-warning" >A password está errada, por favor tenta novamente!</p></div>';
                                    break;
                                case 2:
                                    echo '<div class="text-center"><p class="text-warning">O email que inseriste ainda não está registado, por favor tenta novamente!</p></div>';
                            }
                        }
                        ?>
                    </article>

                </section>
                <section class="row justify-content-center mt-3 mt-md-3">
                    <article class="col-md-12 mt-5 mt-md-5 px-4">
                        <input type="submit" class="mb-2 mb-md-2"
                               style="display:block;background: linear-gradient(90deg, rgba(0,205,144,1) 0%, rgba(0,195,55,1) 100%);"
                               value="Entrar" id="submit">
                        <button id="voltar_sign_up" class="mb-5" type="button"> Voltar</button>
                    </article>
                </section>
            </form>
        </article>
    </section>
</main>

<script>
    document.getElementById("voltar_sign_up").onclick = function () {
        window.location.href = 'index.php';
    }
</script>

</body>
</html>

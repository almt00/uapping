<?php
session_start();
if (!isset($_SESSION['id_user']) || $_SESSION['id_user']==null) {
    header("Location: index.php");
}
?>

<main class="container-fluid main-flex overflow-hidden">
    <section class="row">
        <article class="col-12">
            <section class="row sec-top-nucleos">
                <article class="col-12 section-search-home-page">
                    <section class="row justify-content-center">
                        <article class="col-12 px-4">
                        </article>
                    </section>
                </article>
            </section>
            <section class="row section-criar-nucleo justify-content-center mt-0">
                <article class="col-12 mt-4 mb-3 position-relative">
                    <h2 class="text-center h2-nucleo_save"> Alterar Password </h2>
                </article>
                <article class="col-12 px-4">
                    <form action="scripts/sc_mudar_password.php" method="post" id="mudar_password">
                        <section class="row justify-content-center">
                            <article class="col-12">
                                <div class="div-icons-sign-up text-center position-relative">
                                    <img id="username_icon" class="icon-novo_admin_1" src="assets/img/input_pass_icon.svg"
                                         alt="profile_icon">
                                    <img id="email_icon" class="icon-novo_admin_2" src="assets/img/input_pass_icon.svg"
                                         alt="profile_icon">
                                </div>
                                <input id="password_verify" class="input_novo_admin mb-3 mb-md-3" type="password" name="password_verify"
                                       size="24" placeholder="password atual" required="required">
                                <input id="password_nova" class="input_novo_admin mb-3 mb-md-3" type="password"
                                       name="password_nova" size="24" placeholder="password nova" required="required">
                                <?php
                                if (isset($_GET['msg'])) {
                                    switch ($_GET['msg']) {
                                        case 1:
                                            echo '<p class="" style="color: red">A password está errada, por favor tenta novamente!</p>';
                                            break;
                                    }
                                }
                                ?>
                            </article>
                        </section>
                        <section class="row mt-4 mb-5">
                            <article class="col-12 text-center">
                                <img class="img-fluid" src="assets/mudar_pass.svg">
                            </article>
                        </section>
                        <section class="row justify-content-center mt-3 mt-md-3">
                            <article class="col-md-12 mt-3 mt-md-5 px-4">
                                <input form="mudar_password" type="submit" class="mb-2 mb-md-2" style="display: block;"
                                       value="salvar" id="criar_nucleo_submit">
                                <button id="cancelar_criar_nucleo" class="mb-5" type="button"> cancelar</button>
                            </article>
                        </section>
                    </form>
                </article>
            </section>
        </article>
    </section>
    <?php include_once "components/cp_footer.php"?>
</main>

<script>
    document.getElementById("cancelar_criar_nucleo").onclick = function () {
        window.history.back();
    }
</script>
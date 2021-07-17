<main class="container-fluid main-flex overflow-hidden">
    <section class="row">
        <article class="col-12">
            <section class="row sec-top-nucleos">
                <article class="col-12 section-search-home-page-admin">
                    <section class="row justify-content-center">
                        <article class="col-12 px-4">
                        </article>
                    </section>
                </article>
            </section>
            <section class="row section-criar-nucleo justify-content-center">
                <article class="col-12 mt-4 mb-3 position-relative">
                    <h2 class="text-center h2-nucleo_save"> Novo administrador </h2>
                </article>
                <article class="col-12 px-4">
                    <form action="scripts/sc_novo_admin.php" method="post" id="novo_admin">
                        <section class="row justify-content-center">
                            <article class="col-12">
                                <div class="div-icons-sign-up text-center position-relative">
                                    <img id="username_icon" class="icon-novo_admin_1"
                                         src="assets/img/input_profile_icon.svg"
                                         alt="profile_icon">
                                    <img id="email_icon" class="icon-novo_admin_2" src="assets/img/input_mail_icon.svg"
                                         alt="profile_icon">
                                </div>
                                <input id="nome" class="input_novo_admin mb-3 mb-md-3" type="text" name="username"
                                       size="24" placeholder="username" required="required">
                                <input id="email" class="input_novo_admin mb-3 mb-md-3" type="email"
                                       name="email" size="24" placeholder="email" required="required">
                                <?php
                                if (isset($_GET['msg']) && $_GET['msg'] != null) {
                                    if ($_GET['msg'] == 1) {
                                        echo '<div class="text-center"><p class="text-warning">O username e o email inseridos não correspondem</p></div>';
                                    }
                                }
                                ?>
                            </article>
                        </section>
                        <section class="row mt-4 mb-5">
                            <article class="col-12 text-center">
                                <img class="img-fluid" src="assets/asset_novo_admin.svg">
                            </article>
                        </section>
                        <section class="row justify-content-center mt-3 mt-md-3">
                            <article class="col-md-12 mt-3 mt-md-5 px-4">
                                <input form="novo_admin" type="submit" class="mb-2 mb-md-2" style="display: block;"
                                       value="adicionar" id="criar_nucleo_submit">
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
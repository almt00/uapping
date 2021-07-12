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
                    <form action="scripts/sc_criar_nucleo.php" method="post" id="criar_nucleo">
                        <section class="row justify-content-center">
                            <article class="col-12">
                                <div class="div-icons-sign-up text-center position-relative">
                                    <img id="username_icon" class="icon-novo_admin_1" src="assets/img/input_profile_icon.svg"
                                         alt="profile_icon">
                                    <img id="email_icon" class="icon-novo_admin_2" src="assets/img/input_mail_icon.svg"
                                         alt="profile_icon">
                                </div>
                                <input id="nome" class="input_novo_admin mb-3 mb-md-3" type="text" name="username"
                                       size="24" placeholder="username" required="required">
                                <input id="email" class="input_novo_admin mb-3 mb-md-3" type="email"
                                       name="email" size="24" placeholder="email" required="required">
                            </article>
                        </section>
                        <section class="row mt-4 mb-5">
                            <article class="col-12 text-center">
                                <img class="img-fluid" src="assets/asset_novo_admin.svg">
                            </article>
                        </section>
                        <section class="row justify-content-center mt-3 mt-md-3">
                            <article class="col-md-12 mt-3 mt-md-5 px-4">
                                <input form="criar_nucleo" type="submit" class="mb-2 mb-md-2" style="display: block;"
                                       value="adicionar" id="criar_nucleo_submit">
                                <button id="cancelar_criar_nucleo" class="mb-5" type="button"> cancelar</button>
                            </article>
                        </section>
                    </form>
                </article>
            </section>
        </article>
    </section>
    <footer class="row justify-content-center py-5">
        <article class="col-3 text-center">
            <a href="https://www.facebook.com/" target="_blank"> <span
                        class="fab fa-facebook-f text-white fa-3x"></span> </a>
        </article>
        <article class="col-3 text-center mw-6rem">
            <a href="https://twitter.com/" target="_blank"> <span class="fab fa-twitter text-white fa-3x"></span> </a>
        </article>
        <article class="col-3 text-center">
            <a href="https://www.instagram.com/" target="_blank"> <span
                        class="fab fa-instagram text-white fa-3x"></span> </a>
        </article>
    </footer>
</main>

<script>
    document.getElementById("cancelar_criar_nucleo").onclick = function () {
        window.location.href = "home_page.php";
    }
</script>
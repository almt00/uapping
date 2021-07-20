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
            <section class="row section-criar-nucleo justify-content-center">
                <article class="col-12 mt-5 mb-3 position-relative">
                    <h2 id="title_sucesso" class="text-center h2-nucleo_save mb-4"> ERRO 404 </h2>
                </article>
                <article class="col-12 px-4">
                        <section class="row justify-content-center mb-5">
                            <article class="col-12 text-center">
                                <p class="mb-4" id="sucesso_text"> Ups parece que aconteceu algum problema. Estamos a trabalhar para o resolver
                                </p>
                                <img id="img_f1" class="img-fluid px-3 my-4" src="assets/asset_error.svg">
                            </article>
                        </section>
                    <section id="avancar_sucesso" class="row justify-content-center mt-3 mt-md-3">
                        <article class="col-12 mt-3 mt-md-5 px-4">
                            <button id="avancar_add_sucesso" class="mb-2 mb-md-2" type="button"> Voltar </button>
                        </article>
                    </section>
                </article>
            </section>
        </article>
    </section>
    <?php include_once "components/cp_footer.php"?>
</main>

<script>
    document.getElementById("avancar_add_sucesso").onclick = function (){
        window.history.back();
    }
</script>
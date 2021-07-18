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
                    <h2 id="title_sucesso" class="text-center h2-nucleo_save"> Sucesso </h2>
                </article>
                <article class="col-12 px-4">
                        <section class="row justify-content-center">
                            <article class="col-12 text-center">
                                <p id="sucesso_text"> A tua proposta vai ser analisada. <br>
                                    Assim que possível vais
                                    receber mais informações!
                                </p>
                                <img id="img_f1" class="img-fluid px-3 my-4" src="assets/asset_criar_nucleo.svg">
                                <img id="img_f2" class="img-fluid px-3 my-4" src="assets/asset_criar_nucleo_2.svg" style="display:none;">
                            </article>
                        </section>
                    <section id="add_fim" class="row justify-content-center mt-3 mt-md-3" style="display:none;">
                        <article class="col-6 mt-3 mt-md-5 pl-4 pr-3">
                            <button id="info_fim" class="mb-2 mb-md-2" type="button"> +Info </button>
                        </article>
                        <article class="col-6 mt-3 mt-md-5 pr-4 pl-3">
                            <button id="avancar_fim" class="mb-2 mb-md-2" type="button"> Avançar </button>
                        </article>
                    </section>
                    <section id="avancar_sucesso" class="row justify-content-center mt-3 mt-md-3">
                        <article class="col-12 mt-3 mt-md-5 px-4">
                            <button id="avancar_add_sucesso" class="mb-2 mb-md-2" type="button"> Avançar</button>
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
        document.getElementById("title_sucesso").innerHTML = "Queres saber mais sobre a criação de núcleos na UA?";
        document.getElementById("sucesso_text").style.display = "none";
        document.getElementById("img_f1").style.display = "none";
        document.getElementById("img_f2").style.display = "inline";
        document.getElementById("avancar_sucesso").style.display = "none";
        document.getElementById("add_fim").style.display = "flex";
    }

    document.getElementById("avancar_fim").onclick = function (){
        window.location.href = "home_page.php";
    }

    document.getElementById("info_fim").onclick = function (){
        window.location.href = "faq.php";
    }
</script>
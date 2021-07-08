<?php require_once("connections/connection.php"); ?>
<main class="main background_cinza container-fluid main-flex">
    <section class="row">
        <article class="col-12">
            <section class="row section-search-home-page">
                <article class="col-12">
                    <section class="row justify-content-center">
                        <article class="col-12 px-4 position-relative">
                            <i class="fas fa-search icon-search-top"></i>
                            <input class="input_search-home-page" type="text" id="search-bar" name="search_bar">
                            <img id="btn_interesses" class="img-filter-top" src="assets/img/filter.svg">
                        </article>
                    </section>
                    <section class="row justify-content-center mt-4">
                        <article class="col-12 px-4">
                            <switch class="checkbox-top-home-page position-relative">
                                <border class="checkbox-top-home-page_overlay"></border>
                                <selector id="selector" class="selector">
                                </selector>
                                <section style="height:100%;"
                                         class="row sec-selector-home-page text-center align-content-center">
                                    <article id="interesses" class="switch-interesses col-6">
                                        <p> Interesses </p>
                                    </article>
                                    <article id="todos" class="switch-todos col-6" style="color:#1D1D1D;">
                                        <p> Todos </p>
                                    </article>
                                </section>
                            </switch>
                        </article>
                    </section>
                    <section class="row justify-content-center mt-4">
                        <article class="col-12 art-date_slide">
                            <Dateslide id="slide_date" class="px-4 date-slide">
                                <hoje class="date-slide-elements slide-hoje"> Hoje</hoje>
                                <amanha class="date-slide-elements slide-amanha ml-2"> Amanhã</amanha>
                                <!--- para apresentar os dias dentro dos pill utilizando tempo real de forma dinâmica--->
                                <?php
                                for ($n = 0; $n <= 5; $n++) {
                                    $data_pill = date("Y-m-d", strtotime("+" . $n . "days"));
                                    if ($n >= 2) {
                                        echo '<dia class="date-slide-elements slide-dias ml-2" id="pill_' . $n . '">' . $data_pill[strlen($data_pill) - 2] . $data_pill[strlen($data_pill) - 1] . '</dia>';
                                    }
                                }
                                ?>
                                <calendar class="date-slide-elements slide-dias ml-2"><img
                                            src="assets/img/calendar.svg"></calendar>
                            </Dateslide>
                        </article>
                    </section>
                </article>
            </section>
            <section class="row">
                <article class="col-12 mt-5 mb-3 px-4">
                    <h2 class="pl-2 h2-eventos"> Eventos </h2>
                </article>
                <article class="col-12">
                    <section class="row px-4">
                        <article class="col-12 event-card mb-5">
                            <a href="evento_detail.php">
                                <section class="row">
                                    <article class="col-12">
                                        <section class="row event-header mb-3">
                                            <titulo class="col-12 mt-3 mb-1">
                                                <h4 class="h4-eventos"> Smells like drunk spirit </h4>
                                            </titulo>
                                            <article class="col-6">
                                                <section class="row">
                                                    <data class="col-12 mb-2">
                                                        <img class="mr-1" src="assets/img/calendar_black.svg">
                                                        <p class="d-inline"> Hoje </p>
                                                    </data>
                                                    <horas class="col-12">
                                                        <img class="mr-1" src="assets/img/clock.svg">
                                                        <p class="d-inline"> 21:45 </p>
                                                    </horas>
                                                </section>
                                            </article>
                                            <nucleo class="col-6 text-right">
                                                <img src="assets/img/NRock_1.svg">
                                            </nucleo>
                                        </section>
                                        <section class="row event-cover"
                                                 style='background-image: url("assets/img/smells_rock_1.jpg");'>
                                        </section>
                                    </article>
                                </section>
                            </a>
                            <div class="card-footer text-right py-1 px-4">
                                <img class="save_share" src="assets/img/share_white.svg">
                                <img class="ml-3 save_share" src="assets/img/save_white.svg">
                            </div>
                        </article>

                    </section>
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

<Panel id="panel_interesses_menu_mobile" class="">
    <interesses id="interesses_menu" class="container-fluid interesses_menu">
        <section class="row mx-4">
            <article class="col-12 my-4">
                <h5 class="h5-interesses"> Interesses </h5>
            </article>
            <article class="col-12">
                <section class="row">
                    <article class="col-12">
                        <span class=""> Cultura </span>
                        <span> Música </span>
                        <span> Dança </span>
                        <span> Desporto </span>
                        <span> Jogos </span>
                    </article>
                </section>
            </article>
        </section>
        <section class="row mx-4">
            <article class="col-12 my-4">
                <h5 class="h5-interesses"> Núcleos </h5>
            </article>
            <article class="col-12 my-4">
                <p class=""> Cultura </p>
            </article>
            <article class="col-12">
                <section class="row">
                    <article class="col-12">
                        <span class=""> Cultura </span>
                        <span> Música </span>
                        <span> Dança </span>
                        <span> Desporto </span>
                        <span> Jogos </span>
                    </article>
                </section>
            </article>
        </section>
    </interesses>
    <background id="background_interesses_menu" class="black-ground"></background>
</Panel>
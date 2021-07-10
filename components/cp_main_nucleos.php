<main class="container-fluid main-flex">
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
            <section class="row section-nucleos">
                <article class="col-12 mt-4 mb-3 position-relative">
                    <h2 class="text-center h2-nucleo_save"> Núcleos </h2>
                    <a href="#"><img class="mr-4 info_nucleos" src="assets/outros/info.svg"></a>
                </article>
                <article class="col-12 px-4 mb-3">
                    <switch class="checkbox-top-home-page position-relative">
                        <border class="checkbox-top-home-page_overlay"></border>
                        <selector id="selector" class="selector">
                        </selector>
                        <section style="height:100%;"
                                 class="row sec-selector-home-page text-center align-content-center">
                            <article id="oficiais" class="switch-interesses col-6">
                                <p> Oficiais </p>
                            </article>
                            <article id="criacoes" class="switch-todos col-6" style="color:#1D1D1D;">
                                <p> Criações </p>
                            </article>
                        </section>
                    </switch>
                </article>
                <article class="col-12 text-center mb-3 px-5 p-text">
                    <p id="text_nucleo_oficiais"> Bem vindo aos núcleos oficiais! <br>
                        Aqui podes encontrar os núcleos setoriais que já existem na UA </p>
                    <p id="text_nucleo_criacoes" style="display:none;"> Gostavas que a UA tivesse um núcleo diferente?
                        <br> Sugere um tema aqui! </p>
                </article>
                <article class="col-12 p-0 mb-5">
                    <article class="col-12 px-4 position-relative">
                        <i class="fas fa-search icon-search-top"></i>
                        <input class="input_search-home-page" type="text" id="search-bar" name="search_bar">
                        <img id="" class="img-filter-top" src="assets/img/filter.svg">
                    </article>
                </article>
                <article id="nucleos_oficiais" class="col-12 px-4">

                    <section class="row mb-3">
                        <?php
                        require_once "connections/connection.php";
                        $padding = false;
                        $link = new_db_connection();
                        $stmt = mysqli_stmt_init($link);
                        $query = "SELECT nucleos.id_nucleo,nucleos.nome_nucleo,nucleos.sigla_nucleo,nucleos_oficiais.imagem_oficial FROM nucleos
                                INNER JOIN nucleos_oficiais
                                ON nucleos.id_nucleo=nucleos_oficiais.ref_id_nucleo;";
                        if (mysqli_stmt_prepare($stmt, $query)) {
                            if (mysqli_stmt_execute($stmt)) {
                                mysqli_stmt_bind_result($stmt, $id_nucleo, $nome_nucleo, $sigla_nucleo, $imagem_oficial);
                                while (mysqli_stmt_fetch($stmt)) {
                                    ?>
                                    <article class="col-6 art-card-nucleo_geral" style="
                                    <?php if ($padding === false){?>
                                    padding-right:8px;
                                    <?php $padding = true;} else{ ?>
                                    padding-left:8px;
                                    <?php $padding = false;} ?>
                                    ">
                                        <a href="nucleos_detail.php?id_nucleo=<?= $id_nucleo ?>">
                                            <div class="nucleo_card" style="background-image: ;">
                                                <div class="row align-items-center sec_nucleo_card_img">
                                                    <div class="col-4 art_nucleo_card min-nucleo-card">
                                                        <img src="assets/img/<?= $imagem_oficial ?>">
                                                    </div>
                                                    <div class="col-6 art_nucleo_card word-warp">
                                                        <p class="p-nucleo_name m-0"> <?= $sigla_nucleo ?> </p>
                                                        <p class="text-white m-0"> <?= $nome_nucleo ?> </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </article>
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

                    </section>

                </article>
                <article id="nucleos_criacoes" class="col-12 px-4">

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
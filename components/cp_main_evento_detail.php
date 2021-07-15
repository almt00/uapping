<?php
require_once "connections/connection.php";
$link = new_db_connection();
if (isset($_GET['id_evento'])) {
    $id_evento = $_GET['id_evento'];
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    $query = "SELECT eventos.id_evento,eventos.nome_evento, eventos.data_evento,eventos.hora_evento,eventos.imagem_evento,eventos.local_evento,eventos.descricao_evento,eventos.ref_id_nucleo,eventos.preco_evento,eventos.link_fb_evento, nucleos_oficiais.imagem_oficial, nucleos_oficiais.link_fb_oficial,nucleos_oficiais.link_insta_oficial,nucleos_oficiais.link_site_oficial
FROM eventos
INNER JOIN nucleos_oficiais
ON eventos.ref_id_nucleo=nucleos_oficiais.ref_id_nucleo
WHERE eventos.id_evento=?";
    if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement
        mysqli_stmt_bind_param($stmt, 'i', $id_evento);
        mysqli_stmt_execute($stmt); // Execute the prepared statement
        mysqli_stmt_bind_result($stmt, $id_evento, $nome_evento, $data_evento, $hora_evento, $imagem_evento, $local_evento, $descricao_evento, $id_nucleo, $preco_evento, $link_fb_evento, $imagem_oficial, $link_fb_oficial, $link_insta_oficial, $link_site_oficial);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt); // Close statement
    }
    mysqli_close($link);
} else {
    header("Location: ../home_page.php");
    die;
}
?>

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
            <div id="btn_back" class="btn-back ">
                <img src="assets/img/back.svg">
            </div>
            <section class="row">
                <article class="col-12">
                    <section id="capa_evento" class="row event-detail-cover"
                             style='background-image: url("assets/img/<?= $imagem_evento ?> ");'></section>
                    <section class="row section-evento_detail">
                        <article class="col-12 mt-barra mb-4">
                            <div class="barra_evento_detail"></div>
                        </article>
                        <article class="col-12 px-event-detail mb-3 position-relative">
                            <h2 class="h2-evento_detail"> <?= $nome_evento ?> </h2>
                        </article>
                        <article class="col-12 mb-4 px-event-detail">
                            <section class="row justify-content-between">
                                <data class="col-6 mb-3 caixa-evento-detail">
                                    <img class="mr-2 evento-detail-icon" src="assets/img/calendar_black.svg">
                                    <p class="d-inline evento-detail-text"> <?php
                                        if (date('Y-m-d') == $data_evento) {
                                            echo "Hoje";
                                        } else if (date("Y-m-d", strtotime("+" . 1 . "days")) == $data_evento) {
                                            echo "Amanhã";
                                        } else {
                                            echo date('j/m', strtotime($data_evento));
                                        }
                                        ?> </p>
                                </data>
                                <horas class="col-5 mb-3 horas-preco-evento-detail">
                                    <div class="div-horas">
                                        <img class="mr-2 evento-detail-icon" src="assets/img/clock.svg">
                                        <p class="d-inline evento-detail-text"> <?= date('G:i', strtotime($hora_evento)) ?> </p>
                                    </div>
                                </horas>
                                <localizacao class="col-6 mb-3 caixa-evento-detail">
                                    <img class="mr-2 evento-detail-icon" src="assets/img/location.svg">
                                    <p class="d-inline"> <?= $local_evento ?> </p>
                                </localizacao>
                                <preco class="col-5 mb-3 horas-preco-evento-detail">
                                    <div class="div-preco">
                                        <?php
                                        if ($preco_evento == null) {
                                            echo '<p class="d-inline"> Gratuito </p>';
                                        } else {
                                            echo '<p class="d-inline">' . $preco_evento . ' €</p>';
                                        }
                                        ?>

                                    </div>
                                </preco>
                            </section>
                        </article>
                        <article class="col-12 mb-1 px-event-detail">
                            <h3 class="subtitle-event-detail"> Sobre </h3>
                        </article>
                        <article class="col-12 mb-3 px-event-detail">
                            <p class="text-event-detail"> <?= $descricao_evento ?>
                            </p>
                        </article>
                        <article class="col-12 mb-5 text-right share-save-event-detail-icons px-event-detail">
                            <div class="d-inline position-relative">
                                <img id="share" class="evento-detail-icon" src="assets/img/share.svg">
                                <p class="tag-share-save-event-detail"> Partilhar </p>
                            </div>

                            <!--script para partilha com a interface nativa do dispositivo-->
                            <script>
                                const toShare = {
                                    title: "Partilhar evento: <?= $nome_evento ?> ",
                                    text: "Olha só este evento na UA chamado <?= $nome_evento ?>!",
                                    url: window.location.href // ver isto qdo for partilhar fora do detalhe
                                };
                                const button = document.getElementById('share');
                                button.addEventListener('click', async () => {
                                    try {
                                        await navigator.share(toShare); // Will trigger the native "share" feature
                                        button.textContent = 'Shared !';
                                    } catch (err) {
                                        button.textContent = 'Something went wrong';
                                        console.log(err);
                                    }
                                });
                            </script>
                            <div class="d-inline position-relative">
                                <img class="ml-3 evento-detail-icon" src="assets/img/save.svg">
                                <p class="tag-share-save-event-detail" style="margin-left:0.4rem"> Guardar </p>
                            </div>
                        </article>
                        <article class="col-12 mb-2 px-event-detail">
                            <h3 class="subtitle-event-detail"> Participantes </h3>
                        </article>
                        <article class="col-12 mb-5 art-people-event-detail px-event-detail">
                            <div class="mr-1 people-bubble-event-detail bg-profile"
                                 style='background-image: url("assets/img/smells_rock_1.jpg");'></div>
                            <div class="mr-1 people-bubble-event-detail bg-profile"></div>
                            <div class="mr-1 people-bubble-event-detail bg-profile"></div>
                            <div class="people-bubble-event-detail"><span> +3 </span></div>
                        </article>
                        <article class="col-12 mb-3 text-center px-event-detail">
                            <div class="links-cal-out-event-detail"> Adicionar ao calendário</div>
                            <img class="mr-2 links-cal-icon" src="assets/img/calendar_black.svg">
                        </article>
                        <?php
                        if ($link_fb_evento != null) {
                            echo '<article class="col-12 mb-5 text-center px-event-detail" >
                                <a href="' . $link_fb_evento . '" target="_blank">
                            <div class="links-face-out-event-detail"> Evento no Facebook</div></a>
                            <img class="mr-2 links-face-icon" src="assets/img/facebook_cinza.svg">
                        </article>';
                        }
                        ?>

                        <article class="col-12 mb-2 px-event-detail">
                            <h3 class="subtitle-event-detail"> Organização </h3>
                        </article>
                        <article class="col-12 mb2 px-event-detail">
                            <section class="row justify-content-between">
                                <article class="col-6 mb-4">
                                    <a href="nucleos_detail.php?id_nucleo=<?= $id_nucleo ?>"><img
                                                src="assets/temp/NRock_text.png"></a>
                                </article>
                                <article class="position-relative mb-4 text-right art-org-icons align-self-center">
                                    <?php
                                    if ($link_site_oficial != null) {
                                        echo '<a href="' . $link_site_oficial . '" target="_blank"><img
                                                class="org-icons-event-detail" src="assets/img/site_icon.svg"></a>';
                                    }
                                    if ($link_insta_oficial != null) {
                                        echo '<a href="' . $link_insta_oficial . '" target="_blank"><img
                                                class="org-icons-event-detail" src="assets/img/insta_icon.svg"></a>';
                                    }
                                    if ($link_fb_oficial != null) {
                                        echo '<a href="' . $link_fb_oficial . '" target="_blank"><img
                                                class="org-icons-event-detail" src="assets/img/face_icon.svg"></a>';
                                    }
                                    ?>

                                </article>
                            </section>
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
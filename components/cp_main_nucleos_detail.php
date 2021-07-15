<?php
require_once "connections/connection.php";
$link = new_db_connection();
if (isset($_GET['id_nucleo'])) {
    $id_nucleo = $_GET['id_nucleo'];
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    $query = "SELECT nucleos.id_nucleo,nucleos.nome_nucleo,nucleos.sigla_nucleo,nucleos_oficiais.imagem_oficial,nucleos.descricao_nucleo,
                nucleos_oficiais.link_fb_oficial,nucleos_oficiais.link_insta_oficial,nucleos_oficiais.link_site_oficial FROM nucleos
                INNER JOIN nucleos_oficiais
                ON nucleos.id_nucleo=nucleos_oficiais.ref_id_nucleo
                WHERE nucleos_oficiais.ref_id_nucleo=?";
    if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement
        mysqli_stmt_bind_param($stmt, 'i', $id_nucleo);
        mysqli_stmt_execute($stmt); // Execute the prepared statement
        mysqli_stmt_bind_result($stmt, $id_nucleo, $nome_nucleo, $sigla_nucleo, $imagem_oficial, $descricao_nucleo,
            $link_fb_oficial, $link_insta_oficial, $link_site_oficial);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt); // Close statement
    }
} else {
    header("Location: home_page.php");
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
            <div id="btn_back" class="btn-back padding-top-nucleo-detail pl-4" style="left:0; top:1.55rem">
                <img src="assets/img/back.svg">
            </div>
            <div class="nucleo_logo_icon padding-top-nucleo-detail pr-4">
                <img src="assets/img/<?= $imagem_oficial ?>">
            </div>
            <section class="row section-nucleos">
                <article class="col-12 mt-4 mb-3 position-relative padding-top-nucleo-detail">
                    <h2 class="text-center h2-nucleo_detail"> <?= $sigla_nucleo ?> </h2>
                    <h5 class="text-center h5-nucleo_detail"> <?= $nome_nucleo ?> </h5>
                </article>
                <article class="col-12 mt-4 mb-1 px-event-detail">
                    <h3 class="subtitle-event-detail"> Sobre </h3>
                </article>
                <article class="col-12 mb-3 px-event-detail">
                    <p class="text-event-detail"> <?= $descricao_nucleo ?>
                    </p>
                </article>
                <article class="col-12 p-0">
                    <section class="row px-4 justify-content-end" style="width:100%;">
                        <article class="position-relative mb-4 text-right art-org-icons align-self-center"
                                 style="margin:0;">
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
                <article class="col-12 mt-3 mb-2 px-event-detail">
                    <h3 class="subtitle-event-detail"> A nossa equipa fantástica! </h3>
                </article>
                <article class="col-12 px-event-detail mt-4 position-relative">
                    <section class="row">
                        <?php
                        $stmt = mysqli_stmt_init($link);
                        $query = "SELECT equipas.nome_membro_equipa,equipas.imagem_membro_equipa,cargos_oficiais.nome_cargo FROM equipas
                                INNER JOIN nucleos_oficiais
                                ON equipas.ref_id_nucleo_oficial=nucleos_oficiais.ref_id_nucleo
                                INNER JOIN cargos_oficiais
                                ON equipas.ref_id_cargo=cargos_oficiais.id_cargo
                                WHERE equipas.ref_id_nucleo_oficial=?";
                        if (mysqli_stmt_prepare($stmt, $query)) {
                            mysqli_stmt_bind_param($stmt, 'i', $id_nucleo);
                            if (mysqli_stmt_execute($stmt)) {
                                mysqli_stmt_bind_result($stmt, $nome_membro_equipa, $imagem_membro_equipa,$nome_cargo);
                                while (mysqli_stmt_fetch($stmt)) {
                                    ?>
                                    <article class="col-4 text-center mb-4">
                                        <img class="membros-nucleo-detail" src="assets/temp/profile_test.png">
                                        <p class="p-nome-membro-nucleo-detail"> <?= $nome_membro_equipa ?> </p>
                                        <p class="p-role-membro-nucleo-detail"> <?= $nome_cargo ?> </p>
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
    document.getElementById("btn_back").onclick = function () {
        window.history.back();
    }
</script>
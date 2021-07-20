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
            <section class="row section-nucleos background_cinza pb-5">
                <article class="col-12 mt-4 mb-3 position-relative">
                    <h2 class="text-center h2-nucleo_save"> Guardados </h2>
                </article>
                <article class="col-12 px-4 mb-3">
                    <switch class="checkbox-top-home-page position-relative">
                        <border class="checkbox-top-home-page_overlay"></border>
                        <selector id="selector" class="selector">
                        </selector>
                        <section style="height:100%;"
                                 class="row sec-selector-home-page text-center align-content-center">
                            <article id="ativos" class="capture_saved_id switch-interesses col-6">
                                <p> Ativos </p>
                            </article>
                            <article id="passados" class="capture_saved_id switch-todos col-6" style="color:#1D1D1D;">
                                <p> Passados </p>
                            </article>
                        </section>
                    </switch>
                </article>
                <article class="col-12 text-center mb-3 px-5 p-text">
                    <p id="text_saved_ativos"> Aqui podes ver todos os eventos que não queres mesmo deixar
                        passar... </p>
                    <p id="text_saved_passados" style="display:none;"> Aqui podes ver todos os eventos que queres mais
                        tarde recordar... </p>
                </article>

                <article class="col-12 mt-4">
                    <section class="row px-4">
                        <div id="eventos_guardados_conteudo" style="width:100%;"></div>
                        <div id="eventos_guardados_load" style="width:100%;">
                        <?php
                        require_once "connections/connection.php";
                        $link = new_db_connection();
                        $stmt = mysqli_stmt_init($link);
                        $query = "SELECT 
                                    eventos_guardados.eventos_id_evento,
                                    eventos.nome_evento, 
                                    eventos.data_evento,eventos.hora_evento,
                                    eventos.imagem_evento,
                                    eventos.ref_id_nucleo, 
                                    nucleos_oficiais.imagem_oficial 
                                    FROM 
                                    eventos_guardados
                                    INNER JOIN 
                                    eventos 
                                    ON eventos_guardados.eventos_id_evento = eventos.id_evento
                                    INNER JOIN 
                                    nucleos_oficiais 
                                    ON eventos.ref_id_nucleo = nucleos_oficiais.ref_id_nucleo
                                    WHERE 
                                    eventos_guardados.utilizadores_id_utilizador = ? AND 
                                    CAST(CONCAT(eventos.data_evento, ' ',  eventos.hora_evento) AS DATETIME) >= NOW()
                                    ORDER BY 
                                    eventos.data_evento ASC";

                        if (mysqli_stmt_prepare($stmt, $query)) {
                            mysqli_stmt_bind_param($stmt, 'i', $_SESSION['id_user']);
                            if (mysqli_stmt_execute($stmt)) {
                                mysqli_stmt_bind_result($stmt, $id_evento, $nome_evento, $data_evento, $hora_evento, $imagem_evento, $id_nucleo, $imagem_oficial);

                            while (mysqli_stmt_fetch($stmt)) {

                                ?>
                                <article class="col-12 event-card mb-5">
                                        <section class="row">
                                            <article class="col-12">
                                                <section class="row event-header mb-3">
                                                    <titulo class="col-12 mt-3 mb-1">
                                                        <a href="evento_detail.php?id_evento=<?= $id_evento ?>">
                                                            <section class="row">
                                                                <article class="col-12">
                                                                    <h4 class="h2-eventos"> <?= htmlspecialchars($nome_evento) ?> </h4>
                                                                </article>
                                                            </section>
                                                        </a>
                                                    </titulo>
                                                    <article class="col-6">
                                                        <a href="evento_detail.php?id_evento=<?= htmlspecialchars($id_evento) ?>">
                                                        <section class="row">
                                                            <data class="col-12 mb-2">
                                                                <img class="mr-1"
                                                                     src="assets/img/calendar_black.svg">
                                                                <p class="d-inline"> <?php
                                                                    if (date('Y-m-d') == $data_evento) {
                                                                        echo "Hoje";
                                                                    } else if (date("Y-m-d", strtotime("+" . 1 . "days")) == $data_evento) {
                                                                        echo "Amanhã";
                                                                    } else {
                                                                        echo date('j/m', strtotime($data_evento));
                                                                    }
                                                                    ?> </p>
                                                            </data>
                                                            <horas class="col-12">
                                                                <img class="mr-1" src="assets/img/clock.svg">
                                                                <p class="d-inline"> <?= date('G:i', strtotime($hora_evento)) ?> </p>
                                                            </horas>
                                                        </section>
                                                        </a>
                                                    </article>
                                                    <nucleo class="col-6 text-right" style="height:3.5rem;">
                                                        <section class="row">
                                                            <article class="col-12">
                                                                <a href="nucleos_detail.php?id_nucleo=<?= $id_nucleo ?>">
                                                                    <img src="assets/nucleos/<?= $imagem_oficial ?>.svg">
                                                                </a>
                                                            </article>
                                                        </section>
                                                    </nucleo>
                                                </section>
                                                <a href="evento_detail.php?id_evento=<?= $id_evento ?>">
                                                <section class="row event-cover"
                                                         style='background-image: url("assets/img/<?= $imagem_evento ?>");'>
                                                </section>
                                                </a>
                                            </article>
                                        </section>
                                    <div class="card-footer text-right py-1 px-4">
                                        <img class="save_share" src="assets/img/share_white.svg">
                                        <img class="ml-3 save_share remove" id="removeGuardado" name= <?=$id_evento?> src="assets/img/saved_orange.svg">
                                    </div>
                                </article>
                            <?php
                            }
                            $result = mysqli_stmt_store_result($stmt);
                            $rows = mysqli_stmt_num_rows($stmt);
                            if ($rows == 0) { ?>
                                <script>
                                    document.getElementById('text_saved_ativos').innerHTML = 'Ainda não tens nenhum evento guardado...';
                                </script>
                                <?php

                                echo '<article class="col-12"><img src="assets/ilustracoes/empty.svg"></article>'; // aqui colocar imagem ( Miguel )
                                // echo 'nada';

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
                        </div>
                    </section>
                </article>

            </section>
        </article>
    </section>
    <?php include_once "components/cp_footer.php"?>
</main>

<!--TEMPLATE JS AJAX INTERESSES VS TODOS EVENTOS-->
<script id="eventos_guardados_template" type="text/x-handlebars-template">
    {{#each this}}
<article class="col-12 event-card mb-5">
    <a <a href="evento_detail.php?id_evento={{id_evento}}">
        <section class="row">
            <article class="col-12">
                <section class="row event-header mb-3">
                    <titulo class="col-12 mt-3 mb-1">
                        <h4 class="h4-eventos">{{nome}}</h4>
                    </titulo>
                    <article class="col-6">
                        <section class="row">
                            <data class="col-12 mb-2">
                                <img class="mr-1"
                                     src="assets/img/calendar_black.svg">
                                <p class="d-inline" id="data_evento">{{formatDate data}}</p>
                            </data>
                            <horas class="col-12">
                                <img class="mr-1" src="assets/img/clock.svg">
                                <p class="d-inline" id="hora_evento">{{hora}}</p>
                            </horas>
                        </section>
                    </article>
                    <nucleo class="col-6 text-right">
                        <img src="assets/nucleo/{{imagem_nucleo}}.svg">
                    </nucleo>
                </section>
                <section class="row event-cover"
                         stylstyle='background-image: url("assets/img/{{imagem}}")'>
                </section>
            </article>
        </section>
    </a>
    <div class="card-footer text-right py-1 px-4">
        <img class="save_share" src="assets/img/share_white.svg">
        <img class="ml-3 save_share remove" id="removeGuardado" name="{{id_evento}}" src="assets/img/saved_orange.svg">
    </div>
</article>
    {{/each}}
</script>
<!--terminar template -->
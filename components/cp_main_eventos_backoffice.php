    <main class="background_cinza container-fluid main-flex">
        <section class="row">
            <article class="col-12">
                <section class="row section-search-home-page-backoffice">
                    <article class="col-12">
                        <section class="row justify-content-center mb-3">
                            <article class="col-12 px-4">
                                <h2 class="h2-admin-administradores"> Gestão <span> UAPPING </span></h2>
                            </article>
                        </section>
                        <section class="row justify-content-center">
                            <article class="col-12 px-4 position-relative">
                                <i class="fas fa-search icon-search-top"></i>
                                <input class="input_search-home-page-admin" type="text" id="search-bar"
                                       name="search_bar">
                            </article>
                        </section>
                        <section class="row justify-content-center mt-4">
                            <article class="col-12 art-date_slide">
                                <Dateslide id="slide_date" class="px-4 date-slide">
                                    <?php
                                    $data_hoje = date("Y-m-d");
                                    $data_amanha = date("Y-m-d", strtotime("+1days"));
                                    ?>
                                    <hoje class="date-slide-elements slide-hoje pills_datas_backoffice" id="<?= $data_hoje ?>"> Hoje</hoje>
                                    <amanha class="date-slide-elements slide-amanha ml-2 pills_datas_backoffice" id="<?= $data_amanha ?>"> Amanhã</amanha>
                                    <!--- para apresentar os dias dentro dos pill utilizando tempo real de forma dinâmica--->
                                    <?php
                                    for ($n = 0; $n <= 5; $n++) {
                                        $data_pill = date("Y-m-d", strtotime("+" . $n . "days"));
                                        if ($n >= 2) {
                                            echo '<dia class="date-slide-elements slide-dias ml-2 pills_datas_backoffice" id="'.$data_pill.'">' . date('j', strtotime($data_pill)) . '</dia>';
                                        }
                                    }
                                    ?>
                                    <a href="em_construcao.php"><calendar class="date-slide-elements_admin slide-dias ml-2"><img
                                                src="assets/img/calendar.svg"></calendar></a>
                                </Dateslide>
                            </article>
                        </section>
                    </article>
                </section>
                <section class="row">
                    <article class="col-12 mt-5 mb-3 px-4">
                        <h2 class="pl-2 h2-eventos"> Eventos </h2>
                    </article>
                    <div id="eventos_conteudo" style="width:100%;"></div> <!--recebe template handlebars por ajax-->
                    <div id="eventos_load" style="width:100%;">
                    <?php
                    require_once "connections/connection.php";
                    $link = new_db_connection();
                    $stmt = mysqli_stmt_init($link);
                    $query = "SELECT 
                                eventos.id_evento,
                                eventos.nome_evento, 
                                eventos.data_evento,
                                eventos.hora_evento,
                                eventos.imagem_evento,
                                eventos.ref_id_nucleo, 
                                nucleos_oficiais.imagem_oficial
                                FROM eventos
                                INNER JOIN nucleos_oficiais
                                ON eventos.ref_id_nucleo = nucleos_oficiais.ref_id_nucleo 
                                ORDER BY eventos.data_evento ASC";
                    if (mysqli_stmt_prepare($stmt, $query)) {
                        if (mysqli_stmt_execute($stmt)) {
                            mysqli_stmt_bind_result($stmt, $id_evento, $nome_evento, $data_evento, $hora_evento, $imagem_evento, $id_nucleo, $imagem_oficial);
                            while (mysqli_stmt_fetch($stmt)) {
                                ?>
                                <article class="col-12">
                                    <section class="row px-4" id="evento_<?=$id_evento?>">
                                        <article class="col-12 event-card mb-5">
                                                <section class="row">
                                                    <article class="col-12">
                                                        <section class="row event-header mb-3 align-items-center">
                                                            <titulo class="col-12 mt-3 mb-1">
                                                                <a href="evento_detail.php?id_evento=<?= $id_evento ?>">
                                                                    <section class="row">
                                                                        <article class="col-12">
                                                                            <h4 class="h4-eventos"> <?= htmlspecialchars($nome_evento) ?> </h4>
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
                                                                 style='background-image: url("assets/img_eventos/<?= $imagem_evento ?> ");'>
                                                        </section>
                                                        </a>
                                                    </article>
                                                </section>
                                            <div class="card-footer text-right py-1 px-4">
                                                <img id="<?=$id_evento?>" class="save_share ban_evento" src="assets/img/ban_cinza.svg" onclick="window.location.href='em_construcao.php'">
                                            </div>
                                        </article>

                                    </section>
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
                    </div>
                </section>
            </article>
        </section>
        <?php include_once "components/cp_footer.php"?>
    </main>

    <!--TEMPLATE PARA INSERIR EVENTOS PELA SEARCH BAR-->
    <script id="eventos_template" type="text/x-handlebars-template">
        {{#each this}}
        <article class="col-12" id="eventos">
            <section class="row px-4" id="evento_{{id_evento}}">
                <article class="col-12 event-card mb-5" id="{{id_evento}}">
                    <section class="row">
                        <article class="col-12">
                            <section class="row event-header mb-3">
                                <titulo class="col-12 mt-3 mb-1">
                                    <a href="evento_detail.php?id_evento={{id_evento}}">
                                        <section class="row">
                                            <article class="col-12">
                                                <h4 class="h4-eventos" id="nome_evento">{{nome}}</h4>
                                            </article>
                                        </section>
                                    </a>
                                </titulo>
                                <article class="col-6">
                                    <a href="evento_detail.php?id_evento={{id_evento}}">
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
                                    </a>
                                </article>
                                <nucleo class="col-6 text-right" style="height:3.5rem;">
                                    <section class="row">
                                        <article class="col-12">
                                            <a href="nucleos_detail.php?id_nucleo={{id_nucleo}}">
                                                <img src="assets/nucleos/{{imagem_nucleo}}.svg">
                                            </a>
                                        </article>
                                    </section>
                                </nucleo>
                            </section>
                            <a href="evento_detail.php?id_evento={{id_evento}}">
                                <section id="background" class="row event-cover"
                                         style='background-image: url("assets/img_eventos/{{imagem}}")'>
                                </section>
                            </a>
                        </article>
                    </section>
                    <div class="card-footer text-right py-1 px-4">
                        <img id="{{id_evento}}" class="save_share ban_evento" src="assets/img/ban_cinza.svg" onclick="window.location.href='em_construcao.php'">
                    </div>
                </article>
        </article>
        {{/each}}
    </script>


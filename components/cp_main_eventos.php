<main class="background_cinza container-fluid main-flex">
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
                            <switch class="checkbox-top-home-page position-relative" id="switch_interesses">
                                <border class="checkbox-top-home-page_overlay"></border>
                                <selector id="selector" class="selector">
                                </selector>
                                <section style="height:100%;"
                                         class="row sec-selector-home-page text-center align-content-center">
                                    <article id="interesses" class="capture_id switch-interesses col-6">
                                        <p> Interesses </p>
                                    </article>
                                    <article id="todos" class="capture_id switch-todos col-6" style="color:#1D1D1D;">
                                        <p> Todos </p>
                                    </article>
                                </section>
                            </switch>
                        </article>
                    </section>
                    <section class="row justify-content-center mt-4">
                        <article class="col-12 art-date_slide">
                            <Dateslide id="slide_date" class="px-4 date-slide">
                                <?php
                                $data_hoje = date("Y-m-d");
                                $data_amanha = date("Y-m-d", strtotime("+1days"));
                                ?>
                                <hoje class="date-slide-elements slide-hoje pills_datas" id="<?= $data_hoje ?>"> Hoje</hoje>
                                <amanha class="date-slide-elements slide-amanha ml-2 pills_datas" id="<?= $data_amanha ?>"> Amanhã</amanha>
                                <!--- para apresentar os dias dentro dos pill utilizando tempo real de forma dinâmica--->
                                <?php
                                for ($n = 0; $n <= 5; $n++) {
                                    $data_pill = date("Y-m-d", strtotime("+" . $n . "days"));
                                    if ($n >= 2) {
                                        echo '<dia class="date-slide-elements slide-dias ml-2 pills_datas" id="'.$data_pill.'">' . date('j', strtotime($data_pill)) . '</dia>';
                                    }
                                }
                                ?>
                                <a href="em_construcao.php"><calendar class="date-slide-elements slide-dias ml-2"><img
                                            src="assets/img/calendar.svg"></calendar></a>
                            </Dateslide>
                        </article>
                    </section>
                </article>
            </section>
            <div class="row">
                <article class="col-12 mt-5 mb-3 px-4">
                    <h2 class="pl-2 h2-eventos"> Eventos </h2>
                </article>
                <div id="eventos_conteudo" style="width:100%;"></div> <!--RECEBE TEMPLATE HANDLEBARS POR AJAX-->
                <div id="eventos_load" style="width:100%;"><!--RECEBE SEM SER POR AJAX-->
                    <?php
                    require_once "connections/connection.php";
                    $link = new_db_connection();
                    $stmt = mysqli_stmt_init($link);
                    $id_utilizador = $_SESSION["id_user"];

                    $query = "SELECT 
                                eventos.id_evento, 
                                eventos.nome_evento, 
                                eventos.data_evento,
                                TIME_FORMAT(eventos.hora_evento,'%H:%i'),
                                eventos.imagem_evento,
                                eventos.ref_id_nucleo, 
                                nucleos_oficiais.imagem_oficial,
                                    (SELECT eventos_guardados.eventos_id_evento 
                                    FROM eventos_guardados 
                                    WHERE eventos_guardados.eventos_id_evento=eventos.id_evento AND utilizadores_id_utilizador = ?) AS guardado 
                                FROM 
                                eventos
                                INNER JOIN 
                                nucleos
                                ON eventos.ref_id_nucleo = nucleos.id_nucleo
                                LEFT JOIN 
                                nucleos_oficiais
                                ON nucleos.id_nucleo = nucleos_oficiais.ref_id_nucleo
                                INNER JOIN nucleos_has_interesses
                                ON nucleos.id_nucleo = nucleos_has_interesses.nucleos_id_nucleo
                                INNER JOIN interesses 
                                ON nucleos_has_interesses.interesses_id_interesse = interesses.id_interesse
                                INNER JOIN utilizadores_has_interesses 
                                ON interesses.id_interesse = utilizadores_has_interesses.interesses_id_interesse
                                INNER JOIN utilizadores 
                                ON utilizadores_has_interesses.utilizadores_id_utilizador = utilizadores.id_utilizador
                                WHERE CAST(CONCAT(eventos.data_evento, ' ',eventos.hora_evento) AS DATETIME) >= NOW() AND utilizadores_id_utilizador = ?
                                GROUP BY eventos.id_evento
                                ORDER BY eventos.data_evento ASC";

                    if (mysqli_stmt_prepare($stmt, $query)) {
                        mysqli_stmt_bind_param($stmt, 'ii', $id_utilizador, $id_utilizador);
                        if (mysqli_stmt_execute($stmt)) {
                            mysqli_stmt_bind_result($stmt, $id_evento, $nome_evento, $data_evento, $hora_evento, $imagem_evento, $id_nucleo, $imagem_oficial, $guardado);
                            while (mysqli_stmt_fetch($stmt)) {
                    ?>
                    <article class="col-12">
                        <section class="row px-4">
                            <div class="col-12 event-card mb-5">
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
                                                    <a href="evento_detail.php?id_evento=<?= $id_evento ?>">
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
                                <article class="card-footer p-eventos text-right py-1 px-4">
                                    <!------------------SCRIPT PARA PARTILHA COM A INTERFACE NATIVA DO DISPOSITIVO----------------->
                                    <script>
                                        function share(id) {
                                            const toShare = {
                                                title: "Partilhar evento: <?= htmlspecialchars($nome_evento) ?> ",
                                                text: "Olha só este evento na UA chamado <?= htmlspecialchars($nome_evento) ?>!",
                                                url: "https://labmm.clients.ua.pt/deca_20L4/deca_20L4_32/evento_detail.php?id_evento="+id+""
                                            };
                                            const button = document.getElementById('share_<?php echo $id_evento ?>');
                                            button.addEventListener('click', async () => {
                                                try {
                                                    await navigator.share(toShare); // Will trigger the native "share" feature
                                                    button.textContent = 'Shared !';
                                                } catch (err) {
                                                    button.textContent = 'Something went wrong';
                                                }
                                            });
                                        }
                                    </script>
                                    <img id="share_<?=$id_evento?>" class="save_share" src="assets/img/share_white.svg" style="cursor: pointer;">
                                    <script> share("<?php echo $id_evento ?>");</script>
                                    <!--VARIAVEL GUARDADO ESTANDO NULA-->
                                    <?php if(empty($guardado)){
                                        echo'<img class="ml-3 save_share save" id="addGuardado" name='.$id_evento.' src="assets/img/save_white.svg">';
                                        echo'<img class="ml-3 save_share remove" id="removeGuardado" name='.$id_evento.' src="assets/img/saved_orange.svg" style="display: none">';
                                    }else{
                                        echo'<img class="ml-3 save_share save" id="addGuardado" name='.$id_evento.' src="assets/img/save_white.svg" style="display: none">';
                                        echo'<img class="ml-3 save_share remove" id="removeGuardado" name='.$id_evento.' src="assets/img/saved_orange.svg">';
                                    }?>
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
                </div><!-------------FIM DE DIV QUE RECEBE PHP--------------->
            </div>
        </article>
    </section>
    <?php include_once "components/cp_footer.php"?>
</main>

<Panel id="panel_interesses_menu_mobile" class="">
    <interesses id="interesses_menu" class="container-fluid interesses_menu">
        <form action="" method="post" id="interesses_pills">
            <section class="row mx-4">
                <article class="col-12 mt-4 mb-2">
                    <h5 class="h5-interesses"> Interesses </h5>
                </article>
                <article class="col-12">
                    <section class="row justify-content-start">
                        <div id="pills_interesses_conteudo"></div> <!-- RECEBE TEMPLATE HANDLEBARS POR AJAX DOS PILLS -->
                    </section>
                </article>
            </section>
        </form>
    </interesses>
    <background id="background_interesses_menu" class="black-ground"></background>
</Panel>
<!--TEMPLATE JS AJAX INTERESSES VS TODOS EVENTOS-->
<script id="eventos_template" type="text/x-handlebars-template">
    {{#each this}}
    <article class="col-12" id="eventos">
        <section class="row px-4">
            <article class="col-12 event-card mb-5" id="evento_">
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
                                     style="background-image: url('assets/img_eventos/{{imagem}}')">
                            </section>
                            </a>
                        </article>
                    </section>
                <!-----------------------------------------PARTILHAR EVENTO------------------------------>
                <div class="card-footer text-right py-1 px-4">
                    <img id="share_{{id_evento}}" class="save_share_{{id_evento}}" src="assets/img/share_white.svg">
                    {{sharehb nome id_evento}}
                    <!--SE NA BD A VARIAVEL EVENTO GUARDADO FOR NULA-->
                    <?php if(empty($guardado)){
                        echo'<img class="ml-3 save_share save" id="addGuardado" name="{{id_evento}}" src="assets/img/save_white.svg">';//NÃO GUARDADO
                        echo'<img class="ml-3 save_share remove" id="removeGuardado" name="{{id_evento}}" src="assets/img/saved_orange.svg" style="display: none">';//GUARDADO
                    }else{
                        echo'<img class="ml-3 save_share remove" id="removeGuardado" name="{{id_evento}}" src="assets/img/saved_orange.svg">';//GUARDADO
                        echo'<img class="ml-3 save_share save" id="addGuardado" name="{{id_evento}}" src="assets/img/save_white.svg" style="display: none">';//NÃO GUARDADO
                    }?>
                </div>
            </article>
    </article>
    {{/each}}
</script>
<!-------------------------FIM TEMPLATE----------------------->

<!--TEMPLATE JS AJAX INTERESSES PILLS-->
<script id="pills_interesses_template" type="text/x-handlebars-template">
    {{#each this.interesses}}
    <p id="nome_interesse">{{nome_interesse}}</p>
    {{/each}}
    {{#each this.nucleos}}
    <span class="">{{nome_nucleo}}</span>
    {{/each}}
</script>
<!-------------------------FIM TEMPLATE----------------------->
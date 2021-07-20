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
                    <a href="faq.php"><img class="mr-4 info_nucleos" src="assets/outros/info.svg"></a>
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
                        $query = "SELECT 
                                nucleos.id_nucleo,
                                nucleos.nome_nucleo,
                                nucleos.sigla_nucleo,
                                nucleos_oficiais.imagem_oficial,
                                cores_oficiais.nome_cor_oficial 
                                FROM nucleos
                                INNER JOIN nucleos_oficiais
                                ON nucleos.id_nucleo = nucleos_oficiais.ref_id_nucleo
                                INNER JOIN cores_oficiais
                                ON nucleos_oficiais.ref_id_cor_oficial = cores_oficiais.id_cor_oficial;";

                        if (mysqli_stmt_prepare($stmt, $query)) {
                            if (mysqli_stmt_execute($stmt)) {
                                mysqli_stmt_bind_result($stmt, $id_nucleo, $nome_nucleo, $sigla_nucleo, $imagem_oficial, $cor);
                                while (mysqli_stmt_fetch($stmt)) {
                                    ?>
                                    <article class="col-6 art-card-nucleo_geral" style="
                                    <?php if ($padding === false) { ?>
                                            padding-right:8px;
                                        <?php $padding = true;
                                    } else { ?>
                                            padding-left:8px;
                                        <?php $padding = false;
                                    } ?>
                                            ">
                                        <a href="nucleos_detail.php?id_nucleo=<?= $id_nucleo ?>">
                                            <div class="nucleo_card mb-3"
                                                 style='background-image: url("assets/nucleos/cover_nucleo_<?= $cor ?>.svg");'>
                                                <div class="row align-items-center sec_nucleo_card_img">
                                                    <div class="col-2 art_nucleo_card min-nucleo-card">
                                                        <img src="assets/nucleos/<?= $imagem_oficial ?>.svg">
                                                    </div>
                                                    <div class="col-6 art_nucleo_card word-warp pl-0 mr-2">
                                                        <p class="p-nucleo_name m-0"> <?= $sigla_nucleo ?></p>
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

                        <article class="col-6 mb-3" style="<?php if ($padding === false) { ?>
                                padding-right:8px;
                            <?php $padding = true;
                        } else { ?>
                                padding-left:8px;
                            <?php $padding = false;
                        } ?> ">
                            <a href="criar_nucleo.php">
                                <section class="row">
                                    <article class="col-12">
                                        <div class="art-nucleo-criacao"
                                             style='background-image: url("assets/criacoes_nucleos/cover_criacao_cinza.svg");'>
                                            <img class="sinal-mais-criacoes"
                                                 src="assets/criacoes_nucleos/sinal_mais_criacoes.svg">
                                        </div>
                                    </article>
                                </section>
                            </a>
                        </article>
                    </section>

                </article>

                <article id="nucleos_criacoes" class="col-12 px-4">
                    <a href="criar_nucleo.php">
                        <section class="row mb-5">
                            <article class="col-12">
                                <div class="art-nucleo-criacao"
                                     style='background-image: url("assets/img/cover_criar_nucleo.svg");'>
                                    <img class="sinal-mais-criacoes"
                                         src="assets/criacoes_nucleos/sinal_mais_criacoes.svg">
                                </div>
                            </article>
                        </section>
                    </a>
                    <?php
                    $link = new_db_connection();
                    $stmt_1 = mysqli_stmt_init($link);
                    $query = "SELECT 
                                nucleos_membros.ref_id_nucleo 
                                FROM 
                                nucleos_membros
                                WHERE ref_id_utilizador = ?";
                    if (mysqli_stmt_prepare($stmt_1, $query)) {
                        mysqli_stmt_bind_param($stmt_1, 'i', $_SESSION['id_user']);
                        if (mysqli_stmt_execute($stmt_1)) {
                            mysqli_stmt_bind_result($stmt_1, $ref_id_nucleo);
                            mysqli_stmt_fetch($stmt_1);

                        } else {
                            echo "Error:" . mysqli_stmt_error($stmt_1);
                        }
                        mysqli_stmt_close($stmt_1);
                    } else {
                        echo("Error description: " . mysqli_error($link));
                    }
                    mysqli_close($link);
                    ?>
                    <?php
                    require_once "connections/connection.php";

                    $link = new_db_connection();
                    $stmt = mysqli_stmt_init($link);
                    $query = "SELECT
                                nucleos.id_nucleo,
                                nucleos.nome_nucleo, 
                                nucleos.descricao_nucleo,
                                nucleos.sigla_nucleo,
                                cores_fantasmas.nome_cor_fantasma,
                                nucleos_membros.ref_id_nucleo,
                                nucleos_membros.ref_id_utilizador,
                                GROUP_CONCAT(avatares.imagem_avatar) AS cor
                                FROM 
                                nucleos
                                INNER JOIN 
                                nucleos_fantasmas
                                ON nucleos.id_nucleo = nucleos_fantasmas.ref_id_nucleo
                                INNER JOIN 
                                cores_fantasmas
                                ON nucleos_fantasmas.ref_id_cor_fantasma = cores_fantasmas.id_cor_fantasma 
                                LEFT JOIN 
                                nucleos_membros
                                ON nucleos_fantasmas.ref_id_nucleo = nucleos_membros.ref_id_nucleo
                                LEFT JOIN
                                utilizadores
                                ON nucleos_membros.ref_id_utilizador = utilizadores.id_utilizador
                                LEFT JOIN
                                avatares
                                ON utilizadores.ref_id_avatar = avatares.id_avatar
                                GROUP BY nucleos.id_nucleo
                                ORDER BY nucleos.data_insercao_nucleo DESC";

                    if (mysqli_stmt_prepare($stmt, $query)) {
                        if (mysqli_stmt_execute($stmt)) {
                            mysqli_stmt_bind_result($stmt, $id_nucleo, $nome_nucleo, $descricao_nucleo, $sigla_nucleo, $cor_nucleo, $ref_pertence, $ref_utilizador, $cor);
                            while (mysqli_stmt_fetch($stmt)) {
                                ?>
                                <section class="row mt-3 a-criacao_nucleo">
                                    <article class="col-12">
                                        <a href=""<?= $id_nucleo ?> class="text-decoration-none">
                                            <div class="art-nucleo-criacao overflow-hidden"
                                                 style='background-image: url("assets/criacoes_nucleos/cover_criacoes_<?= $cor_nucleo ?>.svg");'>
                                                <section class="row align-items-end align-content-end"
                                                         style="height:100%;">
                                                    <article class="col-2 text-left img-criacao-nucleo">
                                                        <img src="assets/criacoes_nucleos/ghost_criacoes.svg">
                                                    </article>
                                                    <article class="col-8 pb-1">
                                                        <h2 class="h2-cricao_nucleo m-0"> <?= htmlspecialchars($sigla_nucleo) ?> </h2>
                                                        <p class="text-criação_nucleo m-0 pt-2"
                                                           style="white-space: nowrap;"> <?= htmlspecialchars($nome_nucleo) ?> </p>
                                                    </article>
                                                    <article class="col-12 mt-2 mb-1 margin-criacao_nucleo">
                                                        <?php
                                                        $pieces_cor = explode(",", $cor);
                                                        $rows = count($pieces_cor);
                                                        for ($i = 0; $i <= 2; $i++) {
                                                            if (isset($pieces_cor[$i]) && !empty($pieces_cor[$i])) {
                                                                ?>
                                                                <div class="mr-1 people-bubble-criacao_nucleo bg-profile"
                                                                     style='background-image: url("assets/avatares/avatar_<?= $pieces_cor[$i] ?>.svg");'>
                                                                </div>
                                                                <?php
                                                            }
                                                        }
                                                        //condição para esconder bolha "+" caso só existam 2 participantes

                                                        if ($rows > 3) {
                                                            $num = $rows - 3;//identifica o valor númerico a ser apresentado na bolha de "+" participantes
                                                            echo '<div class="people-bubble-criacao_nucleo"><span> +' . $num . '</span>';
                                                        } else {
                                                            echo '<div class="people-bubble-criacao_nucleo" style="background-color: transparent"><span></span>';
                                                        }
                                                        ?>
                                                    </article>
                                                </section>
                                            </div>
                                        </a>
                                        <div id="aderir_nucleo_criacao" class="aderir_criacoes">
                                            <?php
                                            if (($ref_utilizador == $_SESSION['id_user']) && ($id_nucleo == $ref_pertence)) { // isto preciso de ajuda (rip in peace) XD
                                                echo '<img class="aderiu_fantasma"  id="' . $id_nucleo . '" src="assets/criacoes_nucleos/aderiu_criacoes.svg">';
                                            } else {
                                                echo '<img class="aderir_fantasma" id="' . $id_nucleo . '" src="assets/criacoes_nucleos/aderir_criacoes.svg">';
                                                // echo $_SESSION['id_user'];
                                                //echo $id_nucleo.' e '.$ref_id_nucleo;
                                            }
                                            ?>

                                            <!-- <img src="assets/criacoes_nucleos/aderir_criacoes.svg"> -->
                                            <!-- estas são as duas opções de iamgens a serem mostradas consoante o estado de ainda vai seguir
                                            ou já a seguir -->
                                        </div>
                                    </article>
                                </section>
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
                </article>
            </section>
        </article>
    </section>
    <?php include_once "components/cp_footer.php" ?>
</main>

<!--<script>
    document.getElementById("aderir_nucleo_criacao").onclick = function () {
        window.location.href = "home_page.php";
    }
</script>-->

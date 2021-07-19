<main class="container-fluid main-flex">
    <section class="row">
        <article class="col-12">
            <section class="row sec-top-nucleos">
                <article class="col-12 section-search-home-page-backoffice">
                    <section class="row justify-content-center">
                        <article class="col-12 px-4">
                        </article>
                    </section>
                </article>
            </section>
            <section class="row section-nucleos">
                <article class="col-12 mt-4 px-4 position-relative">
                    <i class="fas fa-search icon-search-top"></i>
                    <input class="input_search-home-page-admin" type="text" id="search-bar"
                           name="search_bar">
                </article>
                <article class="col-12 mt-4 px-4">
                    <h2 class="h2-admin-administradores-sub d-inline-block mr-2"> Utilizadores </h2>
                </article>
                <div id="eventos_conteudo" style="width:100%;"></div> <!--recebe template handlebars por ajax-->
                <div id="eventos_load" style="width:100%;">
                    <!--recebe sem ser por ajax-->
                    <!-- Este é o article usado para dar fetch repetidamente consoate a quantidade de users -->
                <?php
                require_once "connections/connection.php";
                $link = new_db_connection();
                $stmt = mysqli_stmt_init($link);
                $query = "SELECT 
                            utilizadores.id_utilizador,
                            utilizadores.nome_utilizador,
                            utilizadores.nickname_utilizador,
                            utilizadores.ref_id_avatar,
                            utilizadores.ativo_utilizador,
                            nucleos_membros.admin_membro 
                            FROM 
                            utilizadores
                            LEFT JOIN 
                            nucleos_membros
                            ON utilizadores.id_utilizador = nucleos_membros.ref_id_utilizador";

                if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement
                    mysqli_stmt_execute($stmt); // Execute the prepared statement
                    mysqli_stmt_bind_result($stmt, $id_utilizador, $nome, $nickname, $avatar, $ativo, $admin_normal);
                    while (mysqli_stmt_fetch($stmt)) {
                        ?>

                        <article class="col-12 mt-2 px-4">
                            <section class="row align-items-center link_edit_users">
                                <article class="col-2" style="max-width:3rem;">
                                    <a href="backoffice_edit_users.php">
                                        <img src="assets/img/user_profile.png">
                                    </a>
                                </article>
                                <article class="col-6">
                                    <a href="backoffice_edit_users.php?user=<?=$id_utilizador?>">
                                        <section class="row">
                                            <article class="col-12">
                                                <p class="p-administradores_nome"> <?= htmlspecialchars($nome) ?> </p>
                                            </article>
                                            <article class="col-12">
                                                <p class="p-administradores_nick">  <?= htmlspecialchars($nickname) ?> </p>
                                            </article>
                                        </section>
                                    </a>
                                </article>
                                <article class="col-2 text-right p-0">
                            <span class="admin-mark">
                                <?php
                                if ($admin_normal == 1) {
                                    echo 'admin';
                                } else {
                                    echo 'normal';
                                }
                                ?>
                            </span>
                                </article>
                                <article class="col-2 text-right art-ban">
                                    <?php
                                    if ($ativo == 1 && $id_utilizador != $_SESSION['id_user']) {
                                        echo '<img src="assets/img/ban_cinza.svg" style="height:2.2rem;">';
                                    } else if ($ativo != 1) {
                                        echo '<img src="assets/img/ban_vermelho.svg" style="height:2.2rem;">';
                                    }
                                    ?>
                                </article>
                            </section>
                        </article>

                        <?php
                    }
                }
                mysqli_stmt_store_result($stmt);
                $rows = mysqli_stmt_num_rows($stmt);
                $n = 3;
                if ($rows <= $n) {
                    echo ' <article class="col-12 mt-4 mb-3 px-4 text-center">
                    <img class="img-fluid" src="assets/asset_administradores.svg">
                </article>';
                }
                mysqli_stmt_close($stmt);
                mysqli_close($link);
                ?>
                    <!--recebe sem ser por ajax-->
                </div>
            </section>
        </article>
    </section>
    <!--TEMPLATE JS AJAX UTILIZADORES-->
    <script id="eventos_template" type="text/x-handlebars-template">
        {{#each this}}
        <article class="col-12 mt-2 px-4">
            <section class="row align-items-center link_edit_users">
                <article class="col-2" style="max-width:3rem;">
                    <a href="backoffice_edit_users.php">
                        <img src="assets/img/user_profile.png">
                    </a>
                </article>
                <article class="col-6">
                    <a href="backoffice_edit_users.php?user={{id_utilizador}}">
                        <section class="row">
                            <article class="col-12">
                                <p class="p-administradores_nome"> {{nome}} </p>
                            </article>
                            <article class="col-12">
                                <p class="p-administradores_nick"> {{nick}} </p>
                            </article>
                        </section>
                    </a>
                </article>
                <article class="col-2 text-right p-0">
                            <span class="admin-mark">
                                <?php
                                if ($admin_normal == 1) {
                                    echo 'admin';
                                } else {
                                    echo 'normal';
                                }
                                ?>
                            </span>
                </article>
                <article class="col-2 text-right art-ban">
                    <?php
                    if ($ativo == 1 && $id_utilizador != $_SESSION['id_user']) {
                        echo '<img src="assets/img/ban_cinza.svg" style="height:2.2rem;">';
                    } else if ($ativo != 1) {
                        echo '<img src="assets/img/ban_vermelho.svg" style="height:2.2rem;">';
                    }
                    ?>
                </article>
            </section>
        </article>
        <!--
                                --><?php
        /*                    }
                        }
                        mysqli_stmt_store_result($stmt);
                        $rows = mysqli_stmt_num_rows($stmt);
                        $n = 3;
                        if ($rows <= $n) {
                            echo ' <article class="col-12 mt-4 mb-3 px-4 text-center">
                            <img class="img-fluid" src="assets/asset_administradores.svg">
                        </article>';
                        }
                        mysqli_stmt_close($stmt);
                        mysqli_close($link);
                        */?>

        {{/each}}
    </script>


    <?php include_once "components/cp_footer.php"?>
</main>
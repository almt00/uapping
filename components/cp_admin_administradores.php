<?php
require_once "connections/connection.php";
$link = new_db_connection();
$stmt = mysqli_stmt_init($link);
$query = "
    SELECT nucleos.sigla_nucleo,
    nucleos.id_nucleo 
    FROM 
    nucleos
    INNER JOIN 
    nucleos_oficiais 
    ON nucleos.id_nucleo = nucleos_oficiais.ref_id_nucleo
    INNER JOIN 
    nucleos_membros 
    ON nucleos_oficiais.ref_id_nucleo = nucleos_membros.ref_id_nucleo
    WHERE 
    nucleos_membros.ref_id_utilizador=?";
if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement
    mysqli_stmt_bind_param($stmt, 'i', $_SESSION['id_user']);
    mysqli_stmt_execute($stmt); // Execute the prepared statement
    mysqli_stmt_bind_result($stmt, $sigla_nucleo,$id_nucleo);
    mysqli_stmt_fetch($stmt);
}
mysqli_stmt_close($stmt);
mysqli_close($link);
?>
<main class="container-fluid main-flex">
    <section class="row">
        <article class="col-12">
            <section class="row sec-top-nucleos">
                <article class="col-12 section-search-home-page-admin">
                    <section class="row justify-content-center">
                        <article class="col-12 px-4">
                        </article>
                    </section>
                </article>
            </section>
            <section class="row section-nucleos">
                <article class="col-12 mt-4 mb-3 px-4">
                    <h2 class="h2-admin-administradores"> Gestão <span> <?= htmlspecialchars($sigla_nucleo) ?> </span></h2>
                </article>
                <article class="col-12 mt-1 mb-3 px-4">
                    <h2 class="h2-admin-administradores-sub d-inline-block mr-2"> Administradores </h2>
                    <a href="admin_novo_admin.php"><img class="img-add-administradores"
                                                        src="assets/admin/add_administradores.svg"></a>
                </article>
                <?php
                $link = new_db_connection();
                $stmt = mysqli_stmt_init($link);
                $query = "SELECT utilizadores.nome_utilizador,
                            utilizadores.nickname_utilizador,
                            utilizadores.ativo_utilizador,
                            utilizadores.ref_id_avatar,
                            utilizadores.id_utilizador 
                            FROM 
                            utilizadores
                            INNER JOIN 
                            nucleos_membros
                            ON utilizadores.id_utilizador = nucleos_membros.ref_id_utilizador
                            WHERE nucleos_membros.admin_membro = 1 AND nucleos_membros.ref_id_nucleo = ?";

                if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement
                    mysqli_stmt_bind_param($stmt, 'i', $id_nucleo);
                    mysqli_stmt_execute($stmt); // Execute the prepared statement
                    mysqli_stmt_bind_result($stmt, $nome, $nickname, $ativo, $avatar, $id_utilizador);
                    while (mysqli_stmt_fetch($stmt)) {
                        ?>
                        <article class="col-12 mt-3 px-4">
                            <section class="row align-items-center">
                                <article class="col-2" style="max-width:3rem;">
                                    <img src="assets/img/user_profile.png">
                                </article>
                                <article class="col-8">
                                    <section class="row">
                                        <article class="col-12">
                                            <p class="p-administradores_nome"> <?= htmlspecialchars($nome) ?> </p>
                                        </article>
                                        <article class="col-12">
                                            <p class="p-administradores_nick"> <?= htmlspecialchars($nickname) ?> </p>
                                        </article>
                                    </section>
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
                $n=3;
                if ($rows <= $n) {
                    echo ' <article class="col-12 mt-4 mb-3 px-4 text-center">
                    <img class="img-fluid" src="assets/asset_administradores.svg">
                </article>';
                }
                mysqli_stmt_close($stmt);
                mysqli_close($link);
                ?>
            </section>
        </article>
    </section>
    <?php include_once "components/cp_footer.php"?>
</main>
<?php
if (isset($_GET['user']) && $_GET['user'] != 0) {
    $id_utilizador = $_GET['user'];
    require_once "connections/connection.php";
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    $query = "SELECT utilizadores.nome_utilizador,utilizadores.nickname_utilizador,utilizadores.email_utilizador, utilizadores.ativo_utilizador,nucleos_membros.admin_membro,nucleos.nome_nucleo FROM utilizadores
LEFT JOIN nucleos_membros 
ON utilizadores.id_utilizador=nucleos_membros.ref_id_utilizador
LEFT JOIN nucleos
ON nucleos.id_nucleo=nucleos_membros.ref_id_nucleo
WHERE utilizadores.id_utilizador=?";
    if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement
        mysqli_stmt_bind_param($stmt, 'i', $id_utilizador);
        mysqli_stmt_execute($stmt); // Execute the prepared statement
        mysqli_stmt_bind_result($stmt, $nome_utilizador, $nickname_utilizador, $email_utilizador, $ativo_utilizador, $admin, $nome_nucleo);
        mysqli_stmt_store_result($stmt);
        $rows = mysqli_stmt_num_rows($stmt);
        if ($rows != 1) {
            ?>
            <script>
                window.location.replace("backoffice_users.php");
            </script>
            <?php
            die();
        }
        mysqli_stmt_fetch($stmt);
        ?>
        <main class="container-fluid main-flex overflow-hidden">
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
                    <section class="row section-criar-nucleo justify-content-center">
                        <article class="col-12 mt-4 mb-3 position-relative">
                            <h2 class="text-center h2-nucleo_save"> Informação utilizador </h2>
                        </article>
                        <article class="col-12 px-4">
                            <form action="scripts/sc_update_utilizador.php?id=<?= $id_utilizador ?>" method="post"
                                  id="criar_nucleo">
                                <section class="row justify-content-center">
                                    <article class="col-12">
                                        <div class="div-icons-sign-up text-center position-relative">
                                            <img id="username_icon" class="icon-novo_admin_1"
                                                 src="assets/img/input_profile_icon.svg"
                                                 alt="profile_icon">
                                            <img id="email_icon" class="icon-novo_admin_2"
                                                 src="assets/img/input_mail_icon.svg"
                                                 alt="profile_icon">
                                            <img id="email_icon" class="icon-nucleo" src="assets/img/icon_nucleo.svg"
                                                 alt="profile_icon">
                                        </div>
                                        <input id="nome" class="input_backoffice mb-3 mb-md-3 input_edit_user"
                                               type="text" name="username"
                                               size="24" placeholder="username" required="required"
                                               value="<?= htmlspecialchars($nickname_utilizador) ?>" readonly>
                                        <input id="email" class="input_backoffice mb-3 mb-md-3 input_edit_user"
                                               type="email"
                                               name="email" size="24" placeholder="email" required="required"
                                               value="<?= htmlspecialchars($email_utilizador) ?>" readonly>
                                        <input id="nucleo_pertence"
                                               class="input_backoffice mb-3 mb-md-3 input_edit_user" type="text"
                                               name="nucleo"
                                               size="24" placeholder="nucleo" required="required"
                                               value="<?= htmlspecialchars($nome_nucleo) ?>"
                                               readonly>
                                        <select required="required"
                                                class="custom-select select_criar_nucleo mb-3 mb-md-3"
                                                id="role"
                                                name="role">
                                            <?php
                                            if ($admin == 1) {
                                                echo '<option value="1" selected> administrador</option>';
                                                echo '<option value="0"> normal</option>';
                                            } else if ($admin == 0) {
                                                echo '<option value="1"> administrador</option>';
                                                echo '<option value="0" selected> normal</option>';
                                            }
                                            ?>
                                        </select>

                                        <section class="row justify-content-end sec-bloquear">
                                            <article id="art_bloquear" class="col-12 check-bloquear">
                                                <div class="check-bloquear-text"><p id="bloquear-text"> Bloquear </p>
                                                    <img id="ban_cinza" src="assets/img/ban_cinza.svg">
                                                    <img id="ban_vermelho" src="assets/img/ban_vermelho.svg"></div>
                                                <?php
                                                if ($ativo_utilizador == 1) {
                                                    echo '<input id="bloquear" name="bloquear" value="1" type="checkbox" form="criar_nucleo">';
                                                } else if ($ativo_utilizador == 0) {
                                                    echo '<input id="bloquear" name="bloquear" value="0" type="checkbox" checked form="criar_nucleo">';
                                                }
                                                echo '<script>console.log(document.getElementById("bloquear").value)</script>'
                                                ?>
                                            </article>
                                        </section>
                                    </article>
                                </section>
                                <section class="row justify-content-center mt-5 mt-md-3">
                                    <article class="col-md-12 mt-3 mt-md-5 px-4">
                                        <input form="criar_nucleo" type="submit" class="mb-2 mb-md-2"
                                               style="display: block;"
                                               value="salvar" id="criar_nucleo_submit">
                                        <button id="cancelar_criar_nucleo" class="mb-5" type="button"> cancelar</button>
                                    </article>
                                </section>
                            </form>
                        </article>
                    </section>
                </article>
            </section>
            <?php include_once "components/cp_footer.php" ?>
        </main>
        <?php

    }
} else { ?>
    <script>window.location.replace("backoffice_users.php");</script>
    <?php
    die();
}
?>
<script>
    function block() {
        checkblock = true;
        document.getElementById("bloquear").checked = true;
        document.getElementById("art_bloquear").style.borderColor = "#F00202";
        document.getElementById("bloquear-text").style.color = "#F00202";
        document.getElementById("ban_cinza").style.display = "none";
        document.getElementById("ban_vermelho").style.display = "inline";
        document.getElementById("bloquear").value = "0";
        console.log(document.getElementById("bloquear").value);


    }

    function unblock() {
        checkblock = false;
        document.getElementById("bloquear").checked = true;
        document.getElementById("art_bloquear").style.borderColor = "#BCBCBC";
        document.getElementById("bloquear-text").style.color = "#BCBCBC";
        document.getElementById("ban_cinza").style.display = "inline";
        document.getElementById("ban_vermelho").style.display = "none";
        document.getElementById("bloquear").value = "1";
        console.log(document.getElementById("bloquear").value);

    }

    if (document.getElementById("bloquear").checked === true) {
        block();
    } else {
        unblock();
    }


    document.getElementById("art_bloquear").onclick = function () {
        if (checkblock === false) {
            block();
        } else {
            unblock();
        }
    }

    document.getElementById("cancelar_criar_nucleo").onclick = function () {
        window.history.back();
    }
</script>
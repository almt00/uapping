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
                    <form action="scripts/sc_criar_nucleo.php" method="post" id="criar_nucleo">
                        <section class="row justify-content-center">
                            <article class="col-12">
                                <div class="div-icons-sign-up text-center position-relative">
                                    <img id="username_icon" class="icon-novo_admin_1" src="assets/img/input_profile_icon.svg"
                                         alt="profile_icon">
                                    <img id="email_icon" class="icon-novo_admin_2" src="assets/img/input_mail_icon.svg"
                                         alt="profile_icon">
                                    <img id="email_icon" class="icon-nucleo" src="assets/img/icon_nucleo.svg"
                                         alt="profile_icon">
                                </div>
                                <input id="nome" class="input_backoffice mb-3 mb-md-3 input_edit_user" type="text" name="username"
                                       size="24" placeholder="username" required="required">
                                <input id="email" class="input_backoffice mb-3 mb-md-3 input_edit_user" type="email"
                                       name="email" size="24" placeholder="email" required="required">
                                <input id="nucleo_pertence" class="input_backoffice mb-3 mb-md-3 input_edit_user" type="text" name="nucleo"
                                       size="24" placeholder="nucleo" value="" required="required">
                                <select required="required" class="custom-select select_criar_nucleo mb-3 mb-md-3"
                                        id="area"
                                        name="area" form="criar_nucleo">
                                    <?php
                                    require_once "connections/connection.php";
                                    $link = new_db_connection();
                                    $stmt = mysqli_stmt_init($link);
                                    $query = "SELECT id_interesse, nome_interesse FROM interesses";
                                    if (mysqli_stmt_prepare($stmt, $query)) {
                                        if (mysqli_stmt_execute($stmt)) {
                                            mysqli_stmt_bind_result($stmt, $id_interesse, $nome_interesse);
                                            while (mysqli_stmt_fetch($stmt)) {
                                                echo '<option value="' . $id_interesse . '">' . $nome_interesse . '</option>';
                                            }
                                        } else {
                                            echo "Error:" . mysqli_stmt_error($stmt);
                                        }
                                        mysqli_stmt_close($stmt);
                                    } else {
                                        echo("Error description: " . mysqli_error($link));
                                    }
                                    ?>
                                </select>
                                <section class="row justify-content-end sec-bloquear">
                                        <article id="art_bloquear" class="col-12 check-bloquear">
                                            <div class="check-bloquear-text"><p id="bloquear-text"> Bloquear </p>
                                                <img id="ban_cinza" src="assets/img/ban_cinza.svg">
                                                <img id="ban_vermelho" src="assets/img/ban_vermelho.svg"></div>
                                            <input id="bloquear" name="bloquear" value="" type="checkbox">
                                        </article>
                                </section>
                            </article>
                        </section>
                        <section class="row justify-content-center mt-5 mt-md-3">
                            <article class="col-md-12 mt-3 mt-md-5 px-4">
                                <input form="criar_nucleo" type="submit" class="mb-2 mb-md-2" style="display: block;"
                                       value="salvar" id="criar_nucleo_submit">
                                <button id="cancelar_criar_nucleo" class="mb-5" type="button"> cancelar</button>
                            </article>
                        </section>
                    </form>
                </article>
            </section>
        </article>
    </section>
    <?php include_once "components/cp_footer.php"?>
</main>

<script>

    checkblock = false;
    document.getElementById("art_bloquear").onclick = function (){
        if (checkblock === false){
            checkblock = true;
            document.getElementById("bloquear").checked = true;
            document.getElementById("art_bloquear").style.borderColor = "#F00202";
            document.getElementById("bloquear-text").style.color = "#F00202";
            document.getElementById("ban_cinza").style.display = "none";
            document.getElementById("ban_vermelho").style.display = "inline";
        } else{
            checkblock = false;
            document.getElementById("bloquear").checked = false;
            document.getElementById("art_bloquear").style.borderColor = "#BCBCBC";
            document.getElementById("bloquear-text").style.color = "#BCBCBC";
            document.getElementById("ban_cinza").style.display = "inline";
            document.getElementById("ban_vermelho").style.display = "none";
        }
    }

    document.getElementById("cancelar_criar_nucleo").onclick = function () {
        window.history.back();
    }
</script>
<main class="container-fluid main-flex overflow-hidden">
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
            <section class="row section-criar-nucleo justify-content-center">
                <article class="col-12 mt-5 mb-3 position-relative">
                    <h2 class="text-center h2-nucleo_save"> Criar um Núcleo </h2>
                </article>
                <article class="col-12 px-4">
                    <form action="scripts/sc_criar_nucleo.php" method="post" id="criar_nucleo">
                        <section class="row justify-content-center">
                            <article class="col-12">
                                <select required="required" class="custom-select select_criar_nucleo mb-3 mb-md-3"
                                        id="area"
                                        name="area" form="criar_nucleo">
                                    <option selected disabled value>escolher área</option>
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
                                <input id="nome" class="input_criar_nucleo mb-3 mb-md-3" type="text" name="nome"
                                       size="24" placeholder="nome" required="required">
                                <input id="sigla" class="input_criar_nucleo mb-3 mb-md-3" type="text" name="sigla"
                                       size="24" placeholder="sigla" required="required">
                                <textarea required="required" name="descricao" placeholder="descrição"
                                          class="form-control text-area-criar-nucleo" id="exampleFormControlTextarea1"
                                          rows="5"></textarea>
                            </article>
                        </section>
                        <section class="row justify-content-center mt-3 mt-md-3">
                            <article class="col-md-12 mt-3 mt-md-5 px-4">
                                <input form="criar_nucleo" type="submit" class="mb-2 mb-md-2" style="display: block;"
                                       value="Submeter" id="criar_nucleo_submit">
                                <button id="cancelar_criar_nucleo" class="mb-5" type="button"> cancelar</button>
                            </article>
                        </section>
                    </form>
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
    document.getElementById("cancelar_criar_nucleo").onclick = function () {
        window.history.back();
    }
</script>
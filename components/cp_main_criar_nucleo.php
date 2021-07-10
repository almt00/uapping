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
                <form action="" method="post" id="criar_nucleo">
                <article class="col-12 px-4">
                    <select required="" class="custom-select select_criar_nucleo mb-3 mb-md-3" id="departamentos"
                            name="departamento" form="sign_up">
                        <?php
                        require_once "connections/connection.php";
                        $link = new_db_connection();
                        $stmt = mysqli_stmt_init($link);
                        $query = "SELECT id_departamento, nome_departamento FROM departamentos";
                        if (mysqli_stmt_prepare($stmt, $query)) {
                            if (mysqli_stmt_execute($stmt)) {
                                mysqli_stmt_bind_result($stmt, $id_departamento, $nome_departamento);
                                while (mysqli_stmt_fetch($stmt)) {
                                    echo '<option value="' . $id_departamento . '">' . $nome_departamento . '</option>';
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
                </article>
                <article class="col-12 px-4">
                    <input id="nome" required="" class="input_criar_nucleo mb-3 mb-md-3" type="text" name="nome"
                           size="24" placeholder="nome">
                </article>
                </form>
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
<main class="container-fluid main-flex overflow-hidden">
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
            <section class="row section-criar-nucleo justify-content-center">
                <article class="col-12 mt-4 mb-3 position-relative">
                    <h2 class="text-center h2-nucleo_save"> Criar um Evento </h2>
                </article>
                <article class="col-12 px-4">
                    <form action="scripts/sc_criar_evento.php" method="post" id="criar_evento">
                        <section class="row justify-content-center">
                            <article class="col-12 capa_evento">
                                <div class="div-icons-sign-up text-center position-relative">
                                    <!--<img id="clock_icon" class="icon-clock-criar-evento" src="assets/img/clock_cinza.svg"
                                         alt="profile_icon">-->
                                </div>
                                <input id="nome_evento" class="input_novo_admin mb-3 mb-md-3" type="text" name="nome_evento"
                                       size="24" placeholder="Nome do Evento" required="required">
                                <section class="row justify-content-center sec_input_data_hora">
                                    <article class="col-6 art_input_data_hora pr-2">
                                        <input id="data" class="input_data_hora mb-3 mb-md-3" type="date" name="data"
                                               size="24" placeholder="Data" required="required">
                                        <!--<img id="calendar_icon" class="icon-calendar-criar-evento" src="assets/img/calendar_cinza.svg"
                                             alt="profile_icon">-->
                                    </article>
                                    <article class="col-6 art_input_data_hora pl-2">
                                        <input id="hora" class="input_data_hora mb-3 mb-md-3" type="time" name="hora"
                                               size="24" placeholder="Hora" required="required">
                                    </article>
                                </section>
                                <select required="required" class="custom-select select_criar_nucleo mb-3 mb-md-3"
                                        id="area_1"
                                        name="area_1" form="criar_nucleo">
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
                                <select required="required" class="custom-select select_criar_nucleo mb-3 mb-md-3"
                                        id="area_1"
                                        name="area_1" form="criar_nucleo">
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
                                    <script>
                                        function previewFile(input){
                                            var file = $("input[type=file]").get(0).files[0];
                                            if(file){
                                                var reader = new FileReader();
                                                reader.onload = function(){
                                                    $('#previewImg').css('background-image', 'url(' +reader.result+ ')');
                                                    $('#previewImg').css('filter', 'brightness(60%)');
                                                    console.log(reader);
                                                }
                                                reader.readAsDataURL(file);
                                            }
                                        }
                                    </script>
                                </select>
                                <label for="file-upload" class="capa_evento_div mb-3" id="previewImg"> <img src="assets/img/img_upload.svg"> </label>
                                <input id="file-upload" class="input_novo_admin" type="file" name="capa_evento"
                                       size="24" required="required" onchange="previewFile(this);">
                                <textarea required="required" name="descricao" placeholder="descrição"
                                          class="form-control text-area-criar-nucleo" id="exampleFormControlTextarea1"
                                          rows="5" style="padding-left:1.6rem;"></textarea>
                            </article>
                        </section>
                        <section class="row justify-content-center mt-3 mt-md-3">
                            <article class="col-md-12 mt-3 mt-md-5 px-4">
                                <input form="criar_evento" type="submit" class="mb-2 mb-md-2" style="display: block;"
                                       value="adicionar" id="criar_nucleo_submit">
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
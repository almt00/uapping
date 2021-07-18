<?php
if (isset($_GET['id_evento']) && $_GET['id_evento'] != 0) {
    $id_evento = $_GET['id_evento'];
    require_once "connections/connection.php";
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    $query = "SELECT nome_evento,data_evento,hora_evento,local_evento,imagem_evento,descricao_evento,parceria_evento,ref_id_nucleo,preco_evento,link_fb_evento FROM eventos
WHERE id_evento=?";
    if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement
        mysqli_stmt_bind_param($stmt, 'i', $id_evento);
        mysqli_stmt_execute($stmt); // Execute the prepared statement
        mysqli_stmt_bind_result($stmt, $nome_evento, $data_evento, $hora_evento, $local_evento, $imagem_evento, $descricao_evento, $parceria_evento, $ref_id_nucleo, $preco_evento, $link_fb_evento);
        mysqli_stmt_fetch($stmt);

    }
    mysqli_stmt_close($stmt);
    mysqli_close($link);
}

?>

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
                    <h2 class="text-center h2-nucleo_save"> Editar um Evento </h2>
                </article>
                <article class="col-12 px-4">
                    <form action="scripts/sc_editar_evento.php?id_evento=<?= $id_evento ?>&imagem=<?= $imagem_evento ?>"
                          method="post"
                          id="editar_evento"
                          enctype="multipart/form-data">
                        <section class="row justify-content-center">
                            <article class="col-12 capa_evento">
                                <div class="div-icons-sign-up text-center position-relative">
                                    <img id="email_icon" class="icon-hora" src="assets/img/clock_cinza.svg"
                                         alt="profile_icon">
                                </div>
                                <div class="div-icons-sign-up text-center position-relative">
                                    <!--<img id="clock_icon" class="icon-clock-criar-evento" src="assets/img/clock_cinza.svg"
                                         alt="profile_icon">-->
                                </div>
                                <input id="nome_evento" class="input_novo_admin mb-3 mb-md-3" type="text"
                                       name="nome_evento"
                                       size="24" placeholder="Nome do Evento" required="required"
                                       value="<?= htmlspecialchars($nome_evento) ?>">
                                <section class="row justify-content-center sec_input_data_hora">
                                    <article class="col-6 art_input_data_hora pr-2" style="overflow: hidden;">
                                        <img id="username_icon" class="icon-data" src="assets/img/calendar_cinza.svg"
                                             alt="profile_icon" style="">
                                        <input id="data" class="input_data_hora mb-3 mb-md-3" type="date" name="data"
                                               required="required" value="<?= htmlspecialchars($data_evento) ?>">
                                        <!--<img id="calendar_icon" class="icon-calendar-criar-evento" src="assets/img/calendar_cinza.svg"
                                             alt="profile_icon">-->
                                    </article>
                                    <article class="col-6 art_input_data_hora pl-2">
                                        <input id="hora" class="input_data_hora mb-3 mb-md-3" type="time" name="hora"
                                               required="required" value="<?= htmlspecialchars($hora_evento) ?>">
                                    </article>
                                </section>
                                <select required="required" class="custom-select select_criar_nucleo mb-3 mb-md-3"
                                        id="area_1"
                                        name="area_1" form="criar_evento">
                                    <option value> localização</option>
                                    <?php
                                    if (strlen($local_evento) < 7) {
                                        echo '<option value="online" selected> online</option>';
                                        echo '<option value="presencial"> presencial</option>';

                                    } else {
                                        echo '<option value="online"> online</option>';
                                        echo '<option value="presencial" selected> presencial</option>';
                                    }
                                    ?>
                                </select>
                                <input id="morada" class="input_novo_admin mb-3 mb-md-3" type="text" name="morada"
                                       size="24" placeholder="Morada" required="required" style="display: none"
                                       value="<?= htmlspecialchars($local_evento) ?>">
                                <select required="required" class="custom-select select_criar_nucleo mb-3 mb-md-3"
                                        id="area_2"
                                        name="area_2" form="editar_evento">
                                    <option value> entrada</option>
                                    <?php
                                    if ($preco_evento == null) {
                                        echo '<option value="gratuita" selected> gratuita</option>
                                                <option value="paga"> paga</option>';

                                    } else {
                                        echo '<option value="gratuita"> gratuita</option>
                                                <option value="paga" selected> paga</option>';
                                    }
                                    ?>

                                    <script>
                                        function previewFile(input) {
                                            var file = $("input[type=file]").get(0).files[0];
                                            if (file) {
                                                var reader = new FileReader();
                                                reader.onload = function () {
                                                    $('#previewImg').css('background-image', 'url(' + reader.result + ')');
                                                    $('#previewImg').css('filter', 'brightness(60%)');
                                                    console.log(reader);
                                                }
                                                reader.readAsDataURL(file);
                                            }
                                        }
                                    </script>
                                </select>

                                <input id="preco" class="input_novo_admin mb-3 mb-md-3" type="number" step="any"
                                       name="preco" value="<?= htmlspecialchars($preco_evento) ?>"
                                       size="24" placeholder="Preço" style="display: none">
                                <?php
                                if (isset($imagem_evento)) {
                                    ?>
                                    <label for="fileToUpload" class="capa_evento_div mb-3" id="previewImg"
                                           style="background-image: url('assets/img/<?= $imagem_evento ?>');filter: brightness(60%)">
                                        <img
                                                src="assets/img/img_upload.svg"> </label>
                                    <?php
                                } else {
                                    ?>
                                    <label for="fileToUpload" class="capa_evento_div mb-3" id="previewImg"> <img
                                                src="assets/img/img_upload.svg"> </label>
                                    <?php
                                }
                                ?>
                                <input id="fileToUpload" class="fileToUpload" type="file" name="fileToUpload"
                                       value="<?= $imagem_evento ?>"
                                       size="24" onchange="previewFile(this);">
                                <textarea required="required" name="descricao" placeholder="descrição"
                                          class="form-control text-area-criar-nucleo" id="exampleFormControlTextarea1"
                                          rows="5" style="padding-left:1.6rem;"><?= $descricao_evento ?></textarea>
                            </article>
                        </section>
                        <section class="row justify-content-center mt-3 mt-md-3">
                            <article class="col-md-12 mt-3 mt-md-5 px-4">
                                <input form="editar_evento" type="submit" class="mb-2 mb-md-2" style="display: block;"
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

<script>

    var select_1 = document.getElementById("area_1");
    var select_2 = document.getElementById("area_2");

    if (select_1.selectedIndex === 2) {
        document.getElementById("morada").style.display = "inline-block";
        document.getElementById("morada").required = true;
    } else {
        document.getElementById("morada").style.display = "none";
        document.getElementById("morada").required = false;
    }

    if (select_2.selectedIndex === 2) {
        document.getElementById("preco").style.display = "inline-block";
        document.getElementById("preco").required = true;
    } else {
        document.getElementById("preco").value = " ";
        document.getElementById("preco").style.display = "none";
        document.getElementById("preco").required = false;
    }

    document.getElementById("area_1").onchange = function () {
        if (select_1.selectedIndex === 2) {
            document.getElementById("morada").style.display = "inline-block";
            document.getElementById("morada").required = true;
        } else {
            document.querySelector('#morada').value = null;
            document.getElementById("morada").style.display = "none";
            document.getElementById("morada").required = false;
        }
    }

    document.getElementById("area_2").onchange = function () {
        if (select_2.selectedIndex === 2) {
            document.getElementById("preco").style.display = "inline-block";
            document.getElementById("preco").required = true;
        } else {
            console.log('gratis');
            document.querySelector('#preco').value = null;
            document.getElementById("preco").style.display = "none";
            document.getElementById("preco").required = false;
        }
    }

    document.getElementById("cancelar_criar_nucleo").onclick = function () {
        window.history.back();
    }
</script>
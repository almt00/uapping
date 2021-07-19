<?php
session_start();
if (!isset($_SESSION['id_user']) || $_SESSION['id_user']==null) {
    header("Location: index.php");
}
?>
<header class="container-fluid">
    <nav id="nav-bar" class="row justify-content-around align-items-center align-content-center">
        <article class="col-6">
            <a id="home_page_header" href="home_page.php">
                <img style="color:black;" class="img-fluid width-7" src="assets/img/logo_texto_preto.svg">
            </a>
            <a id="home_page_header_admin" href="home_page_admin.php" style="display: none;">
                <img style="color:black;" class="img-fluid width-7" src="assets/img/logo_texto_preto.svg">
            </a>
            <a id="home_page_header_backoffice" href="home_page_backoffice.php" style="display: none;">
                <img style="color:black;" class="img-fluid width-7" src="assets/img/logo_texto_preto.svg">
            </a>
            <span id="role_admin_header" class="role-header"> admin </span>
            <span id="role_backoffice_header" class="role-header"> backoffice </span>
        </article>
        <article class="col-6 text-right">
            <i class="fas fa-bell icon-size mr-3 mr-md-2"></i>
            <i id="btn_user_menu_mobile" class="fas fa-user-circle icon-size"></i>
        </article>
    </nav>
</header>

<panel id="panel_user_menu_mobile">
    <menu id="user_menu_mobile" class="container-fluid user_menu_mobile">
        <section class="row position-relative">
            <article id="menu_profile" class="col-12">
                <section class="row section-1-user-menu">
                    <article id="avatar" class="p-0 col-3 art-1-icon-user-menu position-relative">
                        <img class="edit-profile-menu-user" src="assets/icons_user_menu/edit.svg">
                        <div class="profile_pic" style='background-image: url("assets/img/user_profile.png")'></div>
                    </article>
                    <article class="p-0 col-9">
                        <section class="row ml-3">
                            <article class="p-0 col-12">
                                <strong> <?= $_SESSION['nome'] ?> </strong>
                            </article>
                            <article class="art-2-icon-user-menu p-0 col-12">
                                @<?= $_SESSION['nickname'] ?>
                            </article>
                        </section>
                    </article>
                </section>
                <section class="position-relative">
                    <?php if (isset($_SESSION['backoffice']) && $_SESSION['backoffice'] == 1){ ?>
                        <?php if (isset($pag_backoffice) && $pag_backoffice === true){ ?>
                            <a href="home_page.php">
                                <article class="col-12 user-menu-options py-1">
                                    <img src="assets/icons_user_menu/voltar.svg">
                                    <span class="user-menu-options-span"> Área Pública </span>
                                </article>
                            </a>
                        <?php } else{ ?>
                            <a href="home_page_backoffice.php">
                                <article class="col-12 user-menu-options py-1">
                                    <img src="assets/icons_user_menu/admin.svg">
                                    <span class="user-menu-options-span"> Backoffice </span>
                                </article>
                            </a>
                        <?php } ?>
                    <?php } ?>
                    <?php if (isset($_SESSION['id_nucleo_admin']) && $_SESSION['id_nucleo_admin'] != null){ ?>
                        <?php if (isset($pag_admin) && $pag_admin === true){ ?>
                            <a href="home_page.php">
                                <article class="col-12 user-menu-options py-1">
                                    <img src="assets/icons_user_menu/voltar.svg">
                                    <span class="user-menu-options-span"> Área Pública </span>
                                </article>
                            </a>
                        <?php } else{ ?>
                            <a href="home_page_admin.php">
                                <article class="col-12 user-menu-options py-1">
                                    <img src="assets/icons_user_menu/admin.svg">
                                    <span class="user-menu-options-span"> Gerir Núcleo </span>
                                </article>
                            </a>
                        <?php } ?>
                    <?php } ?>
                    <a href="">
                        <article class="col-12 user-menu-options py-1">
                            <img src="assets/icons_user_menu/change_interesses.svg">
                            <span class="user-menu-options-span"> Alterar Interesses </span>
                        </article>
                    </a>
                    <a href="criar_nucleo.php">
                        <article class="col-12 user-menu-options py-1">
                            <img src="assets/icons_user_menu/criar_nucleo.svg">
                            <span class="user-menu-options-span"> Criar Núcleo </span>
                        </article>
                    </a>
                    <a href="">
                        <article class="col-12 user-menu-options py-1">
                            <img src="assets/icons_user_menu/notifications.svg">
                            <span class="user-menu-options-span"> Notificações </span>
                        </article>
                    </a>
                    <a href="mudar_password.php">
                        <article class="col-12 user-menu-options py-1">
                            <img src="assets/icons_user_menu/change_pass.svg">
                            <span class="user-menu-options-span"> Mudar Password </span>
                        </article>
                    </a>
                    <a href="">
                        <article class="col-12 user-menu-options py-1">
                            <img src="assets/icons_user_menu/help.svg">
                            <span class="user-menu-options-span"> Ajuda </span>
                        </article>
                    </a>
                    <a href="">
                        <article class="col-12 user-menu-options py-1">
                            <img src="assets/icons_user_menu/settings.svg">
                            <span class="user-menu-options-span"> Mais Definições </span>
                        </article>
                    </a>
                </section>
                <section class="row section-2-user-menu">
                    <article class="col-12 art-2-user-menu">
                        <a href="scripts/sc_logout.php">
                            <div class="btn-logout">
                                Logout
                            </div>
                        </a>
                    </article>
                </section>
            </article>
            <article id="change_avatar" class="col-12" style="display: none;">
                <section class="row section-1-user-menu">
                    <article id="avatar" class="p-0 col-3 art-1-icon-user-menu position-relative">
                        <div id="profile_avatar" class="profile_pic" style='background-image: url("assets/img/user_profile.png")'></div>
                    </article>
                    <article class="p-0 col-9">
                        <section class="row ml-3">
                            <article class="p-0 col-12">
                                <strong> <?= $_SESSION['nome'] ?> </strong>
                            </article>
                            <article class="art-2-icon-user-menu p-0 col-12">
                                @<?= $_SESSION['nickname'] ?>
                            </article>
                        </section>
                    </article>
                </section>
                <form action="scripts/sc_mudar_avatar.php" method="post" id="avatar_change">
                <section class="row justify-content-center px-3">
                    <article class="col-4 check-avatar input-avatar_1 mb-3 mx-2">
                        <input for="avatar_change" name="avatar" id="avatar_1"
                               type="radio" value="avatar_1">
                    </article>
                    <article class="col-4 check-avatar input-avatar_2 mb-3 mx-2">
                        <input for="avatar_change" name="avatar" id="avatar_2"
                               type="radio" value="avatar_2">
                    </article>
                    <article class="col-4 check-avatar input-avatar_3 mb-3 mx-2">
                        <input for="avatar_change" name="avatar" id="avatar_3"
                               type="radio" value="avatar_3">
                    </article>
                    <article class="col-4 check-avatar input-avatar_4 mb-3 mx-2">
                        <input for="avatar_change" name="avatar" id="avatar_4"
                               type="radio" value="avatar_4">
                    </article>
                    <article class="col-4 check-avatar input-avatar_5 mb-3 mx-2">
                        <input for="avatar_change" name="avatar" id="avatar_5"
                               type="radio" value="avatar_5">
                    </article>
                    <article class="col-4 check-avatar input-avatar_6 mb-3 mx-2">
                        <input for="avatar_change" name="avatar" id="avatar_6"
                               type="radio" value="avatar_6">
                    </article>
                </section>
                <section class="row justify-content-center mt-3 mt-md-3">
                    <article class="col-md-12 mt-3 mt-md-5 px-4">
                        <input form="avatar_change" type="submit" class="mb-2 mb-md-2" style="display: block;"
                               value="Salvar" id="criar_nucleo_submit">
                    </article>
                </section>
                </form>
            </article>
        </section>
    </menu>
    <background id="background_user_menu" class="black-ground"></background>
</panel>

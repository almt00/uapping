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
        <section class="row section-1-user-menu">
            <article class="p-0 col-3 art-1-icon-user-menu position-relative">
                <img class="edit-profile-menu-user" src="assets/icons_user_menu/edit.svg">
                <img src="assets/img/user_profile.png">
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
            <a href="">
                <article class="col-12 user-menu-options py-1">
                    <img src="assets/icons_user_menu/change_interesses.svg">
                    <span class="user-menu-options-span"> Alterar Interesses </span>
                </article>
            </a>
            <a href="criar_nucleo.php">
                <article class="col-12 user-menu-options py-1">
                    <img src="assets/icons_user_menu/criar_nucleo.svg">
                    <span class="user-menu-options-span"> Criar núcleo </span>
                </article>
            </a>
            <a href="">
                <article class="col-12 user-menu-options py-1">
                    <img src="assets/icons_user_menu/notifications.svg">
                    <span class="user-menu-options-span"> Notificações </span>
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
                    <span class="user-menu-options-span"> Mais definições </span>
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
    </menu>
    <background id="background_user_menu" class="black-ground"></background>
</panel>


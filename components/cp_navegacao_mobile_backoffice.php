<nav class="container-fluid nav-mobile">
    <div class="row nav-mobile-row">
        <site class="col-3 text-center">
            <a href="home_page_backoffice.php">
                <?php if (isset($nav_homepage) && $nav_homepage === true){ ?>
                    <img src="assets/barra_navegacao/nav_home_filled.svg">
                <?php } else{ ?>
                    <img src="assets/barra_navegacao/nav_home.svg">
                <?php } ?>
            </a>
        </site>
        <site class="col-3 text-center">
            <a href="backoffice_users.php">
            <?php if (isset($nav_administradores) && $nav_administradores === true){ ?>
            <img src="assets/barra_navegacao/nav_administradores_filled.svg">
            <?php } else{ ?>
                <img src="assets/barra_navegacao/nav_administradores.svg">
            <?php } ?>
            </a>
        </site>
        <site class="col-3 text-center">
            <a href="backoffice_nucleos.php">
                <?php if (isset($nav_nucleo) && $nav_nucleo === true){ ?>
                    <img src="assets/barra_navegacao/nav_nucleo_filled.svg">
                <?php } else{ ?>
                    <img src="assets/barra_navegacao/nav_nucleo.svg">
                <?php } ?>
            </a>
        </site>
        <site class="col-3 text-center">
            <a href="">
            <?php if (isset($nav_estatisticas) && $nav_estatisticas === true){ ?>
            <img src="assets/barra_navegacao/nav_estatisticas_filled.svg">
            <?php } else{ ?>
                <img src="assets/barra_navegacao/nav_estatisticas.svg">
            <?php } ?>
            </a>
        </site>
    </div>
</nav>
<nav class="container-fluid nav-mobile">
    <div class="row nav-mobile-row">
        <site class="col-4 text-center">
            <a href="home_page_admin.php">
                <?php if (isset($nav_homepage) && $nav_homepage === true){ ?>
                    <img src="assets/barra_navegacao/nav_home_filled.svg">
                <?php } else{ ?>
                    <img src="assets/barra_navegacao/nav_home.svg">
                <?php } ?>
            </a>
        </site>
        <site class="col-4 text-center">
            <a href="admin_administradores.php">
            <?php if (isset($nav_administradores) && $nav_administradores === true){ ?>
            <img src="assets/barra_navegacao/nav_administradores_filled.svg">
            <?php } else{ ?>
                <img src="assets/barra_navegacao/nav_administradores.svg">
            <?php } ?>
            </a>
        </site>
        <site class="col-4 text-center">
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
<nav class="container-fluid nav-mobile display-md-off display-xs-block">
    <div class="row nav-mobile-row">
        <site class="col-4 text-center">
            <a href="home_page.php">
                <?php if (isset($nav_homepage) && $nav_homepage === true){ ?>
                    <img src="assets/barra_navegacao/nav_home_filled.svg">
                <?php } else{ ?>
                    <img src="assets/barra_navegacao/nav_home.svg">
                <?php } ?>
            </a>
        </site>
        <site class="col-4 text-center">
            <a href="nucleos.php">
            <?php if (isset($nav_nucleo) && $nav_nucleo === true){ ?>
            <img src="assets/barra_navegacao/nav_nucleo_filled.svg">
            <?php } else{ ?>
                <img src="assets/barra_navegacao/nav_nucleo.svg">
            <?php } ?>
            </a>
        </site>
        <site class="col-4 text-center">
            <a href="saved.php">
            <?php if (isset($nav_save) && $nav_save === true){ ?>
            <img src="assets/barra_navegacao/nav_save_filled.svg">
            <?php } else{ ?>
                <img src="assets/barra_navegacao/nav_save.svg">
            <?php } ?>
            </a>
        </site>
    </div>
</nav>
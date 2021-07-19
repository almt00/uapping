<!DOCTYPE html>
<html lang="pt">
<head>

    <?php include_once "helpers/help_css.php"?>

    <?php include_once "helpers/help_meta.php"?>

</head>
<body>

<script> backoffice_user = true; </script>

<?php $nav_homepage = true; ?>

<?php $pag_backoffice = true; ?>

<?php include_once "components/cp_header.php" ?>

<?php include_once "scripts/sc_check_backoffice.php" ?>

<?php include_once "components/cp_main_eventos_backoffice.php" ?>

<?php include_once "components/cp_navegacao_mobile_backoffice.php" ?>

<?php include_once "helpers/help_js.php"?>

<script src="js/switch_interesses.js" type="text/javascript"> </script>
<script>
    $(window).scroll(function () {
        // End of the document reached?
        if ($(document).height() - $(this).height() - 200 < $(this).scrollTop()) {
            alert('Scrolled to Bottom');
            console.log('fim');
        }
    });
</script>
</body>
</html>
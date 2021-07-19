<!DOCTYPE html>
<html lang="pt">
<head>

    <?php include_once "helpers/help_css.php"?>

    <?php include_once "helpers/help_meta.php"?>

</head>
<body>

<script> backoffice_user = true; </script>

<?php $nav_administradores = true; ?>

<?php $pag_backoffice = true; ?>


<?php include_once "components/cp_header.php" ?>

<?php include_once "scripts/sc_check_backoffice.php" ?>

<?php include_once "components/cp_backoffice_users.php" ?>

<?php include_once "components/cp_navegacao_mobile_backoffice.php" ?>

<?php include_once "helpers/help_js.php"?>

<script src="js/search_bars.js" type="text/javascript"> </script>
</body>
</html>
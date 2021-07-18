<!DOCTYPE html>
<html lang="pt">
<head>

    <?php include_once "helpers/help_css.php"?>

    <?php include_once "helpers/help_meta.php"?>

</head>
<body>

<script> admin_user = true; </script>

<?php $nav_homepage = true; ?>

<?php $pag_admin = true; ?>

<?php include_once "components/cp_header.php" ?>

<?php include_once "scripts/sc_check_admin.php" ?>

<?php include_once "components/cp_main_eventos_admin.php" ?>

<?php include_once "components/cp_navegacao_mobile_admin.php" ?>

<?php include_once "helpers/help_js.php"?>

<script src="js/switch_interesses.js" type="text/javascript"> </script>
</body>
</html>
<?php

require_once ('connections/connection.php');
if (!isset($_SESSION['id_nucleo_admin']) || $_SESSION['id_nucleo_admin'] == null){
    echo "<script>window.location.href='home_page.php'</script>";
}
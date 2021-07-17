<?php

require_once ('connections/connection.php');
if (!isset($_SESSION['backoffice']) || $_SESSION['backoffice'] != 1){
    echo "<script>window.location.href='home_page.php'</script>";

}
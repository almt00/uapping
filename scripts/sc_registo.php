<?php
require_once "../connections/connection.php";
$link = new_db_connection();
if (isset($_POST['nome']) && (isset($_POST['username'])) && (isset($_POST['email'])) && (isset($_POST['pass'])) &&
    (isset($_POST['pass_confirm'])) && (isset($_POST['departamento'])) && (isset($_POST['curso'])) )
header("Location: ../home_page.php");

// fiz teste à conexão da DB na hopepage e está a funcionar, no localhost pelo menos (Ana)
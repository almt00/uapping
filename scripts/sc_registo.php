<?php
require_once "../connections/connection.php";
$link = new_db_connection();
header("Location: ../home_page.php");

// fiz teste à conexão da DB na hopepage e está a funcionar, no localhost pelo menos (Ana)
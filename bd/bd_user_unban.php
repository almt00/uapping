<?php
require_once "../connections/connection.php";
// Create a new DB connection
$link = new_db_connection();
$id_utilizador = $_GET['id_user'];
$link = new_db_connection();
$stmt = mysqli_stmt_init($link);
//aqui tentar fazer o binding da variavel, para que não se coloque diretamente no codigo.
$query = "UPDATE utilizadores
        SET ativo_utilizador=1
        WHERE id_utilizador=?";

if (mysqli_stmt_prepare($stmt, $query)) {
    mysqli_stmt_bind_param($stmt, 'i',  $id_utilizador);
    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(array("statusCode"=>200));
    } else {
        echo json_encode(array("statusCode"=>201));
    }
    mysqli_stmt_close($stmt);
} else {
    echo("Error description: " . mysqli_error($link));
}
mysqli_close($link);




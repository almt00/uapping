<?php
require_once "../connections/connection.php";
$id_evento = $_GET['id_evento'];
session_start();
$id_utilizador=$_SESSION["id_user"];
$link = new_db_connection();
$stmt = mysqli_stmt_init($link);
$query = "DELETE 
            FROM eventos_guardados 
            WHERE eventos_guardados.utilizadores_id_utilizador= ? 
            AND eventos_guardados.eventos_id_evento= ?";

if (mysqli_stmt_prepare($stmt, $query)) {
    mysqli_stmt_bind_param($stmt, 'ii', $id_utilizador, $id_evento);
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


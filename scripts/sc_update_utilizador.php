<?php
if (isset($_GET['id']) && isset($_POST['role']) && (isset($_POST['bloquear']))) {
    $id_utilizador = $_GET['id'];
    $admin = $_POST['role'];
    $ativo = $_POST['bloquear'];
    require_once "../connections/connection.php";
    $link = new_db_connection();

    mysqli_begin_transaction($link);
    try {

        $stmt1 = mysqli_stmt_init($link);
        $query1 = "UPDATE utilizadores SET ativo_utilizador=? WHERE id_utilizador=?";
        mysqli_stmt_prepare($stmt1, $query1);
        mysqli_stmt_bind_param($stmt1, 'ii', $ativo, $id_utilizador);
        mysqli_stmt_execute($stmt1);

        mysqli_stmt_close($stmt1);
        $stmt2 = mysqli_stmt_init($link);
        $query2 = "UPDATE nucleos_membros SET admin_membro=? WHERE ref_id_utilizador=?";
        mysqli_stmt_prepare($stmt2, $query2);
        mysqli_stmt_bind_param($stmt2, 'ii', $admin, $id_utilizador);
        mysqli_stmt_execute($stmt2);
        mysqli_stmt_close($stmt2);

        mysqli_commit($link);
        header("Location: ../backoffice_users.php");
        die();

    } catch (mysqli_sql_exception $exception) {
        mysqli_rollback($link);
        throw $exception;
    }
    mysqli_close($link);
} else {
   echo 'erro post';
}
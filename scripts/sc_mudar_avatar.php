<?php
if (isset($_POST['avatar']) && $_POST['avatar']!=null) {
    $id_avatar=$_POST['avatar'];
    session_start();
    $id_utilizador=$_SESSION['id_user'];
    require_once "../connections/connection.php";
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    $query = "UPDATE utilizadores
          SET ref_id_avatar=?
          WHERE id_utilizador=?";
    mysqli_stmt_prepare($stmt, $query);
    mysqli_stmt_bind_param($stmt, 'ii', $id_avatar,$id_utilizador);
    if (mysqli_stmt_execute($stmt)) {
        header("Location: ../home_page.php"); // feedback aqui
        mysqli_stmt_close($stmt);
        mysqli_close($link);
        die();
    } else {
        mysqli_stmt_error($stmt);
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
}
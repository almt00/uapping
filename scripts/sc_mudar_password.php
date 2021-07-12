<?php
session_start();
if (isset($_POST['password_verify']) && (isset($_POST['password_nova']))) {
    require_once "../connections/connection.php";
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    $password = $_POST['password_verify'];
    $query = "SELECT password_hash_utilizador FROM utilizadores WHERE id_utilizador=?";
    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $_SESSION['id_user']);
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_bind_result($stmt, $password_hash);
            mysqli_stmt_fetch($stmt);
            if (!password_verify($password, $password_hash)) {
                // password errada
                echo mysqli_stmt_error($stmt) . mysqli_connect_error();
                mysqli_stmt_close($stmt);
                mysqli_close($link);
                header("Location: ../mudar_password.php?msg=1");
                die();
            } else {
                mysqli_stmt_close($stmt);
                if (isset($_POST['password_nova']) && $_POST['password_nova'] != '') {
                    $new_password_hash = password_hash($_POST['password_nova'], PASSWORD_DEFAULT);
                    $stmt = mysqli_stmt_init($link);
                    $query = "UPDATE utilizadores SET password_hash_utilizador=? WHERE id_utilizador=?";
                    if (mysqli_stmt_prepare($stmt, $query)) {
                        mysqli_stmt_bind_param($stmt, 'si', $new_password_hash, $_SESSION['id_user']);
                        if (mysqli_stmt_execute($stmt)) {
                            header("Location: ../home_page.php"); // alterar depois
                        } else {
                            header("Location: ../mudar_password.php");
                        }
                    }
                    mysqli_stmt_close($stmt);
                    mysqli_close($link);
                    die();
                } else {
                    header("Location: ../mudar_password.php");
                }
            }
        }
    }
}


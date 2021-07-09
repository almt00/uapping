<?php

require_once "../connections/connection.php";
$link = new_db_connection();
if (isset($_POST['email']) && (isset($_POST['pass']))) {
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    $query = "SELECT id_utilizador,password_hash_utilizador,nome_utilizador,nickname_utilizador,ativo_utilizador,backoffice FROM utilizadores
WHERE email_utilizador = ?";
    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 's', $email);
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_bind_result($stmt, $id_utilizador, $password_hash, $nome_utilizador, $nickname_utilizador, $ativo, $backoffice);
            if (mysqli_stmt_fetch($stmt)) {
                if (password_verify($password, $password_hash)) {
                    // Guardar sessão de utilizador
                    session_start();
                    $_SESSION["nome"] = $nome_utilizador;
                    $_SESSION["nickname"] = $nickname_utilizador;
                    $_SESSION["id_user"] = $id_utilizador;
                    $_SESSION["ativo"] = $ativo;
                    // Feedback de sucesso
                    header("Location: ../home_page.php");
                } else {
                    // Password está errada
                    header("Location: ../Log_In.php");
                }
                mysqli_stmt_close($stmt);
                mysqli_close($link);
            }
        } else {
            header("Location: ../index.php?msg=0#login"); // copiado n sei de onde mas era para o feedback
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($link);


}
header("Location: ../home_page.php");

// fiz teste à conexão da DB na hopepage e está a funcionar, no localhost pelo menos (Ana)
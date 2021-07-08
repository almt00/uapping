<?php
require_once "../connections/connection.php";
$link = new_db_connection();
if (isset($_POST['nome']) && (isset($_POST['username'])) && (isset($_POST['email'])) && (isset($_POST['pass'])) &&
    (isset($_POST['pass_confirm'])) && (isset($_POST['departamento'])) && (isset($_POST['curso']))) {
    $nome = $_POST['nome'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password_hash = password_hash($_POST['pass'], PASSWORD_DEFAULT);
    $id_curso = $_POST['curso'];
    // falta interesses rip
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    $query = "INSERT INTO utilizadores (nome_utilizador,nickname_utilizador,email_utilizador,password_hash_utilizador,ref_id_curso) VALUES (?,?,?,?,?)";
    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'ssssi', $nome, $username, $email, $password_hash, $id_curso);
        if (mysqli_stmt_execute($stmt)) {
            session_start();
            $_SESSION['id_user'] = mysqli_stmt_insert_id($stmt); // colocar id
            $_SESSION['username'] = $username;
            // $_SESSION["role"] = $id_roles;
            header("Location: ../index.php?msg=1#login");
        } else {
            header("Location: ../index.php?msg=0#login");
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($link);


}
header("Location: ../home_page.php");

// fiz teste à conexão da DB na hopepage e está a funcionar, no localhost pelo menos (Ana)
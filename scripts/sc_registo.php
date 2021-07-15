<?php
require_once "../connections/connection.php";

if (isset($_POST['nome']) && (isset($_POST['username'])) && (isset($_POST['email'])) && (isset($_POST['pass'])) &&
    (isset($_POST['pass_confirm'])) && (isset($_POST['departamento'])) && (isset($_POST['curso']))) {
    $nome_utilizador = $_POST['nome'];
    $nickname_utilizador = $_POST['username'];
    $email = $_POST['email'];
    $password_hash = password_hash($_POST['pass'], PASSWORD_DEFAULT);
    $id_curso = $_POST['curso'];
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    $query = "INSERT INTO utilizadores (nome_utilizador,nickname_utilizador,email_utilizador,password_hash_utilizador,ref_id_curso) VALUES (?,?,?,?,?)";
    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'ssssi', $nome_utilizador, $nickname_utilizador, $email, $password_hash, $id_curso);
        if (mysqli_stmt_execute($stmt)) {
            $id_user = mysqli_stmt_insert_id($stmt);
            session_start();
            $_SESSION['id_user'] = mysqli_stmt_insert_id($stmt); // colocar id
            $_SESSION["nome"] = $nome_utilizador;
            $_SESSION["nickname"] = $nickname_utilizador;
            // $_SESSION["ativo"] = $ativo;
            // $_SESSION["role"] = $id_roles;
            mysqli_stmt_close($stmt);
            mysqli_close($link);
            $link = new_db_connection();
//para dar vários interesses a serem inseridos na bd sem problemas
            if(!isset($_POST['interesses'])){
                header("Location: ../home_page.php"); // copiado n sei de onde mas era para o feedback
            }else{
                $id_interesses = $_POST['interesses'];
                //var_dump($id_interesses);exit;
                foreach ($id_interesses as $interesse) {
                    $link = new_db_connection();
                    $stmt2 = mysqli_stmt_init($link);
                    $query2 = "INSERT INTO utilizadores_has_interesses (utilizadores_id_utilizador,interesses_id_interesse) VALUES (?,?)";
                    if (mysqli_stmt_prepare($stmt2, $query2)) {
                        mysqli_stmt_bind_param($stmt2, 'ii', $id_user, $interesse);
                        if (mysqli_stmt_execute($stmt2)) {
                            header("Location: ../home_page.php"); // copiado n sei de onde mas era para o feedback
                        } else {
                            echo 'erro5';
                            mysqli_error($link);
                            header("Location: ../sign_up.php"); // adicionar msg de erro
                        }
                        mysqli_stmt_close($stmt2);
                    } else {
                        echo 'erro4';
                        header("Location: ../sign_up.php"); // adicionar msg de erro
                    }
                    mysqli_close($link);
                }
            }
        } else {
            echo 'erro execute';
            header("Location: ../sign_up.php"); // adicionar msg de erro
            mysqli_error($link);
            mysqli_stmt_close($stmt);
            mysqli_close($link);
        }
    }
} else {
    header("Location: ../sign_up.php"); // adicionar msg de erro
}
// fiz teste à conexão da DB na hopepage e está a funcionar, no localhost pelo menos (Ana)
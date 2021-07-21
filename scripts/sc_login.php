<?php
require_once "../connections/connection.php";
$link = new_db_connection();
if (isset($_POST['email']) && (isset($_POST['pass']))) {
    // var_dump($_POST);
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    $query = "SELECT id_utilizador,password_hash_utilizador,nome_utilizador,nickname_utilizador,ativo_utilizador,backoffice FROM utilizadores
                WHERE email_utilizador = ?";
    if (mysqli_stmt_prepare($stmt, $query)) {
        // echo 'teste1';
        mysqli_stmt_bind_param($stmt, 's', $email);
        if (mysqli_stmt_execute($stmt)) {
            // echo 'teste2';
            mysqli_stmt_bind_result($stmt, $id_utilizador, $password_hash, $nome_utilizador, $nickname_utilizador, $ativo, $backoffice);
            if (mysqli_stmt_fetch($stmt)) {
                // echo 'teste3';
                if (password_verify($password, $password_hash)) {
                    // Guardar sessão de utilizador
                    session_start();
                    $_SESSION["nome"] = $nome_utilizador;
                    $_SESSION["nickname"] = $nickname_utilizador;
                    $_SESSION["id_user"] = $id_utilizador;
                    $_SESSION["ativo"] = $ativo;
                    $_SESSION["backoffice"] = $backoffice;
                    mysqli_stmt_close($stmt);

                    $stmt1 = mysqli_stmt_init($link);
                    $query1 = "SELECT nucleos_membros.ref_id_nucleo FROM nucleos_membros
                            INNER JOIN nucleos_oficiais
                            ON nucleos_membros.ref_id_nucleo=nucleos_oficiais.ref_id_nucleo
                            WHERE nucleos_membros.ref_id_utilizador=?";
                    if (mysqli_stmt_prepare($stmt1, $query1)) {
                        mysqli_stmt_bind_param($stmt1, 'i', $_SESSION["id_user"]);
                        mysqli_stmt_execute($stmt1);
                        mysqli_stmt_bind_result($stmt1, $id_nucleo);
                        mysqli_stmt_store_result($stmt1);
                        mysqli_stmt_fetch($stmt1);

                        mysqli_stmt_store_result($stmt1);
                        $rows = mysqli_stmt_num_rows($stmt1);
                        echo 'id_nucleo: ' . $id_nucleo;
                        echo 'rows: ' . $rows;
                        if ($rows == 1) {
                            echo 'ha rows';
                            $_SESSION['id_nucleo_admin'] = $id_nucleo;
                        } else {
                            unset($_SESSION['id_nucleo_admin']);
                        }
                    }
                    mysqli_stmt_close($stmt1);
                    mysqli_close($link);
                    var_dump($_SESSION);
                    // Feedback de sucesso
                    header("Location: ../home_page.php");
                    die();
                } else {
                    // Password está errada
                    header("Location: ../log_in.php?msg=1");
                }
                //mysqli_stmt_close($stmt);
                // mysqli_close($link);
            } else {
                  header("Location: ../log_in.php?msg=1");
            }
        }
    }
}

// fiz teste à conexão da DB na hopepage e está a funcionar, no localhost pelo menos (Ana)
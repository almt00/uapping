<?php
require_once "../connections/connection.php";

$link = new_db_connection();

if (isset($_POST['email']) && (isset($_POST['pass']))) {

    $email = $_POST['email'];
    $password = $_POST['pass'];
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT 
                id_utilizador,
                password_hash_utilizador,
                nome_utilizador,
                nickname_utilizador,
                ativo_utilizador,
                backoffice 
                FROM 
                utilizadores
                WHERE email_utilizador = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 's', $email);
        if (mysqli_stmt_execute($stmt)) {

            mysqli_stmt_bind_result($stmt, $id_utilizador, $password_hash, $nome_utilizador, $nickname_utilizador, $ativo, $backoffice);
            if (mysqli_stmt_fetch($stmt)) {

                if (password_verify($password, $password_hash)) {
                    // GUARDAR SESSAO UTILIZADOR
                    session_start();
                    $_SESSION["nome"] = $nome_utilizador;
                    $_SESSION["nickname"] = $nickname_utilizador;
                    $_SESSION["id_user"] = $id_utilizador;
                    $_SESSION["ativo"] = $ativo;
                    $_SESSION["backoffice"] = $backoffice;

                    mysqli_stmt_close($stmt);

                    $stmt1 = mysqli_stmt_init($link);

                    $query1 = "SELECT nucleos_membros.ref_id_nucleo 
                            FROM nucleos_membros
                            INNER JOIN nucleos_oficiais
                            ON nucleos_membros.ref_id_nucleo = nucleos_oficiais.ref_id_nucleo
                            WHERE nucleos_membros.ref_id_utilizador = ?";

                    if (mysqli_stmt_prepare($stmt1, $query1)) {
                        mysqli_stmt_bind_param($stmt1, 'i', $_SESSION["id_user"]);
                        mysqli_stmt_execute($stmt1);
                        mysqli_stmt_bind_result($stmt1, $id_nucleo);
                        mysqli_stmt_store_result($stmt1);
                        mysqli_stmt_fetch($stmt1);

                        mysqli_stmt_store_result($stmt1);
                        $rows = mysqli_stmt_num_rows($stmt1);
                        if ($rows == 1) {
                            $_SESSION['id_nucleo_admin'] = $id_nucleo;
                        } else {
                            unset($_SESSION['id_nucleo_admin']);
                        }
                    }
                    mysqli_stmt_close($stmt1);
                    mysqli_close($link);

                    header("Location: ../home_page.php");// SUCESSO
                    exit;
                } else {
                    header("Location: ../log_in.php?msg=1");// PASSWORD ERRADA
                    exit;
                }
            } else {
                  header("Location: ../log_in.php?msg=1");// EMAIL ERRADO
                exit;
            }
        }
    }
}

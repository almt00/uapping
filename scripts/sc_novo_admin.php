<?php
session_start();
//include_once "../components/cp_admin_administradores.php";
if (isset($_POST['username']) && (isset($_POST['email']))) {
    $id_nucleo = $_SESSION['id_nucleo_admin'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $id_admin = 1;

    require_once "../connections/connection.php";
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    $query = "SELECT utilizadores.id_utilizador,utilizadores.email_utilizador,utilizadores.nickname_utilizador FROM utilizadores
            WHERE utilizadores.email_utilizador=? AND utilizadores.nickname_utilizador=?";
    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'ss', $email, $username);
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_bind_result($stmt, $id_utilizador, $email_utilizador, $nickname_utilizador);
            if (mysqli_stmt_fetch($stmt)) {
                mysqli_stmt_close($stmt);
                mysqli_close($link);

                $link2 = new_db_connection();
                $stmt2 = mysqli_stmt_init($link2);
                $query2 = "INSERT INTO nucleos_membros (ref_id_nucleo,ref_id_utilizador,admin_membro) VALUES (?,?,?)";
                if (mysqli_stmt_prepare($stmt2, $query2)) {
                    mysqli_stmt_bind_param($stmt2, 'iii', $id_nucleo, $id_utilizador, $id_admin);
                    if (mysqli_stmt_execute($stmt2)) {
                        header("Location:../admin_administradores.php");
                        mysqli_stmt_close($stmt2);
                        mysqli_close($link2);
                        die();
                    }

                }

            }


        }
        header("Location:../admin_novo_admin.php?msg=1");
        mysqli_stmt_close($stmt);
        mysqli_close($link);
        die();
    }
}
<?php
require_once "../connections/connection.php";
if ((isset($_POST['nome'])) && (isset($_POST['sigla'])) && (isset($_POST['descricao'])) && (isset($_POST['area']))) {
    $nome_nucleo = $_POST['nome'];
    $area = $_POST['area'];
    $sigla = $_POST['sigla'];
    $descricao = $_POST['descricao'];
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    $query = "INSERT INTO nucleos (nome_nucleo,descricao_nucleo,sigla_nucleo) VALUES (?,?,?)";
    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'sss', $nome_nucleo, $descricao, $sigla);
        if (mysqli_stmt_execute($stmt)) {
            $id_nucleo = mysqli_stmt_insert_id($stmt);
            mysqli_stmt_close($stmt);
            mysqli_close($link);
            $link = new_db_connection();
            $stmt2 = mysqli_stmt_init($link);
            $cor = 1;
            $query2 = "INSERT INTO nucleos_fantasmas (ref_id_nucleo,ref_id_cor_fantasma) VALUES (?,?)";
            if (mysqli_stmt_prepare($stmt2, $query2)) {
                mysqli_stmt_bind_param($stmt2, 'ii', $id_nucleo, $cor);
                if (mysqli_stmt_execute($stmt2)) {
                    mysqli_stmt_close($stmt2);
                    mysqli_close($link);
                    $link = new_db_connection();
                    $stmt3 = mysqli_stmt_init($link);
                    $query3 = "INSERT INTO nucleos_has_interesses (nucleos_id_nucleo,interesses_id_interesse) VALUES (?,?)";
                    if (mysqli_stmt_prepare($stmt3, $query3)) {
                        mysqli_stmt_bind_param($stmt3, 'ii', $id_nucleo, $area);
                        if (mysqli_stmt_execute($stmt3)) {
                            header("Location: ../nucleos.php");
                        } else {
                            echo 'erro5';
                            mysqli_error($link);
                            header("Location: ../nucleos.php"); // adicionar msg de erro
                        }
                        mysqli_stmt_close($stmt3);
                    } else {
                        echo 'erro4';
                        header("Location: ../nucleos.php"); // adicionar msg de erro
                    }
                } else {
                    echo 'erro5';
                    mysqli_error($link);
                    header("Location: ../nucleos.php"); // adicionar msg de erro
                }
                mysqli_stmt_close($stmt2);
            } else {
                echo 'erro4';
                header("Location: ../nucleos.php"); // adicionar msg de erro
            }
        } else {
            echo 'erro execute';
            header("Location: ../nucleos.php"); // adicionar msg de erro
            mysqli_error($link);
            mysqli_stmt_close($stmt);
            mysqli_close($link);
        }
    }
} else {
    var_dump($_POST);
    header("Location: ../nucleos.php"); // adicionar msg de erro
}
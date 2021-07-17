<?php
require_once "../connections/connection.php";

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);
$query = "SELECT id_interesse, nome_interesse FROM interesses";
if (mysqli_stmt_prepare($stmt, $query)) {
    $data = array('interesses' => array(), 'nucleos' => array());
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_bind_result($stmt,  $id_interesse, $nome_interesse);

        while (mysqli_stmt_fetch($stmt)) {
            $row_result = array();
            $row_result["id_interesse"] = htmlspecialchars($id_interesse);
            $row_result["nome_interesse"] = htmlspecialchars($nome_interesse);
            $data['interesses'][] = $row_result;
        }
        $stmt2 = mysqli_stmt_init($link);
        $query2 = "SELECT id_nucleo, nome_nucleo FROM nucleos";
        if (mysqli_stmt_prepare($stmt2, $query2)) {
            if (mysqli_stmt_execute($stmt2)) {
                mysqli_stmt_bind_result($stmt2,  $id_nucleo, $nome_nucleo);
                while (mysqli_stmt_fetch($stmt2)) {
                    $row_result = array();
                    $row_result["id_nucleo"] = htmlspecialchars($id_nucleo);
                    $row_result["nome_nucleo"] = htmlspecialchars($nome_nucleo);
                    $data['nucleos'][] = $row_result;
                }

            } else {
                echo "Error:" . mysqli_stmt_error($stmt2);
            }
            mysqli_stmt_close($stmt2);

    } else {
        echo "Error:" . mysqli_stmt_error($stmt);
    }

        print json_encode($data);
    mysqli_stmt_close($stmt);
} else {
    echo("Error description: " . mysqli_error($link));
}
}
mysqli_close($link);


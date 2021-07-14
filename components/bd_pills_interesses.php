<?php
require_once "../connections/connection.php";

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);
$query = "SELECT nucleos.id_nucleo, nucleos.nome_nucleo,
GROUP_CONCAT(nucleos_has_interesses.interesses_id_interesse) AS 'interesses_id', GROUP_CONCAT(interesses.nome_interesse) AS 'interesses_nome'
FROM nucleos
INNER JOIN nucleos_has_interesses ON nucleos.id_nucleo = nucleos_has_interesses.nucleos_id_nucleo
INNER JOIN interesses ON nucleos_has_interesses.interesses_id_interesse = interesses.id_interesse
GROUP BY nucleos.id_nucleo";


if (mysqli_stmt_prepare($stmt, $query)) {
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_bind_result($stmt, $id_nucleo, $nome_nucleo, $id_interesse, $nome_interesse);
        $data = array();
        while (mysqli_stmt_fetch($stmt)) {
            $row_result = array();
            $row_result["id_interesse"] = htmlspecialchars($id_interesse);
            $row_result["nome_interesse"] = htmlspecialchars($nome_interesse);
            $row_result["nome_nucleo"] = htmlspecialchars($nome_nucleo);
            $row_result["id_nucleo"] = htmlspecialchars($id_nucleo);
            $data[] = $row_result;
        }
        print json_encode($data);
    } else {
        echo "Error:" . mysqli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);
} else {
    echo("Error description: " . mysqli_error($link));
}
mysqli_close($link);


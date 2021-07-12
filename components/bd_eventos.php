<?php
require_once "../connections/connection.php";
$link = new_db_connection();
$stmt = mysqli_stmt_init($link);
$query = "SELECT eventos.id_evento,eventos.nome_evento, eventos.data_evento,TIME_FORMAT(eventos.hora_evento,'%H:%i'),eventos.imagem_evento,eventos.ref_id_nucleo, nucleos_oficiais.imagem_oficial 
                        FROM eventos
                        INNER JOIN nucleos_oficiais
                        ON eventos.ref_id_nucleo=nucleos_oficiais.ref_id_nucleo  
                        ORDER BY eventos.data_evento ASC";
if (mysqli_stmt_prepare($stmt, $query)) {
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_bind_result($stmt, $id_evento, $nome_evento, $data_evento, $hora_evento, $imagem_evento, $id_nucleo, $imagem_oficial);
        $data = array();
        while (mysqli_stmt_fetch($stmt)) {
            $row_result = array();
            $row_result["id_evento"] = htmlspecialchars($id_evento);
            $row_result["nome"] = htmlspecialchars($nome_evento);
            $row_result["data"] = htmlspecialchars($data_evento);
            $row_result["hora"] = htmlspecialchars($hora_evento);
            $row_result["imagem"] = htmlspecialchars($imagem_evento);
            $row_result["id_nucleo"] = htmlspecialchars($id_nucleo);
            $row_result["imagem_nucleo"] = htmlspecialchars($imagem_oficial);
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
?>
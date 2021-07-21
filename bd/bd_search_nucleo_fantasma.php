<?php
require_once "../connections/connection.php";
// Create a new DB connection
$link = new_db_connection();
$result = $_GET['search'];
$search=mysqli_real_escape_string($link,$result);
$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$query = "SELECT nucleos.id_nucleo, nucleos.nome_nucleo, nucleos.sigla_nucleo, cores_fantasmas.nome_cor_fantasma 
FROM nucleos 
    INNER JOIN nucleos_fantasmas 
        ON nucleos.id_nucleo=nucleos_fantasmas.ref_id_nucleo 
    INNER JOIN cores_fantasmas 
        ON nucleos_fantasmas.ref_id_cor_fantasma=cores_fantasmas.id_cor_fantasma 
WHERE nucleos.nome_nucleo LIKE '%$search%'";

if (mysqli_stmt_prepare($stmt, $query)) {
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_bind_result($stmt, $id_nucleo, $nome_nucleo, $sigla_nucleo, $cor);
        /* fetch values */
        $data = array();
        while (mysqli_stmt_fetch($stmt)) {
            $row_result = array();
            $row_result["id_nucleo"] = htmlspecialchars($id_nucleo);
            $row_result["nome"] = htmlspecialchars($nome_nucleo);
            $row_result["sigla"] = htmlspecialchars($sigla_nucleo);
            $row_result["cor"] = htmlspecialchars($cor);
            $data[] = $row_result;
        }
        print json_encode($data);
    } else {
        echo "Error: " . mysqli_stmt_error($stmt);
    }
    /* close statement */
    mysqli_stmt_close($stmt);
} else {
    echo "Error: " . mysqli_error($link);

}
/* close connection */
mysqli_close($link);


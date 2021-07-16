<?php
require_once "../connections/connection.php";
$id_selected_dep = $_GET['departamento'];
$link = new_db_connection();
$stmt = mysqli_stmt_init($link);
$query = "SELECT id_curso, nome_curso FROM cursos 
WHERE ref_id_departamento = ?";
if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $id_selected_dep);
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_bind_result($stmt, $id_curso, $nome_curso);
        $data = array();
        while (mysqli_stmt_fetch($stmt)) {
            $row_result = array();
            $row_result["id_curso"] = htmlspecialchars($id_curso);
            $row_result["nome_curso"] = htmlspecialchars($nome_curso);
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



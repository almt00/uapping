<?php
require_once "../connections/connection.php";
// Create a new DB connection
$link = new_db_connection();
$result = $_GET['search'];
$search=mysqli_real_escape_string($link,$result);
$link = new_db_connection();
$stmt = mysqli_stmt_init($link);
$query = "SELECT utilizadores.id_utilizador,utilizadores.nome_utilizador,utilizadores.nickname_utilizador,utilizadores.ref_id_avatar,utilizadores.ativo_utilizador,nucleos_membros.admin_membro FROM utilizadores
                        LEFT JOIN nucleos_membros
                        ON utilizadores.id_utilizador=nucleos_membros.ref_id_utilizador WHERE utilizadores.nome_utilizador LIKE '%$search%' ";
if (mysqli_stmt_prepare($stmt, $query)) {
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_bind_result($stmt, $id_utilizador, $nome, $nickname, $avatar, $ativo, $admin_normal);        /* fetch values */
        $data = array();
        while (mysqli_stmt_fetch($stmt)) {
            $row_result = array();
            $row_result["id_utilizador"] = htmlspecialchars($id_utilizador);
            $row_result["nome"] = htmlspecialchars($nome);
            $row_result["nick"] = htmlspecialchars($nickname);
            $row_result["avatar"] = htmlspecialchars($avatar);
            $row_result["ativo"] = htmlspecialchars($ativo);
            $row_result["admin"] = htmlspecialchars($admin_normal);

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

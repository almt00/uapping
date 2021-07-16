<?php
session_start();
$data_evento = date("Y-m-d", strtotime($_POST['data']));
$hora_evento = date("H:i:s", strtotime($_POST['hora']));
echo $data_evento . ' e ' . $hora_evento;
if ((isset($_POST['nome_evento'])) && (isset($_POST['data'])) && (isset($_POST['hora'])) && (isset($_POST['descricao']))) {
    $nome_evento = $_POST['nome_evento'];
    $data_evento = date("Y-m-d", strtotime($_POST['data']));
    $hora_evento = date("H:i:s", strtotime($_POST['hora']));

    if (isset($_POST['morada']) && $_POST['morada'] != null) {
        $morada = $_POST['morada'];
    } else {
        $morada = 'online';
    }

    if (isset($_POST['preco']) && $_POST['preco'] != null) {
        $preco = $_POST['preco'];
    } else {
        $preco = NULL;
    }

    if (isset($_FILES["fileToUpload"]["tmp_name"]) && $_FILES["fileToUpload"]["tmp_name"] != '') {
        $target_dir = "../assets/img/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                //$uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;

            }
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500 * 1024) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded. <br>";
                $nome_img = htmlspecialchars(basename($_FILES["fileToUpload"]["name"]));
            }
        }


        // $img_capa = $_POST['capa_evento'];
        $descricao = $_POST['descricao'];
        $id_nucleo = $_SESSION['id_nucleo_admin'];
        print_r($nome_img);
        require_once "../connections/connection.php";
        $link = new_db_connection();
        $stmt = mysqli_stmt_init($link);
        $query = "INSERT INTO eventos (nome_evento,data_evento,hora_evento,local_evento,preco_evento,imagem_evento,descricao_evento,ref_id_nucleo) 
            VALUES (?,?,?,?,?,?,?,?)";
        if (mysqli_stmt_prepare($stmt, $query)) {
            mysqli_stmt_bind_param($stmt, 'ssssissi', $nome_evento, $data_evento, $hora_evento, $morada,$preco, $nome_img, $descricao, $id_nucleo);
            if (mysqli_stmt_execute($stmt)) {
               // echo 'sucesso';
                header("Location: ../home_page_admin.php");
                mysqli_stmt_close($stmt);
                mysqli_close($link);
                die();
            } else {
                echo 'erro exe';
                mysqli_stmt_error($stmt);
                mysqli_stmt_close($stmt);
            }
        } else {
            echo 'erro prepare';
            mysqli_stmt_close($stmt);
        }
    }
} else {
    echo 'erro post';
}
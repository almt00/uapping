<?php
session_start();
$data_evento = date("Y-m-d",strtotime($_POST['data']));
$hora_evento = date("H:i:s",strtotime($_POST['hora']));
echo $data_evento.' e '.$hora_evento;
if ((isset($_POST['nome_evento'])) && (isset($_POST['data'])) && (isset($_POST['hora'])) && (isset($_POST['area_1'])) && (isset($_POST['area_2'])) && (isset($_POST['capa_evento'])) && (isset($_POST['descricao']))) {
    $nome_evento = $_POST['nome_evento'];
    $data_evento = date("Y-m-d",strtotime($_POST['data']));
    $hora_evento = date("H:i:s",strtotime($_POST['hora']));
    $area = $_POST['area_1'];
    $area_opcional = $_POST['area_2'];
    $img_capa = $_POST['capa_evento'];
    $descricao = $_POST['descricao'];


}
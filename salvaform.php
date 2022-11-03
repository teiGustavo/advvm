<?php
    include "conexao.php";

    $data = $_POST['data'];
    $historico = $_POST['historico'];
    $valor = $_POST['valor'];

    if (isset($_POST['btn-entradas'])) {
        $tipo = 'Entrada';
    } else if(isset($_POST['btn-saidas'])) {
        $tipo = 'Saida';
    } else {
        $tipo = $_POST['tipo'];
    }

    $sql = "INSERT INTO relatorio(data, historico, tipo, valor) VALUES ('$data', '$historico', '$tipo', $valor)";
    mysqli_query($conexao, $sql);

    if (isset($_POST['btn-entradas'])) {
        header("location: entradas.php");
    } else if(isset($_POST['btn-saidas'])) {
        header("location: saidas.php");
    } else {
        header("location: index.php");
    }
?>
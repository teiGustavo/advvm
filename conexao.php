<?php
    $servidor = "localhost";
    $usuario = "root";
    $senha = "root";
    $banco = "id19770428_bd_relatorio";

    $conexao = mysqli_connect($servidor, $usuario, 
            $senha, $banco);

    if(mysqli_connect_errno()){
        echo "Erro ao conectar com o banco";
        die();
    }

//TESTEE
?>

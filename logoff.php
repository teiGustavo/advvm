<?php
    session_start();

    $_SESSION["logado"] = 0;
    $_SESSION["adm"] = 0;

    header("location: login.php");
?>
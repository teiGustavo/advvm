<?php
    if (!isset($_SESSION)) {
        session_start();
    }

    //Anular Sessions
    $_SESSION["logado"] = 0;
    $_SESSION["adm"] = 0;

    //Apagar Cookie
    setcookie("Adm", null, -1);

    header("location: login.php");
?>
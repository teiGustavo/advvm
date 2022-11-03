<?php
    if (!isset($_SESSION)) {
        session_start();
    } else if (!isset($_SESSION['adm'])) {
        $_SESSION['adm'] = 0;
    } else if (!isset($_SESSION['logado'])) {
        $_SESSION['logado'] = 0;
    }

    /*if ($_SESSION['logado'] == 0) {
        header("location: login.php");
    }*/
?>
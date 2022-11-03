<?php
    if (!isset($_SESSION)) {
        session_start();
    } else if (!isset($_SESSION['adm'])) {
        $_SESSION['adm'] = 0;
    }
?>
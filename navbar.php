<?php
    include "conexao.php";
    include "verificaSessao.php";
    
    $adm = $_SESSION["adm"];

    if ($adm == 1) {
        echo "<div class='nvb'>";
            echo "<nav class='navbar'>";
                echo "<a href='index.php' class='logo'>ADVVM</a>";
                echo "<div class='nav-links' id='nav-links'>";
                    echo "<ul>";
                        echo "<li class='active' id='li-one'><a href='index.php'>Cadastro de Relatorio</a></li>";
                        echo "<li id='li-two'><a href='consulta.php'>Consulta de Relatorio</a></li>";
                        echo "<li id='li-three'><a href='entradas.php'>Entradas</a></li>";
                        echo "<li id='li-four'><a href='saidas.php'>Saídas</a></li>";
                        echo "<li><a href='logoff.php'>Sair</a></li>";
                    echo "</ul>";
                echo "</div>";
                echo "<button type='button' onclick='apareceMenu()' id='btn-btn-menu' class='btn-btn-menu'><img src='styles/img/menu.svg' alt='menu' class='btn-menu'></button>";
            echo "</nav>";
        echo "</div>";

        echo "<div class='nav-links-two' id='nav-links-two'>";
            echo "<ul>";
            echo "<li class='active' id='li-one-two'><a href='index.php'>Cadastro de Relatorio</a></li>";
            echo "<li id='li-two-two'><a href='consulta.php'>Consulta de Relatorio</a></li>";
            echo "<li id='li-three-two'><a href='entradas.php'>Entradas</a></li>";
            echo "<li id='li-four-two'><a href='saidas.php'>Saídas</a></li>";
            echo "<li><a href='logoff.php'>Sair</a></li>";
            echo "</ul>";
        echo "</div>";   
    } else {
        echo "<div class='nvb'>";
            echo "<nav class='navbar'>";
                echo "<a href='index.php' class='logo'>ADVVM</a>";
                echo "<div class='nav-links' id='nav-links'>";
                    echo "<ul>";
                        echo "<li class='active' id='li-one'><a href='index.php'>Cadastro de Relatorio</a></li>";
                        echo "<li id='li-two'><a href='consulta.php'>Consulta de Relatorio</a></li>";
                        echo "<li id='li-three-two'><a href='login.php'>Logar</a></li>";
                    echo "</ul>";
                echo "</div>";
                echo "<button type='button' onclick='apareceMenu()' id='btn-btn-menu' class='btn-btn-menu'><img src='styles/img/menu.svg' alt='menu' class='btn-menu'></button>";
            echo "</nav>";
        echo "</div>";

        echo "<div class='nav-links-two' id='nav-links-two'>";
            echo "<ul>";
            echo "<li class='active' id='li-one-two'><a href='index.php'>Cadastro de Relatorio</a></li>";
            echo "<li id='li-two-two'><a href='consulta.php'>Consulta de Relatorio</a></li>";
            echo "<li id='li-three-two'><a href='login.php'>Logar</a></li>";
            echo "</ul>";
        echo "</div>";
    }
?> 
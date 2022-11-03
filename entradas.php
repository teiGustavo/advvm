<?php
   include "verificaSessao.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles/main.css">
        <title>Cadastro de Entradas</title>
    </head>
    <body onload="pagEntradas()">
        <?php include "navbar.php"; ?>   

        <div class="main-login" id="main-login">
            <div class="left-login">
                
                <img src="styles/img/data-report-animate.svg" class="left-login-image" alt="Astronauta animação">
            </div>

            <form action="salvaform.php" method="POST">
                <div class="right-login">
                    <div class="card-login">
                        <h1>ENTRADA</h1>
                        <div class="textfield">
                            <label for="data">Data</label>
                            <input type="date" name="data" placeholder="dd/mm/aaaa" required>
                        </div>
                        <div class="textfield">
                            <label for="historico">Histórico</label>
                            <input type="text" name="historico" placeholder="Escreva o lançamento..." required>
                        </div>
                        <div class="textfield">
                            <label for="valor">Valor do lançamento</label>
                            <input type="text" name="valor" placeholder="Valor" pattern="[0.-9.]*" required>
                        </div>
                        <button type="submit" class="btn-login" name="btn-entradas">CADASTRAR ENTRADA</button>
                    </div>
                </div>
            </form>

        </div>

    </body>

    <script src="JS/jquery-3.6.0.min.js"></script>
    <script src="JS/funcoes.js"></script>
</html>
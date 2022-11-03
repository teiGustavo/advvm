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
        <title>Login</title>
    </head>
    <body onload="nvb()">
        <div class="main-login" id="main-login">
            <div class="left-login">
                <h1>Faça login!<br>A.D Videira Verdadeira</h1>
                <img src="styles/img/audit-animate.svg" class="left-login-image" alt="Astronauta animação">
            </div>

            <form method="POST">
                <div class="right-login">
                    <div class="card-login">
                        <h1>LOGIN</h1>
                        <div class="textfield">
                            <label for="Email">E-mail</label>
                            <input type="email" name="Email" placeholder="Insira seu e-mail aqui" required>
                        </div>
                        <div class="textfield">
                            <label for="Senha">Senha</label>
                            <input type="password" name="Senha" placeholder="Insira sua senha aqui" required>
                        </div>
                        <button type="submit" class="btn-login" name="btn-logar">LOGAR</button>
                    </div>
                </div>
            </form>

        </div>

        <?php 
            include "conexao.php";

            if (isset($_POST['btn-logar'])) {
                $email = $_POST['Email'];
                $senha = $_POST['Senha'];

                $sql = "SELECT * FROM usuario WHERE email = '$email' AND senha = '$senha'";
                $result = mysqli_query($conexao, $sql);
                $row = mysqli_num_rows($result);

                if ($row == 1) {
                    $_SESSION['logado'] = 1;
                    $sql = "SELECT adm FROM usuario";
                    $result = mysqli_query($conexao, $sql);
                    $a = mysqli_fetch_array($result);
                    $_SESSION["adm"] = $a[0];
                    
                    header("location: index.php");
                } else {
                    $_SESSION['logado'] = 0;

                }
            }
        ?>

    </body>

    <script src="JS/funcoes.js"></script>

</html>
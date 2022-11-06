<?php
    include "conexao.php";
    include "verificaSessao.php";

    //Tempo em segundos (3600 segundos * 24 = 24 horas ou 86400 segundos)
    $cookietime = time() + (3600 * 24);

    if (isset($_COOKIE["Adm"])) {
        $_SESSION['logado'] = 1;
        header("location: index.php");
    }

    if (isset($_POST['btn-logar'])) {
        $email = $_POST['Email'];
        $senha = md5($_POST['Senha']);

        $sqlLogin = "SELECT * FROM usuario WHERE email = '$email' AND senha = '$senha'";
        $resultadoLogin = mysqli_query($conexao, $sqlLogin);
        $row = mysqli_num_rows($resultadoLogin);

        if ($row == 1) {
            $_SESSION['logado'] = 1;
            $sql = "SELECT adm FROM usuario";
            $result = mysqli_query($conexao, $sql);
            $a = mysqli_fetch_array($result);
            $_SESSION["adm"] = $a[0];

            if ($_POST['Manter'] == "Manter") {
                //Cria cookie do Administrador (Tempo é dado em segundos)
                setcookie("Adm", $email, $cookietime);
            }
            
            header("location: index.php");
        } else {
            $_SESSION['logado'] = 0;
            //echo "Administrador não encontrado!";
        }
    }
        
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
    <body onload="pagLogin()">
        <div class="main-login" id="main-login">
            <div class="left-login">
                <h1>Login ADM<br>A.D Videira Verdadeira</h1>
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
                        <div class="checkbox">
                            <input type="checkbox" name="Manter" value="Manter">
                            <label for="Manter">Manter-se conectado?</label>
                        </div>
                        <button type="submit" class="btn-login" name="btn-logar">LOGAR</button>
                        <a href="index.php">Entrar sem conta</a>
                    </div>
                </div>
            </form>

        </div>
    </body>
    
    <script src="JS/jquery-3.6.0.min.js"></script>
    <script src="JS/funcoes.js"></script>

</html>
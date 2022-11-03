<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!--link rel="stylesheet" href="styles/main.scss"-->
  </head>

  <style>
    * {
        text-transform: capitalize;
    }
    .cod_lancamento {
        display: none;
    }
  </style>

  <body>
            <?php
                include "conexao.php";

                    mysqli_query($conexao, 'SET lc_time_names=pt_BR');

                    $tabela = 'relatorio';
                    $mes = 'abril';
  
                    $sql = "SELECT cod_lancamento, DATE_FORMAT(data, '%d/%m/%Y'), historico, tipo, CONCAT('R$ ', REPLACE(REPLACE(REPLACE(FORMAT(valor, 2),'.',';'),',','.'),';',',')) FROM $tabela WHERE DATE_FORMAT(data, '%M') = '$mes' ORDER BY DATE_FORMAT(data, '%d')";
                    $resultado = mysqli_query($conexao, $sql);
                        
                    $sql2 = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME IN ('$tabela')";
                    $resultado2 = mysqli_query($conexao, $sql2);

                    $sql3 = "SELECT count(COLUMN_NAME) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME IN ('$tabela');";
                    $resultado3 = mysqli_query($conexao, $sql3);
                    $row = mysqli_fetch_array($resultado3);

                    echo "<table class='table table-striped-columns'>";
                    echo "<thead>";
                        echo "<tr>";
                        $a = 0;
                        while($coluna=mysqli_fetch_array($resultado2)){
                            echo "<th class=".$coluna['COLUMN_NAME'].">";
                                echo $coluna['COLUMN_NAME']; 

                                $classe[$a] = $coluna['COLUMN_NAME'];
                                $a++;
                            echo "</th>";
                        }
                        echo "</tr>";
                    echo "</thead>";
                    echo "<tboby>";
                        while($linha=mysqli_fetch_array($resultado)){
                            echo "<tr>";
                                for ($i=0; $i<$row[0]; $i++){
                                    echo "<td class=".$classe[$i].">".$linha[$i]."</td>";
                                }
                            echo "</tr>";  
                        }
                    echo "</tboby>";
                    echo "</table>";
                ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>
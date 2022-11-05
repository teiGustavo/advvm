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
        <title>Consulta <?php if (isset($_POST['btn'])) { echo "Mês ".$_POST['mes']; } ?></title>
    </head>
    <body>
        <div class="tabela">
            <?php
                include "conexao.php";

                if (isset($_POST['btn'])) {
                    mysqli_query($conexao, 'SET lc_time_names=pt_BR');

                    $tabela = 'relatorio';
                    $mes = $_POST['mes'];
  
                    $sql = "SELECT cod_lancamento, DATE_FORMAT(data, '%d/%m/%Y'), historico, tipo, CONCAT('R$ ', REPLACE(REPLACE(REPLACE(FORMAT(valor, 2),'.',';'),',','.'),';',',')) FROM $tabela WHERE DATE_FORMAT(data, '%M') = '$mes' ORDER BY DATE_FORMAT(data, '%d')";
                    $resultado = mysqli_query($conexao, $sql);
                        
                    $sql2 = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME IN ('$tabela')";
                    $resultado2 = mysqli_query($conexao, $sql2);

                    $sql3 = "SELECT count(COLUMN_NAME) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME IN ('$tabela');";
                    $resultado3 = mysqli_query($conexao, $sql3);
                    $row = mysqli_fetch_array($resultado3);

                    echo "<table class='tabela2'>";

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

                        while($linha=mysqli_fetch_array($resultado)){
                            echo "<tr>";
                                for ($i=0; $i<$row[0]; $i++){
                                    echo "<td class=".$classe[$i].">".$linha[$i]."</td>";
                                }
                            echo "</tr>";  
                        }
                
                    echo "</table>";
                }
            ?>
        </div>

        <div class="tabela">
            <?php
                $sql4 = "SELECT CONCAT('R$ ', REPLACE(REPLACE(REPLACE(FORMAT(SUM(valor), 2),'.',';'),',','.'),';',',')) FROM relatorio WHERE DATE_FORMAT(data, '%M')  = '$mes' AND tipo = 'Entrada'";
                $resultado4 = mysqli_query($conexao, $sql4);

                $sql5 = "SELECT CONCAT('R$ ', REPLACE(REPLACE(REPLACE(FORMAT(SUM(valor), 2),'.',';'),',','.'),';',',')) FROM relatorio WHERE DATE_FORMAT(data, '%M')  = '$mes' AND tipo = 'Saida'";
                $resultado5 = mysqli_query($conexao, $sql5);

                $sql6 = "SELECT CONCAT('R$ ', REPLACE(REPLACE(REPLACE(FORMAT(SUm(valor), 2),'.',';'),',','.'),';',',')) FROM relatorio WHERE DATE_FORMAT(data, '%M')  = '$mes' AND historico = 'Saldo Anterior' AND tipo = 'Entrada'";
                $resultado6 = mysqli_query($conexao, $sql6);

                echo "<table class='tabela2'>";
                    echo "<tr>";
                        echo "<th>";
                            echo "Saldo Anterior";
                        echo "</th>";

                        echo "<th>";
                            echo "Entradas";
                        echo "</th>";

                        echo "<th>";
                            echo "Saídas";
                        echo "</th>";

                    echo "</tr>";

                    echo "<tr>";
                        echo "<td>";
                            ($vet3 = mysqli_fetch_array($resultado6));
                            echo $vet3[0];
                        echo "</td>";

                        echo "<td>";
                            ($vet = mysqli_fetch_array($resultado4));
                            echo $vet[0]; 
                        echo "</td>";

                        echo "<td>";
                            ($vet2 = mysqli_fetch_array($resultado5));
                            echo $vet2[0];
                        echo "</td>";

                    echo "</tr>";
                echo "</table>";  
            ?>
            
            <br>
            <br>    
            <a href="consulta.php">Selecionar outro mês!</a>
            <br>

            <?php
                echo "<a href='Arquivos/Excel.txt' download='Excel.txt'><button type='button' class='btn' style='margin: 0px; margin-bottom: 25px; margin-top: 25px;'>Baixar excel</button></a>";
              
                $sqlExcel = "SELECT cod_lancamento, DATE_FORMAT(data, '%d/%m/%Y'), historico, tipo, CONCAT('R$ ', REPLACE(REPLACE(REPLACE(FORMAT(valor, 2),'.',';'),',','.'),';',',')) FROM $tabela WHERE DATE_FORMAT(data, '%M') = '$mes' ORDER BY DATE_FORMAT(data, '%d')";
                $resultExcel = mysqli_query($conexao, $sqlExcel);
                $rowExcel = mysqli_num_rows($resultExcel);
                $fieldsExcel = mysqli_num_fields($resultExcel);

                //Criar arquivo na pasta Arquivos
                $arquivo = fopen('Arquivos/Excel.txt','w');

                while ($l = mysqli_fetch_array($resultExcel)) {

                    //Escreve no txt
                    for ($i=1; $i<$fieldsExcel; $i++) {
                        $texto = $l[$i].';';
                        fwrite($arquivo, $texto);
                    }

                    //Quebra linha
                    fwrite($arquivo, "\r\n");
                }

                //Fechar o arquivo
                fclose($arquivo); 
            ?>
        </div>
    </body>
</html>
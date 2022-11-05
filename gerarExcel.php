<?php
    require 'vendor/autoload.php';

    use PhpOffice\PhpSpreadsheet\Spreadsheet; //classe responsável pela manipulação da planilha

    use PhpOffice\PhpSpreadsheet\Writer\Xlsx; //classe que salvará a planilha em .xlsx 

    $spreadsheet = new Spreadsheet();
    
    $sheet = $spreadsheet -> getActiveSheet();

    //Conteudo da célula A1
    $sheet -> setCellValue('A1', 'Relatório AD. Videira Verdadeira');

    //Juntando as células para formar o título
    $sheet -> mergeCells('A1:D1');
    $sheet -> getRowDimension('1') -> setRowHeight(26);

    //Alinhando o título ao centro
    $sheet -> getStyle('A:D') -> getAlignment() -> setHorizontal('center');
    $sheet -> getStyle('A:D') -> getAlignment() -> setVertical('center');

    //Definindo larguras
    $sheet -> getColumnDimension('A') -> setWidth('15');
    $sheet -> getColumnDimension('B') -> setWidth('30');
    $sheet -> getColumnDimension('D') -> setWidth('20');

    //Cabeçalho da planilha
    $sheet -> setCellValue('A2', 'DATA');
    $sheet -> setCellValue('B2', 'HISTÓRICO');
    $sheet -> setCellValue('C2', 'TIPO');
    $sheet -> setCellValue('D2', 'VALOR');

    //Valores
    /*$sheet -> setCellValue('A3', '01/07/2022');
    $sheet -> setCellValue('B3', 'Saldo Anterior');
    $sheet -> setCellValue('C3', 'Entrada');
    $sheet -> setCellValue('D3', 'R$ 1000,00');*/

    include "conexao.php";
    $tabela = 'relatorio';
    $mes = 'Maio';

    mysqli_query($conexao, 'SET lc_time_names=pt_BR');
    $sqlExcel = "SELECT cod_lancamento, DATE_FORMAT(data, '%d/%m/%Y'), historico, tipo, CONCAT('R$ ', REPLACE(REPLACE(REPLACE(FORMAT(valor, 2),'.',';'),',','.'),';',',')) FROM $tabela WHERE DATE_FORMAT(data, '%M') = '$mes' ORDER BY DATE_FORMAT(data, '%d')";
    $resultExcel = mysqli_query($conexao, $sqlExcel);
    $rowExcel = mysqli_num_rows($resultExcel);
    $fieldsExcel = mysqli_num_fields($resultExcel);

    $z = 0;
    while ($l = mysqli_fetch_array($resultExcel)) {
        for ($i=1; $i<$fieldsExcel; $i++) { 
            $texto[$z][$i] = $l[$i];  
        } 
        $z++;
    }
    
    $num = 0;
    for ($i=3; $i<$rowExcel+3; $i++) {
        for ($j=1; $j<=4; $j++) {
            if ($j == 1) {
                $letra = 'A';
            } else if ($j == 2) {
                $letra = 'B';
            } else if ($j == 3) {
                $letra = 'C';
            } else if ($j == 4) {
                $letra = 'D';
            }

            for ($p=1; $p<=4; $p++) {
                $sheet -> setCellValue($letra.$i, $texto[$num][$num]);
            }
            
            //$sheet -> setCellValue('A'.$i, $texto[$j]);
            //$sheet -> setCellValue('B'.$i, $texto[$j]);
            //$sheet -> setCellValue('C'.$i, $texto[$j]);
            //$sheet -> setCellValue('D'.$i, $texto[$j]);
        }
        
        $num++;
    }

    print_r($texto).
    
    $writer = new Xlsx($spreadsheet);

    $writer->save('Arquivos/Relatorio.xlsx');
?>
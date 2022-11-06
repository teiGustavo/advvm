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
    $sheet -> getRowDimension('1') -> setRowHeight('30');

    //Alinhando o título ao centro
    $sheet -> getStyle('A:D') -> getAlignment() -> setHorizontal('center');
    $sheet -> getStyle('A:D') -> getAlignment() -> setVertical('center');

    //Definindo larguras
    $sheet -> getColumnDimension('A') -> setWidth('15');
    $sheet -> getColumnDimension('B') -> setWidth('45');
    $sheet -> getColumnDimension('D') -> setWidth('20');

    //Cabeçalho da planilha
    $sheet -> setCellValue('A2', 'DATA');
    $sheet -> setCellValue('B2', 'HISTÓRICO');
    $sheet -> setCellValue('C2', 'TIPO');
    $sheet -> setCellValue('D2', 'VALOR');
    $sheet -> getRowDimension('2') -> setRowHeight('25');

    //Valores
    include "conexao.php";

    $tabela = 'relatorio';
    $mes = $_POST['mes'];

    mysqli_query($conexao, 'SET lc_time_names=pt_BR');
    $sqlExcel = "SELECT cod_lancamento, DATE_FORMAT(data, '%d/%m/%Y'), historico, tipo, valor FROM $tabela WHERE DATE_FORMAT(data, '%M') = '$mes' ORDER BY DATE_FORMAT(data, '%d')";
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
        for ($p=1; $p<=4; $p++) {
            $sheet -> setCellValue('A'.$i, $texto[$num][1]);
            $sheet -> setCellValue('B'.$i, $texto[$num][2]);
            $sheet -> setCellValue('C'.$i, $texto[$num][3]);
            $sheet -> setCellValue('D'.$i, $texto[$num][4]);
            $sheet -> getStyle('D'.$i) -> getNumberFormat() -> setFormatCode('R$ #,##0.00');
        }
    
        $num++;
    }

    for ($i=3; $i<=$rowExcel+2; $i++) {
        $sheet -> getRowDimension($i) -> setRowHeight('20');
    }

    //Estilo
    $styleArray = [
        'Borda Externa' => [
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ],

        'Borda Direita' => [
            'borders' => [
                'right' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ],

        'Borda Inferior' => [
            'borders' => [
                'bottom' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ],
    ];
    
    $sheet -> getStyle('A1:D'.$rowExcel+2) -> applyFromArray($styleArray['Borda Externa']);

    $sheet -> getStyle('A2:A'.$rowExcel+2) -> applyFromArray($styleArray['Borda Direita']); 
    $sheet -> getStyle('B2:B'.$rowExcel+2) -> applyFromArray($styleArray['Borda Direita']); 
    $sheet -> getStyle('C2:C'.$rowExcel+2) -> applyFromArray($styleArray['Borda Direita']); 
    $sheet -> getStyle('D2:D'.$rowExcel+2) -> applyFromArray($styleArray['Borda Direita']); 
    
    $sheet -> getStyle('A1:D1') -> applyFromArray($styleArray['Borda Inferior']); 
    $sheet -> getStyle('A2:D2') -> applyFromArray($styleArray['Borda Inferior']); 

    $sheet -> getStyle('A1') -> getFill() -> setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID); 
    $sheet -> getStyle('A1') -> getFill() -> getStartColor() -> setARGB('63cbce');
    
    $writer = new Xlsx($spreadsheet);

    $writer->save('Arquivos/Relatório Mês de '.$mes.'.xlsx');
?>
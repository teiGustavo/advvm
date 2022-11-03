/*DEFINIR IDIOMA DAS CONSULTAS QUE UTILIZAM "TEMPO DECORRIDO / DATAS" COMO PORTUGUÊS*/
SET lc_time_names=pt_BR;

SELECT SUM(valor) FROM relatorio WHERE DATE_FORMAT(data, '%M')  = 'Outubro';


/*SELECT DATE_FORMAT(data, '%d/%c/%Y') as 'Data do Lançamento', historico as 'Histórico', CONCAT('R$ ', REPLACE(REPLACE(REPLACE(FORMAT(valor, 2),'.',';'),',','.'),';',',')) as 'Valor' FROM ENTRADAS

UNION

SELECT DATE_FORMAT(data, '%d/%c/%Y') as 'Data do Lançamento', historico as 'Histórico', CONCAT('R$ ', REPLACE(REPLACE(REPLACE(FORMAT(valor, 2),'.',';'),',','.'),';',',')) as 'Valor' FROM SAIDAS;*/

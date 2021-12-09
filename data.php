<?php

//data.php

$connect = new PDO("mysql:host=localhost;dbname=dbbarbearia", "root", "root");



if(isset($_POST["action"]))
{
	
	if($_POST["action"] == 'insert')
	{
		$data = array(
			':tipo'		=>	$_POST["tipo"],
			':status'		=>	$_POST["status"]
		);

		$query = "
		INSERT INTO despesas 
		(id,tipo,data_regs_despesa,status) VALUES (null,:tipo, NOW(), :status)
		";

		$statement = $connect->prepare($query);

		$statement->execute($data);

		echo 'done';
	}

	if($_POST["action"] == 'fetch')
	{	
		
		$query = "
		SELECT data_do_pagamento, DAYNAME(data_do_pagamento) AS Dia, SUM(valortotal) AS Total 
		FROM agendamentos
		WHERE YEARWEEK(data, 1) = YEARWEEK(NOW(), 1) AND status_agendamento = 'concluido'
		GROUP BY data_do_pagamento
		ORDER BY data ASC
		";

		//$query2 = "
		//SELECT DAYNAME(data) AS Dia 
		//FROM agendamentos;
		//";
		// select dayname(data) as dia from agendamentos; 
		// isso é para pegar o dia da semana baseado na 'data'

		//SELECT DAYNAME(data) AS Dia, SUM(valortotal) AS Total FROM agendamentos GROUP BY data; 
		//ESSE RETORNA O DIA DA SEMANA (EM INGLES)

		//TESTE QUE DEU ERRADO
		//SELECT data, DAYNAME(data) AS Dia FROM agendamentos WHERE data = '2021-11-13'
		$result = $connect->query($query);
		//$result2 = $connect->query($query2);

		$data = array();
		//$dia = array();

		/*foreach($result2 as $row2)
		{
			$dia[] = array(
				'dia' => $row2["Dia"]
			 	);
		}*/

		/*SELECT data, DAYNAME(data) AS Dia, SUM(valortotal) AS Total 
		FROM agendamentos
        WHERE YEARWEEK(data, 1) = YEARWEEK(NOW(), 1)
		GROUP BY data
		ORDER BY data DESC

		SELECT data
		FROM agendamentos
		WHERE YEARWEEK(data, 1) = YEARWEEK(NOW(), 1)*/
		

		
		function vemdata($qqdata){
			$tempdata=substr($qqdata,8,2).'/'.
				  substr($qqdata,5,2).'/'.
				  substr($qqdata,0,4);
			return($tempdata);
		}
		foreach($result as $row)
		{
			$dataFormatada = vemdata($row["data_do_pagamento"]);
			$data[] = array(
				'dia' => $row["Dia"],
				'date' =>	$dataFormatada,
				'total'	=>	$row["Total"],
				'color'	 =>	'#' . rand(100000, 999999) . ''
			);
		}
		
		echo json_encode($data);
		
	}
}

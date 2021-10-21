<?php 
ob_start();
session_start();

    include_once 'C:/xampp/htdocs/testProjeto/bd/banco.php';

	//Arquivo responsável por lê o 'id"' do serviço escolhido no select e que atribui para o script do banco
	//para depois retornar o valor desejado para o JavaScript, cujo a função é retornar o valor para o outro select
	//obtendo select dependente do outro.
	$id_servicos10 = $_REQUEST['id_servicos2'];
	
	$result_sub_cat10 = "select DISTINCT valor, idServicos, nome, tempo_estimado from servicos_do_funcionario "
		."left join servicos on servicos.idServicos = servicos_do_funcionario.servicos_id "
		."WHERE servicos_id = $id_servicos10";
	
	$resultado_sub_cat10 = mysqli_query($conn, $result_sub_cat10);
	
	while ($row_sub_cat10 = mysqli_fetch_assoc($resultado_sub_cat10) ) {
		$servico_post10[] = array(
			'idServicos'	=> $row_sub_cat10['idServicos'],
			'nome'	=> $row_sub_cat10['nome'],
			'valor' => $row_sub_cat10['valor'],
			'tempo_estimado' => $row_sub_cat10['tempo_estimado'],
		);
	}
	
	echo(json_encode($servico_post10));

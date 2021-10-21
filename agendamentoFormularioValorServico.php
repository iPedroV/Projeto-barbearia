<?php 
ob_start();
session_start();

    include_once 'C:/xampp/htdocs/Projeto-barbearia/bd/banco.php';

	//Arquivo responsável por lê o 'id"' do serviço escolhido no select e que atribui para o script do banco
	//para depois retornar o valor desejado para o JavaScript, cujo a função é retornar o valor para o outro select
	//obtendo select dependente do outro.
	$id_servicos = $_REQUEST['id_servicos'];
	
	$result_sub_cat = "select DISTINCT valor, idServicos, nome, tempo_estimado from servicos_do_funcionario "
		."left join servicos on servicos.idServicos = servicos_do_funcionario.servicos_id "
		."WHERE servicos_id = $id_servicos";
	
	$resultado_sub_cat = mysqli_query($conn, $result_sub_cat);
	
	while ($row_sub_cat = mysqli_fetch_assoc($resultado_sub_cat) ) {
		$servico_post[] = array(
			'idServicos'	=> $row_sub_cat['idServicos'],
			'nome'	=> $row_sub_cat['nome'],
			'valor' => $row_sub_cat['valor'],
			'tempo_estimado' => $row_sub_cat['tempo_estimado'],
		);
	}
	
	echo(json_encode($servico_post));

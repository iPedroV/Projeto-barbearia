<?php 
ob_start();
session_start();

    include_once 'C:/xampp/htdocs/Projeto-barbearia/bd/banco.php';

	//Arquivo responsável por lê o 'id"' do serviço escolhido no select e que atribui para o script do banco
	//para depois retornar o valor desejado para o JavaScript, cujo a função é retornar o valor para o outro select
	//obtendo select dependente do outro.
	$id_funcionarios = $_REQUEST['id_funcionarios'];
	//$_SESSION['agendamentoFuncionario'] = $id_funcionarios;
	
	$result_sub_cat20 = "select DISTINCT nome,id from servicos_do_funcionario "
    ."inner join usuario on usuario.id = servicos_do_funcionario.funcionarios_id " 
    ."WHERE usuario.id = $id_funcionarios ORDER BY nome";
	$resultado_sub_cat20 = mysqli_query($conn, $result_sub_cat20);
	
	while ($row_sub_cat20 = mysqli_fetch_assoc($resultado_sub_cat20) ) {
		$funcionario_post20[] = array(
			'id'	=> $row_sub_cat20['id'],
			'nome' => $row_sub_cat20['nome'],
		);
	}
	
	echo(json_encode($funcionario_post20));

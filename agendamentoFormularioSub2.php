<?php 
ob_start();
session_start();

    include_once 'C:/xampp/htdocs/testProjeto/bd/banco.php';

	//Arquivo responsável por lê o 'id"' do serviço escolhido no select e que atribui para o script do banco
	//para depois retornar o valor desejado para o JavaScript, cujo a função é retornar o valor para o outro select
	//obtendo select dependente do outro.
	$id_servicos2 = $_REQUEST['id_servicos2'];
	$_SESSION['servico2'] = $id_servicos2;
	
	$result_sub_cat = "select DISTINCT nome,id from servicos_do_funcionario "
    ."left join usuario on usuario.id = servicos_do_funcionario.funcionarios_id "
    ."WHERE servicos_id = $id_servicos2 ORDER BY nome";
	$resultado_sub_cat = mysqli_query($conn, $result_sub_cat);
	
	while ($row_sub_cat = mysqli_fetch_assoc($resultado_sub_cat) ) {
		$funcionario_post2[] = array(
			'id'	=> $row_sub_cat['id'],
			'nome' => $row_sub_cat['nome'],
		);
	}
	
	echo(json_encode($funcionario_post2));

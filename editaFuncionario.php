<?php
	include_once 'C:/xampp/htdocs/Projeto-barbearia/bd/banco.php';
	include_once 'C:/xampp/htdocs/Projeto-barbearia/model/Mensagem.php';
	$conn = new Conecta();
	$msg = new Mensagem();
	$conecta = $conn->conectadb();
	if ($conecta) {

		$id = $_POST['id'];
		$nome = $_POST['nome'];
		$email = $_POST['email'];
		$perfil = $_POST['perfil'];
		$sexo = $_POST['sexo'];
		$telefone = $_POST['telefone'];

		/*$msg->setMsg("<p style='color: blue;'>"
				. "'$email', '$senha'</p>"); */

		try {
			$conecta->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt = $conecta->prepare("UPDATE usuario SET nome = ?, email = ?, perfil = ?, sexo = ?, telefone = ? WHERE id = ?");
			$stmt->bindParam(1, $nome);
			$stmt->bindParam(2, $email);
			$stmt->bindParam(3, $perfil);
			$stmt->bindParam(4, $sexo);
			$stmt->bindParam(5, $telefone);
			$stmt->bindParam(6, $id);
			$stmt->execute();
			$msg->setMsg("<script>Swal.fire({
				icon: 'success',
				title: 'Dados alterados com sucesso',
				timer: 2000
			  })
			  </script>");
			  echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"0;
			  URL='../Projeto-Barbearia/ListarFuncionario.php'\">";  
			
		} catch (PDOException $ex) {
			$msg->setMsg(var_dump($ex->errorInfo));
		}
	} else {
		/*$msg->setMsg("<script>Swal.fire({
			icon: 'error',
			title: 'Erro de conexão',
			text: 'Banco de dados pode estar inoperante',
			timer: 2000
		  })</script>");*/
		  echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"0;
			 URL='../Projeto-Barbearia/index.php'\">";	
	}
	$conn = null;
	return $msg;

	
	
	
	
?>

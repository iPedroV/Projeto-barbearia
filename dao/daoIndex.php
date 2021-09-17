<?php


include_once 'C:/xampp/htdocs/Projeto-barbearia/bd/banco.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/Clientes.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/Mensagem.php';

class DaoClientes
{

    public function pesquisarClienteNomeDAO($nome)
    {
        $msg = new Mensagem();
        $conn = new Conecta();
        $conecta = $conn->conectadb();
        $cliente = new Clientes();
        if ($conecta) {
            try {
                $rs = $conecta->prepare("select * from clientes where "
                    . "nome = ?");
                $rs->bindParam(1, $nome);
                if ($rs->execute()) {
                    if ($rs->rowCount() > 0) {
                        while ($linha = $rs->fetch(PDO::FETCH_OBJ)) {
                            $cliente->setId($linha->id);
                            $cliente->setSenha($linha->senha);
                            $cliente->setNome($linha->nome);
                            $cliente->setSexo($linha->sexo);
                            $cliente->setEmail($linha->email);
                            $cliente->setTelefone($linha->telefone);
                           
                        }
                    }
                }
            } catch (Exception $ex) {
                $msg->setMsg($ex);
            }
            $conn = null;
        } else {
            echo "<script>alert('Banco inoperante!')</script>";
            echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"0;
			 URL='../Projeto-Barbearia/index.php'\">";
        }
        return $cliente;
    }

   
}

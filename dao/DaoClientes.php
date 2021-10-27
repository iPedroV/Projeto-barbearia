<?php


include_once 'C:/xampp/htdocs/Projeto-barbearia/bd/banco.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/Usuario.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/Mensagem.php';

class DaoClientes
{

    public function inserir(Usuario $clientes)
    {
        $conn = new Conecta();
        $msg = new Mensagem();
        $conecta = $conn->conectadb();

        if ($conecta) {

            $resp = null;
            $senha = $clientes->getSenha();
            $nome = $clientes->getNome();
            $sexo = $clientes->getSexo();
            $email = $clientes->getEmail();
            $telefone = $clientes->getTelefone();
            $perfil = 'Administrador';
            try {
                $st = $conecta->prepare("SELECT * FROM usuario where email = ?");
                $st->execute([$email]);
                $result = $st->rowCount();
                if ($result > 0) {
                    $resp = $clientes;
                    //$msg->setMsg("<p style='color: red;'>"
                    //. "Email já cadastrado!</p>");
                } else {
                    $stmt = $conecta->prepare("insert into usuario values "
                        . "(null,?,?,?,?,md5(?),?)");

                    $stmt->bindParam(1, $nome);
                    $stmt->bindParam(2, $perfil);
                    $stmt->bindParam(3, $telefone);
                    $stmt->bindParam(4, $email);
                    $stmt->bindParam(5, $senha);
                    $stmt->bindParam(6, $sexo);
                    $stmt->execute();
                    $resp = "<p style='color: green;'>"
                        . "Dados Cadastrados com sucesso</p>";
                }
            } catch (Exception $ex) {
                $resp = $ex;
            }
        } else {
            $resp = "<p style='color: red;'>"
                . "Erro na conexão com o banco de dados.</p>";
        }
        $conn = null;
        return $resp;
    }


    //Ainda não está pronto a alteração de senha do cliente.
    //Atualização de senha Cliente
   public function atualizarSenhaDAO(Usuario $cliente)
    {
        $conn = new Conecta();
        $msg = new Mensagem();
        $conecta = $conn->conectadb();
        if ($conecta) {

            $senha = $cliente->getSenha();
            $id = $cliente->getId();

            /*$msg->setMsg("<p style='color: blue;'>"
                    . "'$email', '$senha'</p>");*/

            try {
                $conecta->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $conecta->prepare("UPDATE usuario SET senha = md5(?) WHERE id = ?");
                $stmt->bindParam(1, $senha);
                $stmt->bindParam(2, $id);
                $stmt->execute();
                $msg->setMsg("<p style='color: blue;'>"
                    . "Senha atualizada com sucesso</p>");
            } catch (PDOException $ex) {
                $msg->setMsg(var_dump($ex->errorInfo));
            }
        } else {
            $msg->setMsg("<p style='color: red;'>"
                . "Erro na conexão com o banco de dados.</p>");
        }
        $conn = null;
        return $msg;
    }

    //Select de id cliente
    public function pesquisarEmailClienteDAO($email)
    {
        $msg = new Mensagem();
        $conn = new Conecta();
        $conecta = $conn->conectadb();
        $cliente = new Usuario();
        //echo "<script>alert('Cheguei aqui')</script>";
        if ($conecta) {
            try {
               
                $rs = $conecta->query("select * from usuario where email = '$email'");               
                $a = 0;
                if ($rs->execute()) {
                    if ($rs->rowCount() > 0) {
                        while ($linha = $rs->fetch(PDO::FETCH_OBJ)) {
                            
                            $cliente->setEmail($linha->email);
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

    public function pesquisarIdClienteoDAO($email)
    {
        $msg = new Mensagem();
        $conn = new Conecta();
        $conecta = $conn->conectadb();
        $cliente = new Usuario();
        //echo "<script>alert('Cheguei aqui')</script>";
        $lista = array();
        if ($conecta) {
            try {
               
                $rs = $conecta->query("select id from usuario where email = '$email'");               
                $a = 0;
                if ($rs->execute()) {
                    if ($rs->rowCount() > 0) {
                        while ($linha = $rs->fetch(PDO::FETCH_OBJ)) {
                            //$cliente = new Usuario();
                            $cliente->setId($linha->id);
                            $lista = $cliente;
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
        return serialize($lista);
        //return $lista;
    } 
}


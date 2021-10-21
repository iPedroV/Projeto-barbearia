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
            $perfil = 'Cliente';
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
   /* public function atualizarSenhaDAO(Usuario $clientes)
    {
        $conn = new Conecta();
        $msg = new Mensagem();
        $cliente = new Usuario();
        $conecta = $conn->conectadb();
        if ($conecta) {

            $id = $clientes->getId();
            $senha = $clientes->getSenha();

            try {
                $stmt = $conecta->prepare("UPDATE `usuario` SET `senha`= md5('?') WHERE id = ?");
                $stmt->bindParam(1, $senha);
                $stmt->bindParam(1, $id);
                $stmt->execute();
                $msg->setMsg("<p style='color: blue;'>"
                    . "Senha atualizada com sucesso</p>");
            } catch (Exception $ex) {
                $msg->setMsg($ex);
            }
        } else {
            $msg->setMsg("<p style='color: red;'>"
                . "Erro na conexão com o banco de dados.</p>");
        }
        $conn = null;
        return $msg;
    }

    //Select de id cliente
    public function SelecionarClienteDAO($id)
    {
        $conn = new Conecta();
        $msg = new Mensagem();
        $conecta = $conn->conectadb();
        if ($conecta) {            
            try {
                $st = $conecta->prepare("SELECT id FROM usuario where email = ?");
                $st->bindParam(1, $id);
                $result = $st->rowCount();
            } catch (Exception $ex) {
                $msg->setMsg($ex);
            }
        } else {
            $msg->setMsg("<p style='color: red;'>"
                . "Erro na conexão com o banco de dados.</p>");
        }
        $conn = null;
        return $msg;
    } */
}

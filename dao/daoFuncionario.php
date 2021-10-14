<?php

include_once 'C:/xampp/htdocs/Projeto-barbearia/bd/banco.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/funcionario.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/Mensagem.php';

class DaoFuncionario{

    public function inserirFuncionarioDAO(Funcionario $funcionario){
    
        $conn = new Conecta();
        $msg = new Mensagem();
        $conecta = $conn->conectadb();

        if ($conecta) {


            $senha = $funcionario->getSenha();
            $nome = $funcionario->getNome();
            $sexo = $funcionario->getSexo();
            $email = $funcionario->getEmail();
            $telefone = $funcionario->getTelefone();
            $perfil = $funcionario->getPerfil();
            try {
                $st = $conecta->prepare("SELECT * FROM usuario where email = ?");
                $st->execute([$email]);
                $result = $st->rowCount();
                if($result >0){
                    $msg->setMsg("<p style='color: red;'>"
                    . "Email já cadastrado!</p>");
                }else{
                    $stmt = $conecta->prepare("insert into usuario values "
                    . "(null,?,?,?,?,md5(?),?)");

                $stmt->bindParam(1, $nome);
                $stmt->bindParam(2, $perfil);
                $stmt->bindParam(3, $telefone);
                $stmt->bindParam(4, $email);
                $stmt->bindParam(5, $senha);
                $stmt->bindParam(6, $sexo);
                $stmt->execute();
                $msg->setMsg("<p style='color: green;'>"
                    . "Dados Cadastrados com sucesso</p>");
                }
                
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
}
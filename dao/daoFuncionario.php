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
            
            $resp = null;
            $nome = $funcionario->getNome();
            $perfil = $funcionario->getPerfil();
            $telefone = $funcionario->getTelefone();
            $email = $funcionario->getEmail();
            $senha = $funcionario->getSenha();
            $sexo = $funcionario->getSexo();
           
            
            
            try {
                $st = $conecta->prepare("SELECT * FROM usuario where email = ?");
                $st->execute([$email]);
                $result = $st->rowCount();
                if($result >0){
                    $resp = $funcionario;
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
}
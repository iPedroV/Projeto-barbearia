<?php

include_once 'C:/xampp/htdocs/Projeto-barbearia/bd/banco.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/Usuario.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/Mensagem.php';

class DaoFuncionario{

    public function inserirFuncionarioDAO(Usuario $funcionario){
    
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

    public function pesquisarFuncionarioDAO()
    {
        $msg = new Mensagem();
        $conn = new Conecta();
        $conecta = $conn->conectadb();
        //echo "<script>alert('Cheguei aqui')</script>";
        $lista = array();
        if ($conecta) {
            try {
               
                $rs = $conecta->query("select * from usuario where perfil = 'funcionario'");               
                $a = 0;
                if ($rs->execute()) {
                    if ($rs->rowCount() > 0) {
                        while ($linha = $rs->fetch(PDO::FETCH_OBJ)) {
                            $cliente = new Usuario();
                            $cliente->setId($linha->id);
                            $cliente->setNome($linha->nome);
                            $cliente->setPerfil($linha->perfil);
                            $cliente->setSexo($linha->sexo);
                            $cliente->setEmail($linha->email);
                            $cliente->setTelefone($linha->telefone);
                            $lista[$a] = $cliente;
                            $a++;
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
        return $lista;
    } 
}
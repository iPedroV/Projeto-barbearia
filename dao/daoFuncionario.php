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
            $verifica = "F";
            $token = $funcionario->getToken();


            try {
                $st = $conecta->prepare("SELECT * FROM usuario where email = ?");
                $st->execute([$email]);
                $result = $st->rowCount();
                if($result >0){
                    $resp = $funcionario;
                }else{
                    $stmt = $conecta->prepare("insert into usuario values "
                    . "(null,?,?,?,?,md5(?),?, ?,?)");

                $stmt->bindParam(1, $nome);
                $stmt->bindParam(2, $perfil);
                $stmt->bindParam(3, $telefone);
                $stmt->bindParam(4, $email);
                $stmt->bindParam(5, $senha);
                $stmt->bindParam(6, $sexo);
                $stmt->bindParam(7, $verifica);
                $stmt->bindParam(8, $token);
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

    public function pesquisarFuncionarioDAO()  // Para listar os funcionários em ListarFuncionario.php
    {
        $msg = new Mensagem();
        $conn = new Conecta();
        $conecta = $conn->conectadb();
        //echo "<script>alert('Cheguei aqui')</script>";
        $lista = array();
        if ($conecta) {
            try {
               
                $rs = $conecta->query("select * from usuario where perfil = 'Funcionario'");               
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

    public function atualizarSenhaFuncioanrioDAO(Usuario $funcioanrio)
    {
        $conn = new Conecta();
        $msg = new Mensagem();
        $conecta = $conn->conectadb();
        if ($conecta) {

            $senha = $funcioanrio->getSenha();
            $verifica = 'S';
            $token = $funcioanrio->getToken();
           
            

            try {
                $conecta->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $conecta->prepare("UPDATE usuario SET senha= md5(?), verifica = ? WHERE token = ?");
                $stmt->bindParam(1, $senha);
                $stmt->bindParam(2, $verifica);
                $stmt->bindParam(3, $token);
                $stmt->execute();
                $msg->setMsg("<script>Swal.fire({
                    icon: 'success',
                    title: 'Senha alterada com sucesso',
                    timer: 2000
                  })
                  </script>");

            } catch (PDOException $ex) {
                $msg->setMsg(var_dump($ex->errorInfo));
            }
        } else {
            $msg->setMsg("<script>Swal.fire({
                icon: 'error',
                title: 'Erro de conexão',
                text: 'Banco de dados pode estar inoperante',
                timer: 2000
              })</script>");
        }
        $conn = null;
        return $msg;
    }
    //método para os dados de produto por id
    public function pesquisarFuncionarioIdDAO($id)
    {
        $conn = new Conecta();
        $conecta = $conn->conectadb();
        $funcionario = new Usuario();
        $msg = new Mensagem();
        if ($conecta) {
            try {
                $conecta->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $rs = $conecta->prepare("select * from usuario where id = ?");
                $rs->bindParam(1, $id);
                if ($rs->execute()) {
                    if ($rs->rowCount() > 0) {
                        while ($linha = $rs->fetch(PDO::FETCH_OBJ)) {

                            $funcionario = new Usuario();
                            $funcionario->setId($linha->id);
                            $funcionario->setNome($linha->nome);
                            $funcionario->setPerfil($linha->perfil);
                            $funcionario->setSexo($linha->sexo);
                            $funcionario->setEmail($linha->email);
                            $funcionario->setTelefone($linha->telefone);
                        }
                    }
                }
            } catch (PDOException $ex) {
                $msg->setMsg(var_dump($ex->errorInfo));
            }
            $conn = null;
        } else {
            $msg->setMsg("<script>Swal.fire({
                icon: 'error',
                title: 'Erro de conexão',
                text: 'Banco de dados pode estar inoperante',
                timer: 2000
              })</script>");
        }
        return $funcionario;
    }
    public function excluirFuncionarioDAO($id)
    {
        $conn = new Conecta();
        $conecta = $conn->conectadb();
        $msg = new Mensagem();
        if ($conecta) {
            try {
                $conecta->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $conecta->prepare("delete from usuario "
                    . "where id = ?");
                $stmt->bindParam(1, $id);
                $stmt->execute();
                $msg->setMsg("<p style='color: green;'>" // colocar aqui o sweet alert dps
                    . "Funcionário excluído com sucesso.</p>");
            } catch (PDOException $ex) {
                $msg->setMsg(var_dump($ex->errorInfo));
            }
        } else {
            $msg->setMsg("<p style='color: red;'>'Banco inoperante!'</p>");
        }
        $conn = null;
        return $msg;
    }


    /*public function token(){
        $msg = new Mensagem();
        $conn = new Conecta();
        $conecta = $conn->conectadb();
        if ($conecta) {
            try {
                $rs = $conecta->query("select token from usuario where perfil = 'Funcionario'");
                if ($rs->execute()) {
                    if ($rs->rowCount() > 0) {
                        while ($linha = $rs->fetch(PDO::FETCH_OBJ)) {
                            $token = new Usuario();
                            $token->setToken($linha->token);
                        }
                    }
                }
            } catch (Exception $ex) {
                $msg->setMsg($ex);
            }
            $conn = null;
        } else {
            echo "<script>alert('Banco inoperante!')</script>";
        }
        return $token;
    }*/
}

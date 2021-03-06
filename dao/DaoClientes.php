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
 	$verifica = 'C';
            $token = 'Y';
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
                        . "(null,?,?,?,?,md5(?),?,?,?)");

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


    //Ainda não está pronto a alteração de senha do cliente.
    //Atualização de senha Cliente
    public function atualizarSenhaDAO(Usuario $cliente)
    {
        $conn = new Conecta();
        $msg = new Mensagem();
        $conecta = $conn->conectadb();
        if ($conecta) {

            $senha = $cliente->getSenha();
            $email = $cliente->getEmail();

            /*$msg->setMsg("<p style='color: blue;'>"
                    . "'$email', '$senha'</p>"); */

            try {
                $conecta->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $conecta->prepare("UPDATE usuario SET senha= md5(?) WHERE email = ?");
                $stmt->bindParam(1, $senha);
                $stmt->bindParam(2, $email);
                $stmt->execute();
                $msg->setMsg("<script>Swal.fire({
                    icon: 'success',
                    title: 'Senha alterada com sucesso!',
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

    public function listarUsuarioDAO()
    {
        $msg = new Mensagem();
        $conn = new Conecta();
        $conecta = $conn->conectadb();
        
        $lista = array();
        if ($conecta) {
            try {
                $rs = $conecta->prepare("SELECT * FROM usuario Where perfil = 'cliente' ORDER BY nome DESC");
                $a = 0;
                if ($rs->execute()) {
                    if ($rs->rowCount() > 0) {
                        while ($linha = $rs->fetch(PDO::FETCH_OBJ)) {
                            $usuario = new Usuario();
                            $usuario->setId($linha->id);
                            $usuario->setNome($linha->nome);
                            $usuario->setPerfil($linha->perfil);
                            $usuario->setTelefone($linha->telefone);
                            $usuario->setEmail($linha->email);
                            $usuario->setSenha($linha->senha);
                            $usuario->setSexo($linha->sexo);
                            $usuario->setVerifica($linha->verifica);
                            $usuario->setToken($linha->token);

                            $lista[$a] = $usuario;
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

    public function pesquisarUsuarioDAO($id)
    {
        $msg = new Mensagem();
        $conn = new Conecta();
        $conecta = $conn->conectadb();
        $usuario = new Usuario();

        if($conecta){
            try {
                $conecta->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $rs = $conecta->prepare("SELECT * FROM usuario Where id = ?");
                $rs->bindParam(1, $id);
                if ($rs->execute()) {
                    if ($rs->rowCount() > 0) {
                        while ($linha = $rs->fetch(PDO::FETCH_OBJ)) {
                            $usuario->setId($linha->id);
                            $usuario->setNome($linha->nome);
                            $usuario->setPerfil($linha->perfil);
                            $usuario->setTelefone($linha->telefone);
                            $usuario->setEmail($linha->email);
                            $usuario->setSenha($linha->senha);
                            $usuario->setSexo($linha->sexo);
                            $usuario->setVerifica($linha->verifica);
                            $usuario->setToken($linha->token);
                        }
                    }
                }

            }catch (Exception $ex) {
                $msg->setMsg($ex);
            }
            $conn = null;
        }
        return $usuario;
    }

    //Select de id cliente
    /*public function pesquisarEmailClienteDAO($email)
    {
        $msg = new Mensagem();
        $conn = new Conecta();
        $conecta = $conn->conectadb();
        $cliente = new Usuario();
        //echo "<script>alert('Cheguei aqui')</script>";
        if ($conecta) {
            try {

                $rs = $conecta->query("select email from usuario where email = '$email'");
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
        //echo "<script>alert('Cheguei aqui')</script>";
        $lista = array();
        if ($conecta) {
            try {

                $rs = $conecta->query("select id from usuario where email = '$email'");
                $a = 0;
                if ($rs->execute()) {
                    if ($rs->rowCount() > 0) {
                        while ($linha = $rs->fetch(PDO::FETCH_OBJ)) {
                            $cliente = new Usuario();
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
        //return serialize($lista);
        return $lista;
    }*/
}
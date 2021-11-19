<?php


include_once 'C:/xampp/htdocs/Projeto-barbearia/bd/banco.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/Usuario.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/Mensagem.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/VerifyEmail.class.php';

class DaoClientes
{

    public function inserir(Usuario $clientes)
    {
        // Initialize library class
        $mail = new VerifyEmail();

        // Set the timeout value on stream
        $mail->setStreamTimeoutWait(2);

        // Set debug output mode
        $mail->Debug = FALSE;
        $mail->Debugoutput = 'html';

        // Set email address for SMTP request
        $mail->setEmailFrom('from@email.com');
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
            try {
                $st = $conecta->prepare("SELECT * FROM usuario where email = ?");
                $st->execute([$email]);
                $result = $st->rowCount();

                if ($result > 0) {
                    $resp = $clientes;
                    //$msg->setMsg("<p style='color: red;'>"
                    //. "Email já cadastrado!</p>");
                } else {// alterei todo esse else pra fazer a verificação
                    if ($mail->check($email)) {
                        $stmt = $conecta->prepare("insert into usuario values "
                            . "(null,?,?,?,?,md5(?),?,?)");

                        $stmt->bindParam(1, $nome);
                        $stmt->bindParam(2, $perfil);
                        $stmt->bindParam(3, $telefone);
                        $stmt->bindParam(4, $email);
                        $stmt->bindParam(5, $senha);
                        $stmt->bindParam(6, $sexo);
                        $stmt->bindParam(7, $verifica);
                        $stmt->execute();
                        $resp = "<p style='color: green;'>"
                            . "Dados Cadastrados com sucesso</p>";
                    } else {
                        $resp = "<p style='color: Red;'>"
                            . "E-mail não existe</p>";
                        //$resp = $clientes;
                        
                    }
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
    }
}

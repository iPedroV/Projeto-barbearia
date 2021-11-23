<?php
include_once 'C:/xampp/htdocs/Projeto-barbearia/bd/banco.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/servicos_model.php';

class DaoServicos
{

    public function listarServicosDAO()
    {
        $conn = new Conecta();
        $msg = new Mensagem();
        $conecta = $conn->conectadb();
        if ($conecta) {
            try {
                $serag = $conecta->query("select * from servicos");
                $lista = array();
                $a = 0;
                if ($serag->execute()) {
                    if ($serag->rowCount() > 0) {
                        while ($linha = $serag->fetch(PDO::FETCH_OBJ)) {
                            $servicos = new Servicos_model();
                            $servicos->setIdServicos($linha->idServicos);
                            $servicos->setNomeServico($linha->nome);
                            $servicos->setValorServico($linha->valor);
                            $servicos->setTempoServico($linha->tempo_estimado);

                            $lista[$a] = $servicos;
                            $a++;
                        }
                    }
                }
            } catch (Exception $ex) {
                $msg->setMsg($ex);
            }
            $conn = null;
            return $lista;
        }
    }

    public function inserirServicoDAO(Servicos_model $servicos)
    {

        $conn = new Conecta();
        $msg = new Mensagem();
        $conecta = $conn->conectadb();

        if ($conecta) {

            $resp = null;
            $nome = $servicos->getNomeServico();
            $valor = $servicos->getValorServico();
            $tempo = $servicos->getTempoServico();

            try {
                $st = $conecta->prepare("SELECT * FROM servicos where nome = ?");
                $st->execute([$nome]);
                $result = $st->rowCount();
                if ($result > 0) {
                    $resp = $servicos;
                } else {
                    $stmt = $conecta->prepare("insert into servicos values "
                        . "(null,?,?,?)");

                    $stmt->bindParam(1, $nome);
                    $stmt->bindParam(2, $valor);
                    $stmt->bindParam(3, $tempo);

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

    public function excluirServicoDAO($id)
    {
        $conn = new Conecta();
        $conecta = $conn->conectadb();
        $msg = new Mensagem();
        if ($conecta) {
            try {
                $conecta->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $conecta->prepare("delete from servicos "
                    . "where idServicos = ?");
                $stmt->bindParam(1, $id);
                $stmt->execute();
                $msg->setMsg("<p style='color: green;'>" // colocar aqui o sweet alert dps
                    . "Serviço excluído com sucesso.</p>");
            } catch (PDOException $ex) {
                $msg->setMsg(var_dump($ex->errorInfo));
            }
        } else {
            $msg->setMsg("<p style='color: red;'>'Banco inoperante!'</p>");
        }
        $conn = null;
        return $msg;
    }

    //método para buscar os dados do serviço por id*
    public function pesquisarServicoIdDAO($id)
    {
        $conn = new Conecta();
        $conecta = $conn->conectadb();
        $servico = new Servicos_model();
        $msg = new Mensagem();
        if ($conecta) {
            try {
                $conecta->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $rs = $conecta->prepare("select * from servico where idServicos = ?");
                $rs->bindParam(1, $id);
                if ($rs->execute()) {
                    if ($rs->rowCount() > 0) {
                        while ($linha = $rs->fetch(PDO::FETCH_OBJ)) {

                            $servico = new Servicos_model();
                            $servico->setIdServicos($linha->idServicos);
                            $servico->setNomeServico($linha->nome);
                            $servico->setValorServico($linha->valor);
                            $servico->setTempoServico($linha->tempo_estimado);
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
        return $servico;
    }

    public function editaServicoDAO($id)
    {
        $conn = new Conecta();
        $msg = new Mensagem();
        $conecta = $conn->conectadb();
        if ($conecta) {

            $id = $_POST['id'];
            $nome = $_POST['nome'];
            $tempo = $_POST['tempo'];
            $valor = $_POST['valor'];


            /*$msg->setMsg("<p style='color: blue;'>"
				. "'$email', '$senha'</p>"); */

            try {
                $conecta->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $conecta->prepare("UPDATE servicos SET nome = ?, valor = ?, tempo_estimado = ? WHERE idServicos = ?");
                $stmt->bindParam(1, $nome);
                $stmt->bindParam(2, $valor);
                $stmt->bindParam(3, $tempo);
                $stmt->bindParam(4, $id);

                $stmt->execute();
                $msg->setMsg("<script>Swal.fire({
				icon: 'success',
				title: 'Dados alterados com sucesso',
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
}

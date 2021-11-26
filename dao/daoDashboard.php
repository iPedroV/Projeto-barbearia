<?php



include_once 'C:/xampp/htdocs/Projeto-barbearia/bd/banco.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/agendamento_model.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/Mensagem.php';

class daoDashboard
{
    public function ListarTodosAgendamentosDAO()
    {
        $msg = new Mensagem();
        $conn = new Conecta();
        $conecta = $conn->conectadb();
        
        $lista = array();
        if ($conecta) {
            try {
                $rs = $conecta->prepare("SELECT * FROM agendamentos WHERE status_agendamento = 'agendado' ORDER BY data ASC");
                $a = 0;
                if ($rs->execute()) {
                    if ($rs->rowCount() > 0) {
                        while ($linha = $rs->fetch(PDO::FETCH_OBJ)) {

                            $agendamento = new Agendamento();
                            $agendamento->setId($linha->idAgendamento);
                            $agendamento->setHorario($linha->horario);
                            $agendamento->setDataAgenda($linha->data);
                            $agendamento->setForma_Pagamento($linha->forma_de_pagamento);
                            $agendamento->setDataAgenda($linha->data_regs_agendamento);
                            $agendamento->setStatusAgendamento($linha->status_agendamento);
                            $agendamento->setDataPagemento($linha->data_do_pagamento);
                            $agendamento->setConfirma($linha->confir_envio);
                            $agendamento->setValor($linha->valortotal);
                            $lista[$a] = $agendamento;
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

    public function concluirAgendamentoDAO($id)
    {
        $conn = new Conecta();
        $msg = new Mensagem();
        $conecta = $conn->conectadb();
        if ($conecta) {

            
            $status = 'concluido';

            try {
                $conecta->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $conecta->prepare("UPDATE agendamentos SET status_agendamento = ? WHERE idAgendamento = ?");
                $stmt->bindParam(1, $status);
                $stmt->bindParam(2, $id);
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

?>
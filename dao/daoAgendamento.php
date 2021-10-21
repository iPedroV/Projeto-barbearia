<?php
include_once 'C:/xampp/htdocs/Projeto-barbearia/bd/banco.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/agendamento_model.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/Usuario.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/mensagem.php';

class DaoAgendamento {
    
    public function inserirAgendamentoDAO(Agendamento $agend){
        $conn = new Conecta();
        $msg = new Mensagem();
        $conecta = $conn->conectadb();
        if($conecta){
            $horario = $agend->getHorario();
            $dataAgendamento = $agend->getDataAgenda();
            $formaPagamento = $agend->getForma_Pagamento();
            $status = $agend->getStatusAgendamento();
            $dateTime = $agend->getDateTime();
            $pagamento = $agend->getDataPagemento();
            $confirmar = $agend->getConfirma();
            $valor = $agend->getValor();
            $usuario = $agend->getUsuarioID();

            // Verificando se a data é UTC.
            $defaultTimeZone='UTC';
            if(date_default_timezone_get()!=$defaultTimeZone) date_default_timezone_set($defaultTimeZone);

            // Função para trabalhar a data com o código abaxio passando ela para GMT e 
            // colocando tipos de formatação de data.
            function _dateRegis($format="r", $timestamp=false, $timezone=false) {
                $userTimezone = new DateTimeZone(!empty($timezone) ? $timezone : 'GMT');
                $gmtTimezone = new DateTimeZone('GMT');
                $myDateTime = new DateTime(($timestamp!=false?date("r",(int)$timestamp):date("r")), $gmtTimezone);
                $offset = $userTimezone->getOffset($myDateTime);
                return date($format, ($timestamp!=false?(int)$timestamp:$myDateTime->format('U')) + $offset);
            }

            /* Chamando a função _date para dentro de uma variável e depois inserindo uma data 
                automática no Banco juntamente com os outros dados */
           $dateTime = _dateRegis("Y-m-d H:i:s", false, 'America/Sao_Paulo');

            try {
                // id, horario, data, forma_de_pagamento, status_agendamento, data_regs_agendamento,
                // data_do_pagamento, confir_envio, cliente_id, despesas_id;
                $stmt = $conecta->prepare("insert into agendamentos values "
                        . "(null, ?, ?, ?, ?, '$dateTime', ?, ?, ?, ?)");
                $stmt->bindParam(1, $horario);
                $stmt->bindParam(2, $dataAgendamento);
                $stmt->bindParam(3, $formaPagamento);
                $stmt->bindParam(4, $status);
                $stmt->bindParam(5, $pagamento);
                $stmt->bindParam(6, $confirmar);
                $stmt->bindParam(7, $valor);
                $stmt->bindParam(8, $usuario);
                $stmt->execute();
                
                $msg->setMsg("<p style='color: green;'>"
                        . "Dados Cadastrados com sucesso</p>");
            } catch (Exception $ex) {
                $msg->setMsg($ex);
            }
        }else{
            $msg->setMsg("<p style='color: red;'>"
                        . "Erro na conexão com o banco de dados.</p>");
        }
        $conn = null;
        return $msg;
    }


    public function ListarClienteAgendamentoDAO(){
        $conn = new Conecta();
        $msg = new Mensagem();
        $conecta = $conn->conectadb();
        if ($conecta) {
            try {
                $conecta->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $rs = $conecta->query("select * from agendamentos"
                    . " inner join usuario on agendamentos.usuario_id = usuario.id");
                $lista = array();
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

                            $agenda = new Agendamento();
                            $agenda->setId($linha->idAgendamento);
                            $agenda->setHorario($linha->horario);
                            $agenda->setDataAgenda($linha->data);
                            $agenda->setForma_Pagamento($linha->forma_de_pagamento);
                            $agenda->setStatusAgendamento($linha->status_agendamento);
                            $agenda->setDateTime($linha->data_regs_agendamento);
                            $agenda->setDataPagemento($linha->data_do_pagamento);
                            $agenda->setConfirma($linha->confir_envio);
                            $agenda->setValor($linha->valortotal);

                            $agenda->setUsuarioID($usuario);
                            $lista[$a] = $agenda;
                            $a++;
                        }
                    }
                }
            } catch (PDOException $ex) {
                $msg->setMsg(var_dump($ex->errorInfo));
            }
            $conn = null;
            return $lista;
        }
    }

}

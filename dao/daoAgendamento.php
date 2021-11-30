<?php
include_once 'C:/xampp/htdocs/Projeto-barbearia/bd/banco.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/agendamento_model.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/agendamento_dos_servicos.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/Usuario.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/mensagem.php';


class DaoAgendamento {
    
    public function inserirAgendamentoDAO(Agendamento $agend, Agendamentos_dos_servicos $agServicos){
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

            $funcionarioId = $agServicos->getIdFuncionario();
            $servicoId = $agServicos->getIdServicos();

            $funcionarioId2 = $agServicos->getIdFuncionario();
            $servicoId2 = $agServicos->getIdServicos();

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
                $conecta->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
                
                $rs = $conecta->prepare("select idAgendamento from agendamentos where data = ? and horario = ? and usuario_id = ? limit 1");
                $rs->bindParam(1, $dataAgendamento);
                $rs->bindParam(2, $horario);
                $rs->bindParam(3, $usuario);
                if ($rs->execute()) {
                    if ($rs->rowCount() > 0) {
                        while ($linha = $rs->fetch(PDO::FETCH_OBJ)) {
                            $agend->setId($linha->idAgendamento);
                            $agendamentoId = $agend->getId();
                        }
                    }
                }
                
                $msg->setMsg("<p style='color: green;'>"
                        . "Dados Cadastrados com sucesso</p>");
            } catch (PDOException $ex) {
                $msg->setMsg(var_dump($ex->errorInfo));
                echo "\n id do Agendamento: " . $agendamentoId . "_";
                echo "\n <br>data do Agendamento: " . $dataAgendamento;
                echo "\n <br>Horário do Agendamento: " . $horario;

                echo "\n <br>funcionario " . $funcionarioId;
                echo "\n <br>servico: " . $servicoId;
            }
            //$agendamentoId = 1;
            $stmt = $conecta->prepare("insert into agendamentos_dos_servicos values "
                . "(?, ?, ?)");
                $stmt->bindParam(1, $agendamentoId);
                $stmt->bindParam(2, $funcionarioId);
                $stmt->bindParam(3, $servicoId);
            $stmt->execute(); 
        }else{
            $msg->setMsg("<p style='color: red;'>"
                        . "Erro na conexão com o banco de dados.</p>");
        }
        $conn = null;
        return $msg;
    }

    public function ListarClienteAgendamentoDAO(){
        $id = $_SESSION['idc'];
        $conn = new Conecta();
        $msg = new Mensagem();
        $conecta = $conn->conectadb();
        if ($conecta) {
            try {
                $conecta->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $rs = $conecta->query("select * from agendamentos"
                    . " inner join usuario on agendamentos.usuario_id = usuario.id where usuario.id = ". $id);
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

    public function ListarClienteAgendamentoDAO02(){
        $id = $_SESSION['idc'];
        $conn = new Conecta();
        $msg = new Mensagem();
        $conecta = $conn->conectadb();
        if ($conecta) {
            try {
                $conecta->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $rs = $conecta->query("SELECT * FROM `agendamentos_dos_servicos` "
                    ."inner JOIN agendamentos on agendamentos.idAgendamento = agendamentos_dos_servicos.agendamentos_id "
                    ."WHERE agendamentos_dos_servicos.sf_funcionario = ".$id);
                $lista = array();
                $a = 0;
                if ($rs->execute()) {
                    if ($rs->rowCount() > 0) {
                        while ($linha = $rs->fetch(PDO::FETCH_OBJ)) {

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
                            $agenda->setUsuarioID($linha->usuario_id);

                            $ageServ = new Agendamentos_dos_servicos();
                            $ageServ->setIdAgendamento($agenda);
                            $ageServ->setIdFuncionario($linha->sf_funcionario);
                            $ageServ->setIdServicos($linha->sf_servicos);

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

    public function ListarClienteAgendamentoDAO03(){
        $conn = new Conecta();
        $msg = new Mensagem();
        $conecta = $conn->conectadb();
        if ($conecta) {
            try {
                $conecta->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $rs = $conecta->query("SELECT * FROM `agendamentos_dos_servicos` inner JOIN agendamentos on agendamentos.idAgendamento = agendamentos_dos_servicos.agendamentos_id;");
                $lista = array();
                $a = 0;
                if ($rs->execute()) {
                    if ($rs->rowCount() > 0) {
                        while ($linha = $rs->fetch(PDO::FETCH_OBJ)) {
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
                            $agenda->setUsuarioID($linha->usuario_id);

                            $ageServ = new Agendamentos_dos_servicos();
                            $ageServ->setIdAgendamento($agenda);
                            $ageServ->setIdFuncionario($linha->sf_funcionario);
                            $ageServ->setIdServicos($linha->sf_servicos);

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

    public function ListarClienteAgendamentoDAO04(){
        $conn = new Conecta();
        $msg = new Mensagem();
        $conecta = $conn->conectadb();
        if ($conecta) {
            try {
                $conecta->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $rs = $conecta->query("select * from agendamentos where status_agendamento = 'agendado' order by data, horario asc");
                $lista = array();
                $a = 0;
                if ($rs->execute()) {
                    if ($rs->rowCount() > 0) {
                        while ($linha = $rs->fetch(PDO::FETCH_OBJ)) {
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
                            $agenda->setUsuarioID($linha->usuario_id);

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


    //método para excluir produto na tabela produto
    public function excluirAgendamentoDAO($id){
        $conn = new Conecta();
        $conecta = $conn->conectadb();
        $msg = new Mensagem();
        if($conecta){
            try {
                $conecta->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $conecta->prepare("DELETE from agendamentos_dos_servicos WHERE agendamentos_id = ?");
                $stmt->bindParam(1, $id);
                $stmt->execute();

                $msg->setMsg("<p style='color: #d6bc71;'>"
                        . "Dados excluídos com sucesso.</p>");
            } catch (PDOException $ex) {
                $msg->setMsg(var_dump($ex->errorInfo));
            }
        }else{
            $msg->setMsg("<p style='color: red;'>'Banco inoperante!'</p>"); 
        }
        $conn = null;
        return $msg;
    }


    public function excluirAgendamentoDAO2($id){
        $conn = new Conecta();
        $conecta = $conn->conectadb();
        $msg = new Mensagem();
        if($conecta){
            try {
                $conecta->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $conecta->prepare("DELETE from agendamentos WHERE idAgendamento = ?");
                $stmt->bindParam(1, $id);
                $stmt->execute();

                $msg->setMsg("<p style='color: #d6bc71;'>"
                        . "Dados excluídos com sucesso.</p>");
            } catch (PDOException $ex) {
                $msg->setMsg(var_dump($ex->errorInfo));
            }
        }else{
            $msg->setMsg("<p style='color: red;'>'Banco inoperante!'</p>"); 
        }
        $conn = null;
        return $msg;
    }

}



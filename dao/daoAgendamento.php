<?php
include_once 'C:/xampp/htdocs/Projeto-barbearia/bd/banco.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/agendamento_model.php';

class DaoAgendamento {
    
    public function inserirDataDAO(Agendamento $agend){
        $conn = new Conecta();
        $msg = new Mensagem();
        $conecta = $conn->conectadb();
        if($conecta){
            $data = $agend->getDataAgenda();
            $horario = $agend->getHorario();
            $dateTime = $agend->getDateTime();

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
                        . "(null, ?, ?, '$dateTime')");
                $stmt->bindParam(1, $data);
                $stmt->bindParam(2, $horario);
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

}

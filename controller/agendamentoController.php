<?php
include_once 'C:/xampp/htdocs/Projeto-barbearia/dao/daoAgendamento.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/dao/daoDashboard.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/agendamento_model.php';

class AgendamentoController {
    
    public function inserirAgendamento($horario, $data, $formaPagamento, $status,
                                $Datapagamento, $confirmar, $valor, $usuario){

        $agenda = new Agendamento();
        $agenda->setHorario($horario);
        $agenda->setDataAgenda($data);
        $agenda->setForma_Pagamento($formaPagamento);
        $agenda->setStatusAgendamento($status);
        $agenda->setDataPagemento($Datapagamento);
        $agenda->setConfirma($confirmar);
        $agenda->setValor($valor);
        $agenda->setUsuarioID($usuario);
       //$forne->setDateTime($dateTime);
        
        $daoagenda = new DaoAgendamento();
        return $daoagenda->inserirAgendamentoDAO($agenda);
    }
/*
    public function PesquisarValor(){
        $agendamento = new Agendamento();

        $daoAgendamento = new daoDashboard();
        return $daoAgendamento->pesquisarValorDAO();
    }
*/

    public function ListarClienteAgendamento(){
        $daoAgendamento = new DaoAgendamento();
        return $daoAgendamento->ListarClienteAgendamentoDAO();
    }


}

?>
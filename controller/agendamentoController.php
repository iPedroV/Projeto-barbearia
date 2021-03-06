<?php
include_once 'C:/xampp/htdocs/Projeto-barbearia/dao/daoAgendamento.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/dao/daoDashboard.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/agendamento_model.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/agendamento_dos_servicos.php';

class AgendamentoController {
    
    public function inserirAgendamento($horario, $data, $formaPagamento, $status,
                                $Datapagamento, $confirmar, $valor, $usuario, $IDFunc, $IDServ){

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

        $agendServicos = new Agendamentos_dos_servicos();
        $agendServicos->setIdFuncionario($IDFunc);
        $agendServicos->setIdServicos($IDServ);
        
        $daoagenda = new DaoAgendamento();
        return $daoagenda->inserirAgendamentoDAO($agenda, $agendServicos);
    }

    public function ListarClienteAgendamento(){
        $daoAgendamento = new DaoAgendamento();
        return $daoAgendamento->ListarClienteAgendamentoDAO();
    }

    public function ListarClienteAgendamento02(){
        $daoAgendamento = new DaoAgendamento();
        return $daoAgendamento->ListarClienteAgendamentoDAO02();
    }

    public function ListarClienteAgendamento03(){
        $daoAgendamento = new DaoAgendamento();
        return $daoAgendamento->ListarClienteAgendamentoDAO03();
    }

    public function ListarClienteAgendamento04(){
        $daoAgendamento = new DaoAgendamento();
        return $daoAgendamento->ListarClienteAgendamentoDAO04();
    }

    public function excluirAgendamento($id){
        $daoAgendamento = new DaoAgendamento();
        return $daoAgendamento->excluirAgendamentoDAO($id);
    }
    
    public function excluirAgendamento2($id){
        $daoAgendamento = new DaoAgendamento();
        return $daoAgendamento->excluirAgendamentoDAO2($id);
    }

}

?>
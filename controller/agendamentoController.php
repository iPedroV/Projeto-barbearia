<?php
include_once 'C:/xampp/htdocs/Projeto-barbearia/dao/daoAgendamento.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/dao/daoDashboard.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/agendamento_model.php';

class AgendamentoController {
    
    public function inserirDataAgendamento($data, $horario){

        $forne = new Agendamento();
        $forne->setDataAgenda($data);
        $forne->setHorario($horario);
       //$forne->setDateTime($dateTime);
        
        $daofORNE = new DaoAgendamento();
        return $daofORNE->inserirDataDAO($forne);
    }
/*
    public function PesquisarValor(){
        $agendamento = new Agendamento();

        $daoAgendamento = new daoDashboard();
        return $daoAgendamento->pesquisarValorDAO();
    }
*/


}

?>
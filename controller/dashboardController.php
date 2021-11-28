<?php

include_once 'C:/xampp/htdocs/Projeto-barbearia/dao/daoDashboard.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/agendamento_model.php';


class DashboardController {
    
    public function ListarTodosAgendamentos(){
        $daoDashboard = new daoDashboard();
        return $daoDashboard->ListarTodosAgendamentosDAO();
    }

    public function ListarTodasDespesas(){
        $daoDashboard = new daoDashboard();
        return $daoDashboard->ListarTodasDespesasDAO();
    }

    public function concluirAgendamento($id){
        $daoDashboard = new daoDashboard();
        return $daoDashboard->concluirAgendamentoDAO($id);
    }
}

?>
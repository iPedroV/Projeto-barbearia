<?php
include_once 'C:/xampp/htdocs/Projeto-barbearia/dao/daoAgendamento.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/servicos_model.php';

class ServicosController {
    
    public function listarServicos(){
        $daoServico = new DaoServicos();
        return $daoServico->listarServicosDAO();
    }

}
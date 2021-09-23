<?php
include_once 'C:/xampp/htdocs/Projeto-barbearia/dao/daoServicos_has_funcionarios.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/servicos_has_funcionarios.php';

class Servicos_has_funcionariosController {
    
    public function listarServicos_has_funcionarios(){
        $daoServico = new DaoServicos_agendamentos();
        return $daoServico->listarServicos_has_funcionariosDAO();
    }

    public function pesquisarFuncionariosId($id){
        $daoServico = new DaoServicos_agendamentos();
        return $daoServico->pesquisarServicos_has_funcionariosDAO($id);
    }

}
<?php
include_once 'C:/xampp/htdocs/Projeto-barbearia/dao/daoServicos.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/servicos_model.php';

class ServicosController {
    
    public function listarServicos(){
        $daoServico = new DaoServicos();
        return $daoServico->listarServicosDAO();
    }

    public function inserirServicos($nome, $valor, $tempo){
        $servicos = new Servicos_model();
        $servicos->setNomeServico($nome);
        $servicos->setValorServico($valor);
        $servicos->setTempoServico($tempo);
        
        $daoservicos = new DaoServicos();
        return $daoservicos->inserirServicoDAO($servicos);
    }

    public function excluirServico2($id){
        $daoservicos = new DaoServicos();
        return $daoservicos->excluirServicoDAO02($id);
    }

    public function excluirServico($id){
        $daoservicos = new DaoServicos();
        return $daoservicos->excluirServicoDAO($id);
    }

    public function pesquisarServicoId($id){
        $daoservicos = new DaoServicos();
        return $daoservicos->pesquisarServicoIdDAO($id);
    }

    public function editarServico($id){
        $daoservicos = new DaoServicos();
        return $daoservicos->editaServicoDAO($id);
    }

}
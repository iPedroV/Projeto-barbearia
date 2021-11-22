<?php
include_once 'C:/xampp/htdocs/Projeto-barbearia/bd/banco.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/servicos_model.php';

class DaoServicos {
    
    public function listarServicosDAO(){
        $conn = new Conecta();
        $msg = new Mensagem();
        $conecta = $conn->conectadb();
        if ($conecta) {
            try{
                $serag = $conecta->query("select * from servicos");
                $lista = array();
                $a = 0;
                if($serag->execute()){
                    if($serag->rowCount() > 0){
                        while($linha = $serag->fetch(PDO::FETCH_OBJ)){
                            $servicos = new Servicos_model();
                            $servicos->setIdServicos($linha->idServicos);
                            $servicos->setNomeServico($linha->nome);
                            $servicos->setValorServico($linha->valor);
                            $servicos->setTempoServico($linha->tempo_estimado);
                           
                            $lista[$a] = $servicos;
                            $a++;
                        }
                    }
                }
            } catch (Exception $ex) {
                $msg->setMsg($ex);
            }  
            $conn = null;
            return $lista;
        }
    
    }

}

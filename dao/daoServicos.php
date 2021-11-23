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

    public function inserirServicoDAO(Servicos_model $servicos){
    
        $conn = new Conecta();
        $msg = new Mensagem();
        $conecta = $conn->conectadb();

        if ($conecta) {
            
            $resp = null;
            
            $nome = $servicos->getNomeServico();
            $valor = $servicos->getValorServico();
            $tempo = $servicos->getTempoServico();
            
            
            
            


            try {
                $st = $conecta->prepare("SELECT * FROM servicos where nome = ?");
                $st->execute([$nome]);
                $result = $st->rowCount();
                if($result >0){
                    $resp = $servicos;
                }else{
                    $stmt = $conecta->prepare("insert into servicos values "
                    . "(null,?,?,?)");

                $stmt->bindParam(1, $nome);
                $stmt->bindParam(2, $valor);
                $stmt->bindParam(3, $tempo);
                
                $stmt->execute();
                $resp = "<p style='color: green;'>"
                    . "Dados Cadastrados com sucesso</p>";
                }
                
            } catch (Exception $ex) {
                $resp = $ex;
            }
        } else {
            $resp = "<p style='color: red;'>"
                . "Erro na conexão com o banco de dados.</p>";
        }
        $conn = null;
        return $resp;
    }

}

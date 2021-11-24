<?php
include_once 'C:/xampp/htdocs/Projeto-barbearia/bd/banco.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/servicos_model.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/servicos_has_funcionarios.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/funcionario.php';

class DaoServicos_agendamentos {
    
    public function listarServicos_has_funcionariosDAO(){
        $conn = new Conecta();
        $msg = new Mensagem();
        $conecta = $conn->conectadb();
        $servFunc = new Servicos_has_funcionarios();
        
        if ($conecta) {
            try{
                $conecta->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $serag = $conecta->prepare("select * from servicos_has_funcionarios "
                    ."left join servicos on servicos.id = servicos_has_funcionarios.servicos_id "
                    ."left join funcionarios on funcionarios.id = "
                    ."servicos_has_funcionarios.funcionarios_id");
                    //comando de delete
                    //DELETE f,s FROM servicos_do_funcionario AS f JOIN servicos AS s ON f.servicos_id = s.idServicos WHERE s.idServicos = 16 AND f.servicos_id = 16
                    //comando correto abaixo
                    /* select * from servicos_do_funcionario left join servicos on servicos.idServicos = servicos_do_funcionario.servicos_id left join usuario on usuario.id = servicos_do_funcionario.funcionarios_id*/
                $lista = array();
                $a = 0;
                if($serag->execute()){
                    if($serag->rowCount() > 0){
                        while($linha = $serag->fetch(PDO::FETCH_OBJ)){
                            
                            //$servFunc->setServicos_id($linha->servicos_id);
                            //$servFunc->setFuncionarios_id($linha->funcionarios_id);

                            $servicos = new Servicos_model();
                            $servicos->setIdServicos($linha->id);
                            $servicos->setNomeServico($linha->nome);
                            $servicos->setValorServico($linha->valor);
                            $servicos->setTempoServico($linha->tempo_estimado);

                            $func = new Funcionario();
                            $func->setIdFuncionario($linha->id);
                            $func->setNome($linha->nome);
                            $func->setCargo($linha->cargo);
                            $func->setTelefone($linha->telefone);
                            $func->setEmail($linha->email);
                            $func->setSenha($linha->senha);

                            $servFunc->setServicos_id($servicos);
                            $servFunc->setFuncionarios_id($func);
                           
                            $lista[$a] = $servFunc;
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

    public function pesquisarServicos_has_funcionariosDAO($id){
        $conn = new Conecta();
        $msg = new Mensagem();
        $conecta = $conn->conectadb();
        $servFunc = new Servicos_has_funcionarios();
        
        if ($conecta) {
            try{
                $conecta->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $serag = $conecta->prepare("select * from servicos_has_funcionarios "
                    ."left join servicos on servicos.id = servicos_has_funcionarios.servicos_id "
                    ."left join funcionarios on funcionarios.id = "
                    ."servicos_has_funcionarios.funcionarios_id "
                    ."WHERE servicos.id = ?");
                $serag->bindParam(1, $id);
                if($serag->execute()){
                    if($serag->rowCount() > 0){
                        while($linha = $serag->fetch(PDO::FETCH_OBJ)) {
                            
                            //$servFunc->setServicos_id($linha->servicos_id);
                            //$servFunc->setFuncionarios_id($linha->funcionarios_id);

                            $servicos = new Servicos_model();
                            $servicos->setIdServicos($linha->id);
                            $servicos->setNomeServico($linha->nome);
                            $servicos->setValorServico($linha->valor);
                            $servicos->setTempoServico($linha->tempo_estimado);

                            $func = new Funcionario();
                            $func->setIdFuncionario($linha->id);
                            $func->setNome($linha->nome);
                            $func->setCargo($linha->cargo);
                            $func->setTelefone($linha->telefone);
                            $func->setEmail($linha->email);
                            $func->setSenha($linha->senha);

                            $servFunc->setServicos_id($servicos);
                            $servFunc->setFuncionarios_id($func);
                           
                        }
                    }
                }
            } catch (PDOException $ex) {
                $msg->setMsg(var_dump($ex->errorInfo));
            }  
            $conn = null;

        } else {
            echo "<script>alert('Banco inoperante!')</script>";
            echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"0;
            URL='http://localhost/Calendario/agendamento.php\">";
        }
        return $servFunc;
    }

}

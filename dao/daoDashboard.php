<?php

/*

TESTE PARA O AJAX

include_once 'C:/xampp/htdocs/Projeto-barbearia/bd/banco.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/agendamento_model.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/Mensagem.php';

class daoDashboard
{

    public function pesquisarValorDAO()
    {
        $msg = new Mensagem();
        $conn = new Conecta();
        $conecta = $conn->conectadb();
        $agendamento = new Agendamento();
        if ($conecta) {
            try {
                $rs = $conecta->prepare("select * from agendamentos where "
                    . "id = 1");
                
                if ($rs->execute()) {
                    if ($rs->rowCount() > 0) {
                        while ($linha = $rs->fetch(PDO::FETCH_OBJ)) {
                            $agendamento->setId($linha->id);
                            $agendamento->setValor($linha->valortotal);
                            
                           
                        }
                    }
                }
            } catch (Exception $ex) {
                $msg->setMsg($ex);
            }
            $conn = null;
        } else {
            echo "<script>alert('Banco inoperante!')</script>";
            echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"0;
			 URL='../Projeto-Barbearia/index.php'\">";
        }
        return $agendamento;
    }

   
}
*/
?>
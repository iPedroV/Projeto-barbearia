<?php


include_once 'C:/xampp/htdocs/Projeto-barbearia/bd/banco.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/Clientes.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/Mensagem.php';

class DaoClientes
{

    public function listarClientesDAO()
    {
        $msg = new Mensagem();
        $conn = new Conecta();
        $conecta = $conn->conectadb();
        if ($conecta) {
            try {
                $rs = $conecta->query("select * from clientes");
                $lista = array();
                $a = 0;
                if ($rs->execute()) {
                    if ($rs->rowCount() > 0) {
                        while ($linha = $rs->fetch(PDO::FETCH_OBJ)) {
                            $clientes = new Clientes();
                            $clientes->setId($linha->id);
                            $clientes->setSenha($linha->senha);
                            $clientes->setNome($linha->nome);
                            $clientes->setSexo($linha->sexo);
                            $clientes->setEmail($linha->email);
                            $clientes->setTelefone($linha->telefone);
                            
                      

                            $lista[$a] = $clientes;
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

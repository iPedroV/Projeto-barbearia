<?php

include_once 'c:/xampp/htdocs/Projeto-barbearia/bd/banco.php';
include_once 'c:/xampp/htdocs/Projeto-barbearia/model/Clientes.php';
include_once 'c:/xampp/htdocs/Projeto-barbearia/model/mensagem.php';

class DaoLogin
{

    public function validarLoginDAO($email, $senha)
    {
        $conn = new Conecta();
        $cliente = new Clientes();

        $conecta = $conn->conectadb();
        if ($conecta) {

            try {
                $vl = $conecta->prepare("select * from clientes where login = ? and senha = ? limit");

                $vl->bindParam(1, $email);
                $vl->bindParam(2, $senha);

                if ($vl->execute()) {
                    if ($vl->rowCount() > 0) {
                        while ($valida = $vl->fetch(PDO::FETCH_OBJ));

                        $cliente->setId($valida->idcliente);
                        $cliente->setNome($valida->nomeCliente);
                    }
                    return $cliente;
                } else {
                    return "<p style='color: red'>'Usuário inexistente!'</p>";
                }
            } catch (PDOException $ex) {
                return "<p style='color: red;'>'Erro no Banco de dados!'</p>" . $ex;
            }
        }else{
            return "<p style='color: red;'> 'Banco de dados inoperante!'</p>";
        }
    }
}

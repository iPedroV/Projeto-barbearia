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
                $conecta->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $vl = $conecta->prepare("select * from clientes where senha = md5(?)".
                " and email = ? limit 1");
                
                $vl->bindParam(1, $senha);
                $vl->bindParam(2, $email);
                
                if ($vl->execute()) {
                    if ($vl->rowCount() > 0) {
                        while ($valida = $vl->fetch(PDO::FETCH_OBJ)){
                            $cliente->setId($valida->id);
                            $cliente->setNome($valida->nome);
                            $cliente->setEmail($valida->email);
                            //$teste = $cliente->getEmail();
                            //echo "<script>alert('$teste')</script>";
                        }
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

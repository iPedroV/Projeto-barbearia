<?php

include_once 'C:/xampp/htdocs/Projeto-barbearia/dao/DaoClientes.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/Clientes.php';

class ClientesController {
    
    public function inserirClientes( $senha, 
            $nome, $sexo, $email, $telefone){
        $clientes = new Clientes();
        
        $clientes->setSenha($senha);
        $clientes->setNome($nome);
        $clientes->setSexo($sexo);
        $clientes->setEmail($email);
        $clientes->setTelefone($telefone);
        
        $daoClientes = new DaoClientes();
        return $daoClientes->inserir($clientes);
    }

    public function listarCliente(){
        $daoClientes = new DaoClientes();
        return $daoClientes->listarClientesDAO();
    }
}

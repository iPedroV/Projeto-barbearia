<?php

include_once 'C:/xampp/htdocs/Projeto-barbearia/dao/DaoClientes.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/dao/daoIndex.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/Clientes.php';

class ClientesController {
    
    public function inserirClientes( $nome, 
            $telefone, $email, $senha, $sexo){
        $clientes = new Clientes();
        
        $clientes->setNome($nome);
        $clientes->setTelefone($telefone);
        $clientes->setEmail($email);
        $clientes->setSenha($senha);
        $clientes->setSexo($sexo);
        
        $daoClientes = new DaoClientes();
        return $daoClientes->inserir($clientes);
    }

    public function listarCliente($id){
        $daoClientes = new daoIndex();
        return $daoClientes->pesquisarClienteDAO($id);
    }
}

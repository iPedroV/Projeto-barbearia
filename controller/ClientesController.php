<?php

include_once 'C:/xampp/htdocs/Projeto-barbearia/dao/DaoClientes.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/dao/daoIndex.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/Usuario.php';

class ClientesController {
    
    public function inserirClientes( $nome, 
            $telefone, $email, $senha, $sexo){
        $clientes = new Usuario();
        
        $clientes->setNome($nome);
        $clientes->setTelefone($telefone);
        $clientes->setEmail($email);
        $clientes->setSenha($senha);
        $clientes->setSexo($sexo);
        
        $daoClientes = new DaoClientes();
        return $daoClientes->inserir($clientes);
    }


    public function pesquisarEmailcliente($email){
        $daoClientes2 = new DaoClientes();
        return $daoClientes2->pesquisarEmailClienteDAO($email);
    }

    public function PesquisarIdCLiente($email){
        $daoClientes = new DaoClientes();
        return $daoClientes->pesquisarIdClienteoDAO($email);
    }

    public function editarSenhaClientes($senha, $id){

        $cliente = new Usuario();
        $cliente->setSenha($senha);
        $cliente->setId($id);

        $daoClientes3 = new DaoClientes();
        return $daoClientes3->atualizarSenhaDAO($cliente);

    }
}

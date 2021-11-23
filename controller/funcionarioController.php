<?php

include_once 'C:/xampp/htdocs/Projeto-barbearia/dao/daoFuncionario.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/enviar.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/Usuario.php';

class FuncionarioController
{

    public function inserirFuncionario(
        $nome,
        $perfil,
        $telefone,
        $email,
        $senha,
        $sexo,
        $token) {
        $funcionarios = new Usuario();

        $funcionarios->setNome($nome);
        $funcionarios->setPerfil($perfil);
        $funcionarios->setTelefone($telefone);
        $funcionarios->setEmail($email);
        $funcionarios->setSenha($senha);
        $funcionarios->setSexo($sexo);
        $funcionarios->setToken($token);
        

        $daofuncionarios = new DaoFuncionario();
        return $daofuncionarios->inserirFuncionarioDAO($funcionarios);
    }

    public function listarFuncionario(){
        $daoClientes = new DaoFuncionario();
        return $daoClientes->pesquisarFuncionarioDAO();
    }

    public function EnviarSenhaController(){
        $email = new Enviar();
        return $email->EnviarEmailSenha();
    }
    public function editarSenhaFuncionarios($senha, $token){

        $funcionario = new Usuario();
        $funcionario->setSenha($senha);
        $funcionario->setToken($token);

        $daoClientes3 = new DaoFuncionario();
        return $daoClientes3->atualizarSenhaFuncioanrioDAO($funcionario);

    }
    public function excluirFuncionario($id){
        $daoPessoa = new DaoFuncionario();
        return $daoPessoa->excluirFuncionarioDAO($id);
    }
    
    public function pesquisarFuncionarioId($id){
        $daoPessoa = new DaoFuncionario();
        return $daoPessoa->pesquisarFuncionarioIdDAO($id);
    }

    /*public function tokenenviar(){
        $daoPessoa = new DaoFuncionario();
        return $daoPessoa->token();
    }*/
}

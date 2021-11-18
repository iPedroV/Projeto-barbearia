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
        $sexo) {
        $funcionarios = new Usuario();

        $funcionarios->setNome($nome);
        $funcionarios->setPerfil($perfil);
        $funcionarios->setTelefone($telefone);
        $funcionarios->setEmail($email);
        $funcionarios->setSenha($senha);
        $funcionarios->setSexo($sexo);
        

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
    public function editarSenhaFuncionarios($senha, $email){

        $funcionario = new Usuario();
        $funcionario->setSenha($senha);
        $funcionario->setEmail($email);

        $daoClientes3 = new DaoFuncionario();
        return $daoClientes3->atualizarSenhaFuncioanrioDAO($funcionario);

    }
}

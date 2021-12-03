<?php

include_once 'C:/xampp/htdocs/Projeto-barbearia/dao/daoFuncionario.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/enviar.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/Usuario.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/servicos_has_funcionarios.php';

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

    //Envio de email para o funcionario com todas as infomações de cadstro
    public function EnviarSenhaController(){
        $email = new Enviar();
        return $email->EnviarEmailSenha();
    }

    public function editarSenhaFuncionarios($senha, $email, $token){

        $funcionario = new Usuario();
        $funcionario->setSenha($senha);
        $funcionario->setEmail($email);
        $funcionario->setToken($token);

        $daoClientes3 = new DaoFuncionario();
        return $daoClientes3->atualizarSenhaFuncionarioDAO($funcionario);

    }
    public function excluirFuncionario($id){
        $daoPessoa = new DaoFuncionario();
        return $daoPessoa->excluirFuncionarioDAO($id);
    }
    
    public function pesquisarFuncionarioId($id){
        $daoPessoa = new DaoFuncionario();
        return $daoPessoa->pesquisarFuncionarioIdDAO($id);
    }

    public function editarFuncionario($id){
        $daoPessoa = new DaoFuncionario();
        return $daoPessoa->editarFuncionarioDAO($id);
    }

    public function ultimoIdInserido(){
        $daoPessoa = new DaoFuncionario();
        return $daoPessoa->ultimoIdInseridoDAO();

    }

    public function inserirFuncionarioAssociativa($test, $s){
        $funcionarios = new Servicos_has_funcionarios();
        

        $funcionarios->setServicos_id($test);
        $funcionarios->setFuncionarios_id($s);

        $daofuncionarios = new DaoFuncionario();
        return $daofuncionarios->inserirFuncionarioAssociativaDAO($funcionarios);
    }
    /*public function tokenenviar(){
        $daoPessoa = new DaoFuncionario();
        return $daoPessoa->token();
    }*/
}

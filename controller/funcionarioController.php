<?php

include_once 'C:/xampp/htdocs/Projeto-barbearia/dao/daoFuncionario.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/dao/daoIndex.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/funcionario.php';

class FuncionarioController
{

    public function inserirFuncionario(
        $nome,
        $perfil,
        $telefone,
        $email,
        $senha,
        $sexo) {
        $funcionarios = new Funcionario();

        $funcionarios->setNome($nome);
        $funcionarios->setPerfil($perfil);
        $funcionarios->setTelefone($telefone);
        $funcionarios->setEmail($email);
        $funcionarios->setSenha($senha);
        $funcionarios->setSexo($sexo);
        

        $daofuncionarios = new DaoFuncionario();
        return $daofuncionarios->inserirFuncionarioDAO($funcionarios);
    }
}

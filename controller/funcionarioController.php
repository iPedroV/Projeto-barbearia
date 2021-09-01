<?php
#Colocar os includ de acordo com a seu proprio máquina

Class FuncionarioController{

    #Preencher com os dados que vão vir da DAO
    public function inserrirFuncionario(){

        $daoFuncioario = new DaoFuncionario();
        return $daoFuncioario->inserirFuncionarioDAO();
    }
    public function excluirFuncionario(){

        $daoFuncioario = new DaoFuncionario();
        return $daoFuncioario->exluirFuncionarioDAO();
    }
    public function editarFuncionario(){

        $daoFuncioario = new DaoFuncionario();
        return $daoFuncioario->editarFuncionarioDAO();
    }
}

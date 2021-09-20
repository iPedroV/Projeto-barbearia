<?php

session_start($validarlogin);

include_once '../dao/daoLogin.php';
include_once '../model/Clientes.php';

if (isset($_POST['email'])){
    $email = $_POST['email'];
    $senha = $_POST['senha'];
}

$daoLogin = new DaoLogin();
$valcliente = new Clientes();

$valcliente = $daoLogin->validarLoginDAO($email, $senha);
if(gettype($valcliente) == "objetct"){
    if ($valcliente != null){
        if(!isset($_SESSION['email'])){
            $_SESSION['emailc'] = $valcliente->getEmail();
            $_SESSION['idp'] = $valcliente->getId();
            $_SESSION['nomec'] = $valcliente->getNome();

            header("Location: ../login.php");
            exit;
        }
    }
}else{
    $_SESSION['msg'] = $valcliente;
    if(isset($_SESSION['email'])){
        $_SESSION['emailc']=null;
        $_SESSION['idc']=null;
        $_SESSION['nomec']=null;
    }
    header("Location: ../login.php");
    exit;
}
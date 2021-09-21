<?php

ob_start();
session_start();
if(!empty($_POST) AND (empty($_POST['email']) OR empty($_POST['senha']))){
    header("Location: ../sessionDestroy.php"); exit;
}

include_once '../model/mensagem.php';
include_once '../dao/daoLogin.php';
include_once '../model/Clientes.php';

if (isset($_POST)){
    $email = $_POST['email'];
    $senha = $_POST['senha'];
}else{
    header("Location: ../sessionDestroy.php"); exit;
}

$daoLogin = new DaoLogin();
$valcliente = new Clientes();

$valcliente = $daoLogin->validarLoginDAO($email, $senha);

if(gettype($valcliente) == "object"){
        if(!isset($_SESSION['email'])){
            $_SESSION['emailc'] = $valcliente->getEmail();
            $_SESSION['idc'] = $valcliente->getId();
            $_SESSION['nomec'] = $valcliente->getNome();

            $_SESSION['nr'] = rand(1,1000000);
            $_SESSION['conferenr'] = $_SESSION['nr'];

            header("Location: ../index.php");
            exit;
        }
}else{
    $_SESSION['msg'] = $valcliente;
    if(isset($_SESSION['emailc'])){
        $_SESSION['emailc']=null;
        $_SESSION['idc']=null;
        $_SESSION['nomec']=null;
    }
    header("Location: ../login.php");
    exit;
}
ob_end_flush();
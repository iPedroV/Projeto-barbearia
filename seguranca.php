<?php 

if(!empty($_POST) AND !isset($_POST) AND (empty($_POST['email'])
OR empty($_POST['senha']))){
    header("Location: sessionDestroy.php");
    exit;
}

session_start($validarlogin);
if((!isset($_SESSION['emailc']) || !isset($_SESSION['nomep'])) 
    || !isset($_SESSION['nr']) ||
    $_SESSION['nr'] < 1 || ($_SESSION['nr'] != $_SESSION['conferenr'])) { 
    header("Location: sessionDestroy.php");
    exit;
}
<?php


include_once 'C:/xampp/htdocs/Projeto-barbearia/dao/daoFuncionario.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/controller/funcionarioController.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/Usuario.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/mensagem.php';

$msg = new Mensagem();

?>

<!DOCTYPE html>
<html lang="pt-bt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinição de Senha</title>
    <link rel="sorcut icon" href="img/barber-shop.png" type="image/png" style="width: 16px; height: 16px;">
    <Link rel="stylesheet" href="css/style-funcioanarionovasenha.css">
</head>

<body>
    <div id="senhafuncionario">
    <script src="Js/sweetalert2.all.min.js"></script>

    <?php 
    
    if (isset($_POST['alterarsenha'])) {
        if (($_POST['nsenha']) == ($_POST['csenha'])) {
                $senha = $_POST['nsenha'];
                $token = $_POST['token'];
                $ems = new FuncionarioController();
                $msg = $ems->editarSenhaFuncionarios($senha, $token);
                echo $msg->getMsg();
                header("refresh:2;url=login.php");
        }else {
            $msg->setMsg("<script>setTimeout(Swal.fire({
                icon: 'error',
                title: 'Senhas diferentes',
                text: 'Favor, escreva senhas iguais!',
                timer: 2000
                }))</script>");
            echo $msg->getMsg();
        }
        
    }

    
    ?>
        <img src="img/barbearianeves.png" class="imagem">
        <form method="post">
            <label for="n_senha">senha atual:</label>
            <input type="text" id="token1" name="token1" required>

            <label for="n_senha">Nova senha:</label>
            <input type="password" id="nsenha" name="nsenha" required>

            <label for="c_senha">Confirmar senha:</label>
            <input type="password" id="csenha" name="csenha" required>

            <button type="submit" class="btn efeito-btn" name="alterarsenha">Confirmar</button>
        </form>
    </div>

</body>

</html>
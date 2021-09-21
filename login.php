<?php
if(!isset($_SESSION)){
    session_start();
}
if(!isset($_SESSION['msg'])){
    $_SESSION['msg'] = "";
}

$_SESSION['nr'] = "-1";
$_SESSION['conferenr'] = "-2";

?>

<!DOCTYPE html>
<html lang="pt-bt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="sorcut icon" href="img/barber-shop.png" type="image/png" style="width: 16px; height: 16px;">
    <Link rel="stylesheet" href="css/style-login.css">
</head>

<body>
    <div id="login">
        <img src="img/barbearianeves.png" class="imagem">
        <form method="post" action="./controller/ValidaLogincontroller.php">
            <?php
                if($_SESSION['msg'] != ""){
                    echo $_SESSION['msg'];
                    $_SESSION['msg'] = "";
                }
            ?>
            <label for="usuario">E-mail:</label>
            <input id="usuario" placeholder="Digite seu usuário" name="email">

            <label for="senha">Senha:</label>
            <input type="password" id="senha" placeholder="Digite sua senha" name="senha">

            <button class="btn efeito-btn">Entrar</button>

            <a href="#" id="lembrar-senha">Esqueceu a sua senha?</a>
        </form>

        <div id="novo-cadastro">
            <p>Ainda não tem uma conta?</p>
            <a href="cadastro.html">Registre-se</a>
        </div>

    </div>

    <!--Modal de esqueceu a senha-->
    <div id="modal-esqueceu" class="modal-container">
        <div class="modal">
            <button class="fechar">x</button>

            <label for="recuperar-email">Email:</label>
            <input id="usuario" placeholder="Digite seu Email">
            <button class="btn efeito-btn">Enviar</button>

        </div>
    </div>
</body>

<script src="js/script-login.js"></script>

</html>
<?php
include_once 'C:/xampp/htdocs/Projeto-barbearia/enviar.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/controller/ClientesController.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/mensagem.php';



if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['msg'])) {
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font/awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
</head>

<style>
#textcaps {display:none;color:red}

</style>
<body>
    <div class="container">

        <img src="img/barbearianeves.png" class="imagem">

        <form method="post" action="./controller/ValidaLogincontroller.php">
            <?php
            if ($_SESSION['msg'] != "") {
                echo $_SESSION['msg'];
                $_SESSION['msg'] = "";
            }
            ?>
            <div class="detalhes-usuario">

                <div class="input-box">
                    <span class="detalhes">Email:</span>
                    <input id="usuario" type="email" placeholder="Digite seu email" name="email" required>
                </div>

                <div class="input-box">
                    <span class="detalhes">Senha:</span>
                    <input type="password" placeholder="Digite sua senha" name="senha" id="senha" required>
                    <p id="textcaps" class="caps">O Caps lock está ativado</p>
                </div>

                <a class="esqueciminhasenha" href="#" id="lembrar-senha">Esqueci minha senha</a>

                <span class="p-viewer2">
                    <i class="fas fa-eye" aria-hidden="true" id="olho" style="color: #000000;" onclick="toggle()"></i>
                    <i class="fas fa-eye-slash" id="risco" onclick="toggle()"></i>
                </span>

            </div>

            <button type="submit" class="btn efeito-btn" name="Enviar" value="Enviar">Entrar</button>

            <div class="naopossuiconta">
                <p>Não tem uma conta?</p><a href="cadastroClientes.php">Cadastrar</a>
            </div>

        </form>

    </div>

    <div id="modal-esqueceu" class="modal-container">
        <script src="Js/sweetalert2.all.min.js"></script>
        <?php
        if (isset($_POST['enviar'])) {
            $msg = new Mensagem();
            $EmailEnviado = new ClientesController();
            $msg = $EmailEnviado->EnviarEmailController();
            echo $msg->getMsg();
        }
        ?>
        <div class="modal">
            <button class="fechar">X</button>
            <form method="post">
                <div class="input-boxmodal">
                    <span class="detalhes" name="recuperaremail">Email:</span>
                    <input id="usuario" type="email" style="font-size: 20px; padding: 10px; " placeholder="Digite seu email" name="recuperaremail" required>
                </div>
                <button id="enviar" data-dismiss="modal" class="btn efeito-btn" name="enviar">Enviar</button>
            </form>
        </div>
    </div>

    <script>
var input = document.getElementById("senha");
var text = document.getElementById("textcaps");
input.addEventListener("keyup", function(event) {

if (event.getModifierState("CapsLock")) {
    text.style.display = "block";
  } else {
    text.style.display = "none"
  }
});
</script>
    <script>
        function toggle() {
            var x = document.getElementById("senha");
            if (x.type === "password") {
                x.type = "text";
                document.getElementById("risco").style.display = "inline-block";
                document.getElementById("olho").style.display = 'none';
                document.getElementById("risco").style.color = '#000000';
                document.getElementById("olho").style.color = '#000000';
            } else {
                x.type = "password";
                document.getElementById("risco").style.display = 'none';
                document.getElementById("olho").style.display = 'inline-block';
                document.getElementById("risco").style.color = '#000000';
                document.getElementById("olho").style.color = '#000000';
            }
        }
    </script>
</body>

<script src="js/script-login.js"></script>

</html>
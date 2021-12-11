<?php


include_once 'C:/xampp/htdocs/Projeto-barbearia/dao/DaoClientes.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/controller/ClientesController.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/Usuario.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/mensagem.php';

$email = $_GET['email'];
$data = $_GET['hora'];
$dia = $_GET['dia'];
date_default_timezone_set('America/Sao_Paulo'); // se tirasr isso o tempo +4 hours
$data_agora = date('His', strtotime('now'));
$dia_de_hoje = date('dmy', strtotime('now'));
$data3 = intval($data_agora);
$msg = new Mensagem();

?>

<!DOCTYPE html>
<html lang="pt-bt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinição de Senha</title>
<link rel="sorcut icon" href="img/barber-shop.png" type="image/png" style="width: 16px; height: 16px;">
<Link rel="stylesheet" href="css/style-novasenha.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font/awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
</head>

<style>
#textcaps {display:none;color:red}

</style>
<style>
#text {display:none;color:red}

</style>
<body>
    <div class="container">
    <script src="Js/sweetalert2.all.min.js"></script>

<?php

//Valdiação de senha
if (isset($_POST['esenha'])) {

    $ns = new ClientesController();
    //$emailC = $ns->pesquisarEmailcliente($email);
    //$id = $ns->PesquisarIdCLiente($email);

    /*(echo $emailC->getEmail();*/

    
        if (($_POST['nsenha']) == ($_POST['csenha'])) {
            $senha = $_POST['nsenha'];
            $ems = new ClientesController();
            $msg = $ems->editarSenhaClientes($senha, $email);
            echo $msg->getMsg();
            //sleep(1);
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
<?php
    
    if($data > $data3 && $dia_de_hoje < $dia){
?>
        <img src="img/barbearianeves.png" class="imagem">

        <form method="post">
          
            <div class="detalhes-usuario">

                <div class="input-box">
                    <span class="detalhes" for="n_senha">Nova Senha:</span>
                    <input type="password" id="nsenha" name="nsenha" placeholder="Digite sua nova senha" required>
                </div>

                <div class="input-box">
                    <span class="detalhes" for="c_senha">Confirmar Senha:</span>
                    <input type="password" placeholder="Confirme sua nova senha" id="csenha" name="csenha" required>
                    <p id="textcaps" class="caps">O Caps lock está ativado</p>
                </div>

             

                <span class="p-viewer2">
                    <i class="fas fa-eye" aria-hidden="true" id="olho" style="color: #000000;" onclick="toggle()"></i>
                    <i class="fas fa-eye-slash" id="risco" onclick="toggle()"></i>
                </span>

            </div>

            <button type="submit" class="btn efeito-btn" name="esenha" value="Enviar">Enviar</button>

           

        </form>
        <?php
    }else{
        $msg->setMsg("<script>setTimeout(Swal.fire({
            icon: 'error',
            title: 'Link expirado',
            text: 'Solicite o link novamente!',
            timer: 7000
          }))</script>");
          echo $msg->getMsg();
          echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"2;
          URL='login.php'\">";
    

?> 

        <img src="img/barbearianeves.png" class="imagem">

        <form method="post">
          
            <div class="detalhes-usuario">

                <div class="input-box">
                    <span class="detalhes" for="n_senha">Nova Senha:</span>
                    <input type="password" id="nsenha" name="nsenha" placeholder="Digite sua nova senha" disabled required>
                </div>

                <div class="input-box">
                    <span class="detalhes" for="c_senha">Confirmar Senha:</span>
                    <input type="password" placeholder="Confirme sua nova senha" id="csenha" name="csenha" disabled required>
                    <p id="textcaps" class="caps">O Caps lock está ativado</p>
                </div>

             

                <span class="p-viewer2">
                    <i class="fas fa-eye" aria-hidden="true" id="olho" disabled style="color: #000000;" ></i>
                    <i class="fas fa-eye-slash" id="risco" disabled ></i>
                </span>

            </div>

            <button type="submit" class="btn efeito-btn" name="esenha" disabled value="Enviar">Enviar</button>



    <?php
    }

?>

 
 <script>
        var senha = document.querySelector('#nsenha');

        senha.addEventListener('blur', (eventoLegal) => {
            verificaSenha(eventoLegal.target);
        })

        function verificaSenha(input) {
            var expSenha = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[$*&@#!"'%¨¬()+=§-_])[0-9a-zA-Z$*&@#!"'%¨¬()+=§-_]{8,}$/g;
            var senhaValida = expSenha.exec(input.value);
            var msgSenha = '';

            if (!senhaValida) {
                msgSenha = 'Precisa ter pelo menos 1 letra minúscula, maiúscula, número e caracter especial e ao menos 8 caracteres (!@#$&?*).';
            }

            input.setCustomValidity(msgSenha);

        }
    </script>

    <script>
var input = document.getElementById("nsenha");
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
var input = document.getElementById("csenha");
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
            var x = document.getElementById("csenha");
            var y = document.getElementById("nsenha");
            if (x.type, y.type === "password") {
                x.type = "text";
                y.type = "text";
                document.getElementById("risco").style.display = "inline-block";
                document.getElementById("olho").style.display = 'none';
                document.getElementById("risco").style.color = '#000000';
                document.getElementById("olho").style.color = '#000000';
            } else {
                x.type = "password";
                y.type = "password";
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
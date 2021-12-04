<?php


include_once 'C:/xampp/htdocs/Projeto-barbearia/dao/daoFuncionario.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/controller/funcionarioController.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/Usuario.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/mensagem.php';

$msg = new Mensagem();
$ce = new Usuario();

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Altere sua senha</title>
    <link rel="sorcut icon" href="img/barber-shop.png" type="image/png" style="width: 16px; height: 16px;">
    <Link rel="stylesheet" href="css/style-funcioanarionovasenha.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font/awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">


    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<style>
#text {display:none;color:red}

</style>
<style>
#textcaps {display:none;color:red}

</style>
<body>

    <div class="container">

        <div class="title"><span><b>A</b>lterar <b>S</b>enha</span></div>
        <script src="Js/sweetalert2.all.min.js"></script>
        <?php 
    
    if (isset($_POST['alterarsenha'])) {
        if (($_POST['nsenha']) == ($_POST['csenha'])) {
                $senha = $_POST['nsenha'];
                //$senha2 = $_POST['csenha'];
                $token = $_POST['token'];
                $email = $_POST['email'];
                
                $ce->setToken($token);
                $ce->setSenha($senha);
                $ce->setEmail($email);
                //$ce->setSenha($senha2);

                $ems = new FuncionarioController();
                $resp = $ems->editarSenhaFuncionarios($senha, $email, $token);
                if(getType($resp) == 'object'){
                    $msg = new Mensagem();
                    $ce = $resp;
                    $msg->setMsg("<script>setTimeout(Swal.fire({
                        icon: 'error',
                        title: 'Código incorreto',
                        text: 'Favor, insira o código corretamente!',
                        timer: 3000
                        }))</script>");
                    echo $msg->getMsg();
                }else{
                    $msg->setMsg("<script>setTimeout(Swal.fire({
                        icon: 'success',
                        title: 'Senha atualizada com sucesso!',
                        
                        timer: 2000
                        }))</script>");
                    echo $msg->getMsg();
                    header("refresh:2;url=login.php");
                }
                //echo $msg;
                
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

        <form method="post" >
            <div class="detalhes-usuario">
                <div class="input-box">
                    <span>Código Verificador</span>
                    <input type="text" id="token" name="token" placeholder="xxxxxxxxxx" value="<?php echo $ce->getToken(); ?>" required>
                </div>

                <div class="input-box">
                    <span class="detalhes">Confirme seu E-mail: </span>
                    <input type="text" id="email" name="email" placeholder="Confirme seu e-mail" required value="<?php echo $ce->getEmail(); ?>">
                </div>

                <div class="input-box">
                    <span class="detalhes" for="n_senha">Nova senha:</span>
                    <input type="password" placeholder="Digite sua senha" name="nsenha" id="nsenha" maxlength="11" required value="<?php echo $ce->getSenha(); ?>">
                </div>

                <div class="input-box">
              
                    <span class="detalhes" for="c_senha">Confirme sua Senha:</span>
                    <input type="password" placeholder="Confirme sua senha:" name="csenha" id="csenha" maxlength="11" required value="<?php echo $ce->getSenha(); ?>">
                    <p id="text" class="caps">O Caps lock está ativado</p>
                </div>

                <span class="p-viewer2">
                    <i class="fas fa-eye" aria-hidden="true" id="olho" style="color: #000000;" onclick="toggle()"></i>
                    <i class="fas fa-eye-slash" id="risco" onclick="toggle()"></i>
                </span>

            </div>

      

            <button type="submit" class="btn efeito-btn" name="alterarsenha">Cadastrar</button>
           
        </form>
    </div>
    <script>
var input = document.getElementById("csenha");
var text = document.getElementById("text");
input.addEventListener("keyup", function(event) {

if (event.getModifierState("CapsLock")) {
    text.style.display = "block";
  } else {
    text.style.display = "none"
  }
});
</script>
<script>
var input = document.getElementById("nsenha");
var text = document.getElementById("text");
input.addEventListener("keyup", function(event) {

if (event.getModifierState("CapsLock")) {
    text.style.display = "block";
  } else {
    text.style.display = "none"
  }
});
</script>

    <script>
        var senha = document.querySelector('#nsenha');

        senha.addEventListener('blur', (eventoLegal) => {
            verificaSenha(eventoLegal.target);
        })

        function verificaSenha(input) {
            var expSenha = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[$*&@#!"'%¨¬()+=§_-])[0-9a-zA-Z$*&@#!"'%¨¬()+=§_-]{8,}$/g;
            var senhaValida = expSenha.exec(input.value);
            var msgSenha = '';

            if (!senhaValida) {
                msgSenha = 'Precisa ter pelo menos 1 letra maiúscula, número e caracter especial e ao menos 8 caracteres (!@#$&?*).';
            }

            input.setCustomValidity(msgSenha);

        }
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

</html>
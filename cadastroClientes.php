<?php
include_once 'C:/xampp/htdocs/Projeto-barbearia/controller/ClientesController.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/Usuario.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/mensagem.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/bd/banco.php';
//require_once 'VerifyEmail.class.php'; 
$ce = new Usuario();
/*// Initialize library class
$mail = new VerifyEmail();

// Set the timeout value on stream
$mail->setStreamTimeoutWait(2);

// Set debug output mode
$mail->Debug= FALSE; 
$mail->Debugoutput= 'html'; 

// Set email address for SMTP request
$mail->setEmailFrom('from@email.com');*/

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cadastro Salão & Barbearia Neves</title>
    <link rel="stylesheet" href="./css/styleProjetin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font/awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">


    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>

    <div class="container">

        <div class="title"><span><b>C</b></span>adastro</div>

        <?php
        $conn = new Conecta();
        $msg = new Mensagem();
        $conecta = $conn->conectadb();
        if (isset($_POST['cadastrar'])) {
            $senha = trim($_POST['senha']);
            if ($senha != "") {

                $nome = $_POST['nome'];
                $sexo = $_POST['sexo'];
                $email = $_POST['email'];
                $telefone = $_POST['telefone'];
            }


            $cc = new ClientesController();
            unset($_POST['cadastrar']);
            $resp = $cc->inserirClientes(

                $nome,
                $telefone,
                $email,
                $senha,
                $sexo
            );
            if (getType($resp) == 'object') {
                $ce = $resp;
                echo "<p style='color: red;'>Email já cadastrado!</p>";
            } 
            else {
                echo $resp;
                echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"2;
                URL='login.php'\">";
                
            }
        }
        ?>

        <form method="post" action="">
            <div class="detalhes-usuario">
                <div class="input-box">

                    <?php
                    if ($ce != null) {
                        echo $ce->getId();
                    ?>

                        <input type="hidden" name="idclientes" value="<?php echo $ce->getId() ?>">
                    <?php
                    }
                    ?>
                    <span>Nome Completo</span>
                    <input type="text" placeholder="Digite seu nome" name="nome" required value="<?php echo $ce->getNome(); ?>">
                </div>

                <div class="input-box">
                    <span class="detalhes">Telefone Celular </span>
                    <input id="tel" type="tel" placeholder="(xx)9xxxx-xxxx" name="telefone" maxlength="11" required value="<?php echo $ce->getTelefone(); ?>">
                </div>

                <div class="input-box">
                    <span class="detalhes">Email</span>
                    <input type="email" placeholder="Digite seu email" name="email" required value="<?php echo $ce->getEmail(); ?>">
                </div>

                <div class="input-box">
                    <span class="detalhes">Senha</span>
                    <input type="password" placeholder="Digite sua senha" name="senha" id="senha" maxlength="11" required value="<?php echo $ce->getSenha(); ?>">

                </div>

                <span class="p-viewer2">
                    <i class="fas fa-eye" aria-hidden="true" id="olho" style="color: #000000;" onclick="toggle()"></i>
                    <i class="fas fa-eye-slash" id="risco" onclick="toggle()"></i>
                </span>

            </div>

            <div class="genero">
                <input type="radio" name="sexo" id="ponto-1" value="Masculino" value="<?php echo $ce->getSexo(); ?>" 
                <?php if ($ce->getSexo() != null) { if ($ce->getSexo() == "Masculino") echo "checked = checked";}?> checked='checked' required>

                <input type="radio" name="sexo" id="ponto-2" value="Feminino" value="<?php echo $ce->getSexo(); ?>" 
                <?php if ($ce->getSexo() != null) {if ($ce->getSexo() == "Feminino") echo "checked = checked";} ?>required>

                <span class="seu-genero">Gênero</span>
                <div class="categoria">
                    <label for="ponto-1">
                        <span class="ponto um"></span>
                        <span class="generoMas">Masculino</span>
                    </label>
                    <label for="ponto-2" name="sexo" value="Feminino">
                        <span class="ponto dois"></span>
                        <span class="generoMas" value="Feminino">Feminino</span>
                    </label>
                </div>
            </div>

            <button type="submit" class="btn efeito-btn" name="cadastrar">Cadastrar</button>
            <div class="input-boxlogar">
                <p>Já possui login?</p><a href="index.php">Logar</a>

            </div>
        </form>
    </div>

    <script>
        var senha = document.querySelector('#senha');

        senha.addEventListener('blur', (eventoLegal) => {
            verificaSenha(eventoLegal.target);
        })

        function verificaSenha(input) {
            var expSenha = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[$*&@#!"'%¨¬()+=§])[0-9a-zA-Z$*&@#!"'%¨¬()+=§]{8,}$/g;
            var senhaValida = expSenha.exec(input.value);
            var msgSenha = '';

            if (!senhaValida) {
                msgSenha = 'Precisa ter pelo menos 1 letra minúscula, maiúscula, número e caracter especial e ao menos 8 caracteres (!@#$&?*).';
            }

            input.setCustomValidity(msgSenha);

        }
    </script>

    <script>
        var telefone = document.querySelector('#tel');

        telefone.addEventListener('blur', (evento) => {
            verificaTelefone(evento.target);
        })

        var expTel = /(^\(?[0]?[1-9]{2}\)?)[.-\s]?([9]?[\s]?[1-9]\d{3})[.-\s]?(\d{4})$/g;

        function verificaTelefone(elemento) {
            var telValido = expTel.exec(elemento.value);
            var msgTel = '';

            if (!telValido) {
                msgTel = 'Insira um número de telefone válido com DDD e o 9';
            }

            elemento.setCustomValidity(msgTel);
            elemento.value = unificaTel(elemento.value);
        }

        function unificaTel(numero) {
            var telNum = numero.replace(/[().-\s]/g, ''); //limpa
            var telFormatado = telNum.replace(expTel,
                function(valorTel, ddd, prefixo, numero) {
                    var numeroFinal = '(' + ddd + ') ' + prefixo + '-' + numero;
                    return numeroFinal;
                })
            return telFormatado;
        }
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
    <!--<a class="whatsapp-link" href="https://web.whatsapp.com/send?phone=559891355162" target="_blank">
        <i class="fa fa-whatsapp"></i>
    </a>-->

</body>

</html>
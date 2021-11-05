<?php



include_once 'C:/xampp/htdocs/Projeto-barbearia/login.php';
//Variáveis
/*
 * Como enviar emails do localhost com o Sendmail no Xampp usando o Gmail
 * https://www.carloshdebrito.com.br/como-enviar-emails-do-localhost-com-o-sendmail-no-xampp-usando-o-gmail/
 */
$email = $_POST['recuperaremail'];

date_default_timezone_set('America/Sao_Paulo');
$data_envio = date('d/m/y');
$hora_envio = date('H:i:s');

$corpoemail = " 
<!DOCTYPE html>
<html lang=\"pt-br\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
</head>
    <style>
    body {
        background-color: black;
        margin: 0;
        color: white;
        text-align: center;
    }

    h1 {
        color: black;
        padding-top: 25px;
        text-align: center;
    }

    .imagem {
        width: 200px;
        padding-right: 5px;
        padding-left: 6px;
        padding-bottom: 5px;
    }

    div {
        background-color: white;
        width: 550px;
        height: 550px;
        text-align: center;
        border-radius: 10%;
        margin-left: auto;
        margin-right: auto;
    }

    .filhadiv {
        padding-top: 10px;
        background-color: white;
        width: 400px;
        height: auto;
        text-align: center;
    }

    a {
        text-decoration: none;
        color: #8686;
    }

    p {
        color: black;
        font-family: 'Lobster', cursive;
        font-size: x-large;
        font-weight: auto;
        padding-top: 20px;
    }
    </style>
    <body>
        <div>
            <h1>Recuperar de senha</h1>
            <div class=\"filhadiv\">
                <p>Por favor, <a href=\"http://localhost/Projeto-barbearia/novasenha.php?email=$email\" target=\"_blank\">clique aqui</a> para resetar sua senha.</p>
                <p>Caso não tenha solicitado este email para resetar sua senha, por favor, entre em contato para resolver o problema.</p>
                <p>Este Email foi enviado dia: $data_envio às: $hora_envio</p>
            </div>
        </div>
    </body>
</html>";

/*$to_email = $email;
$subject = "Teste simples de envio de email via PHP";
$body = $arquivo;
$headers = "From: sender\'s email";
 
if (mail($to_email, $subject, $body, $headers)) {
    echo "Email enviado com sucesso para $to_email.";
} else {
    echo "Falha no envio do email.";
    header("Location: login.php"); exit();
}*/



//enviar
// emails para quem será enviado o formulário
$destino = $_POST['recuperaremail'];
$assunto = "Recuperação de senha.";

// É necessário indicar que o formato do e-mail é html
$headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
$headers .= 'From: <'.$email.'>';
//$headers .= "Bcc: $EmailPadrao\r\n";

$enviaremail = mail($destino, $assunto, $corpoemail, $headers);
if ($enviaremail) {
    $mgm = "<script>alert('E-MAIL ENVIADO COM SUCESSO! <br> O link para a redefinição será enviado para o "
            . "e-mail fornecido no seu cadastro')</script>";
    echo "$mgm";
} else {
    $mgm = "ERRO AO ENVIAR E-MAIL!";
    echo "$mgm";
}
header("Location: login.php"); exit();
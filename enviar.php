<?php



include_once 'C:/xampp/htdocs/Projeto-barbearia/login.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/mensagem.php';
//Variáveis
/*
 * Como enviar emails do localhost com o Sendmail no Xampp usando o Gmail
 * https://www.carloshdebrito.com.br/como-enviar-emails-do-localhost-com-o-sendmail-no-xampp-usando-o-gmail/
 */
$msg = new Mensagem();
$email = $_POST['recuperaremail'];

date_default_timezone_set('America/Sao_Paulo');
$data_envio = date('d/m/y');
$hora_envio = date('H:i:s');
$data_expirar = date('H:i:s', strtotime('4 hours'));

$corpoemail = " 
<!DOCTYPE html>
<html lang=\"pt-br\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
</head> 
    <body>
        <div>
            <h1>Recuperar de senha</h1>
            <div class=\"filhadiv\">
                <p>Por favor, <a href=\"http://localhost/Projeto-barbearia/novasenha.php?email=$email\" target=\"_blank\">clique aqui</a> para resetar sua senha.</p>
                <p>Caso não tenha solicitado este email para resetar sua senha, por favor, entre em contato para resolver o problema.</p>
                <p>Este Email foi enviado dia: $data_envio às: $hora_envio</p>
                <p>O link irá expirar em: 4 (quatro) horas</p>
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
    $msg->setMsg("<p style='color: blue;'>"
                    . "<script>alert('E-MAIL ENVIADO COM SUCESSO! <br> O link para a redefinição será enviado para o "
                    . "e-mail fornecido no seu cadastro')</script>");
                    echo $msg->getMsg();
    
} else {
    $msg->setMsg("<p style='color: blue;'>"
                    . "<script>alert('ERRO AO ENVIAR E-MAIL!')</script>");
                    echo $msg->getMsg();
    echo "$mgm";
}
header("Location: login.php"); exit();
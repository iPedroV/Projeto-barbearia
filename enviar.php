<?php
//Variáveis
/*
 * Como enviar emails do localhost com o Sendmail no Xampp usando o Gmail
 * https://www.carloshdebrito.com.br/como-enviar-emails-do-localhost-com-o-sendmail-no-xampp-usando-o-gmail/
 */
/*$email = $_POST['recuperaremail'];

date_default_timezone_set('America/Sao_Paulo');
$data_envio = date('d/m/y');
$hora_envio = date('H:i:s');*/

$to_email = 'fabioabreu71@gmail.com';
$subject = "Teste simples de envio de email via PHP";
$body = "Olá, este é um email de teste enviado por PHP Script";
$headers = "From: sender\'s email";
 
if (mail($to_email, $subject, $body, $headers)) {
    echo "Email enviado com sucesso para $to_email.";
} else {
    echo "Falha no envio do email.";
}

/*// Compo E-mail
$arquivo = "
  <style type='text/css'>
  body {
  margin:0px;
  font-family:Verdane;
  font-size:12px;
  color: #666666;
  }
  a{
  color: #666666;
  text-decoration: none;
  }
  a:hover {
  color: #FF0000;
  text-decoration: none;
  }
  .padLeft{
    padding-left: 7px;
  }
  </style>
    <html>
        <table width='510' border='1' cellpadding='5' cellspacing='0' bgcolor='#dce7f1'>
            <tr>
                <td width='320' class='padLeft'>E-mail: <b>$email</b></td>
            </tr>
            <tr>
                <td class='padLeft'>Este e-mail foi enviado em <b>$data_envio</b> às <b>$hora_envio</b></td>
            </tr>
        </table>
    </html>
  ";

//enviar
// emails para quem será enviado o formulário
$destino = $email;
$assunto = "Teste de envio de e-mail pelo site.";

// É necessário indicar que o formato do e-mail é html
$headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: '.$nome.'<'.$email.'>';
//$headers .= "Bcc: $EmailPadrao\r\n";

$enviaremail = mail($destino, $assunto, $arquivo, $headers);
if ($enviaremail) {
    $mgm = "<script>alert('E-MAIL ENVIADO COM SUCESSO! <br> O link será enviado para o "
            . "e-mail fornecido no formulário')</script>";
} else {
    $mgm = "ERRO AO ENVIAR E-MAIL!";
    echo "$mgm";
}
header("Location: index.php"); exit();*/
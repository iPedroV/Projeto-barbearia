<?php
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/mensagem.php';

/*
 * Como enviar emails do localhost com o Sendmail no Xampp usando o Gmail
 * https://www.carloshdebrito.com.br/como-enviar-emails-do-localhost-com-o-sendmail-no-xampp-usando-o-gmail/
 */

class Enviar
{
    public function EnviarEmail()
    {
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
        //enviar
        // emails para quem será enviado o formulário
        $destino = $_POST['recuperaremail'];
        $assunto = "Recuperação de senha.";

        // É necessário indicar que o formato do e-mail é html
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $headers .= 'From: <' . $email . '>';
        //$headers .= "Bcc: $EmailPadrao\r\n";

        //$enviaremail = mail($destino, $assunto, $corpoemail, $headers);
        if (mail($destino, $assunto, $corpoemail, $headers)) {
            //echo "<script>alert('Email enviado com sucesso')</script>";
            $mensagem = "<script>Swal.fire({
                icon: 'success',
                title: 'Email enviado',
                text: 'Link para redefinição enviado para email cadastrado',
                })</script>";
            echo $msg->setMsg($mensagem);
        } else {
            $mensagem2 = "<script>Swal.fire({
            icon: 'error',
            title: 'Erro ao enviar',
            text: 'Emeil não encontrado',
            timer: 3000
            })</script>";
            echo $msg->setMsg($mensagem2);
            //echo "<script>alert('Email não encontrado')</script>";
        }
        return $msg;
        header("Location: login.php");
    }

    public function EnviarEmailSenha()
    {
        $msg = new Mensagem();
        $nome = $_POST['nome'];
        $tel = $_POST['telefone'];
        $cargo = $_POST['cargo'];
        $email = $_POST['email'];
        $senha = $_POST['telefone'];

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
            <body>
                <div>
                    <h1>Dados cadastrais</h1>
                    <div class=\"filhadiv\">
                        <p>Cadastrado com sucesso no Salão e barbearia neves</p>
                        <p>Seus dados casdastrais são:</p>
                        <p>Nome completo: $nome</p>
                        <p>Telefone celular: $tel</p>
                        <p>Cargo de: $cargo</p>
                        <p>Senha de acesso ao sistema: $senha</p>
                        <p>Lembrando que é sugerido que altere sua senha de acesso.</p>
                        <p>Este Email foi enviado dia: $data_envio às: $hora_envio</p>
                    </div>
                </div>
            </body>
        </html>";
        //enviar
        // emails para quem será enviado o formulário
        $destino = $_POST['email'];
        $assunto = "Cadastro no sistema";

        // É necessário indicar que o formato do e-mail é html
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $headers .= 'From: <' . $email . '>';
        //$headers .= "Bcc: $EmailPadrao\r\n";

        //$enviaremail = mail($destino, $assunto, $corpoemail, $headers);
        if (mail($destino, $assunto, $corpoemail, $headers)) {
            //echo "<script>alert('Email enviado com sucesso')</script>";
            $mensagem = "<script>Swal.fire({
                icon: 'success',
                title: 'Dados cadastrais',
                text: 'Dados do novo funcionario enviado para o $email com sucesso',
                timer: 3000
                })</script>";
            echo $msg->setMsg($mensagem);
        }
        return $msg;
        header("Location: ListarFuncionario.php");
    }
}

<?php
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/mensagem.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/controller/funcionarioController.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/Usuario.php';


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
        $data_agora = date('His', strtotime('now'));
        date_default_timezone_set('America/Sao_Paulo');
        $dia = date('dmy', strtotime('+1 day'));
        $dia2 = intval($dia);
        $data = date('His', strtotime('+4 hours')); // Samuel, coloque aqui "+4 hours" aonde está escrito "+1 minutes"
        $data2 = intval($data);

        $corpoemail = " 
        <!DOCTYPE html>
        <html lang=\"pt-br\">
        <head>
            <meta charset=\"UTF-8\">
            <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
        </head> 
            <body style=\"background: white;
                        background-position: center;
                        background-size: 100%;
                        margin: 0;\">
                <div style=\"width: 250px;
                            height: 350px;
                            margin-top: 25px;
                            align-items: center;
                            border-radius: 5%;
                            background: linear-gradient(90deg, rgb(218, 218, 218) 40%, rgb(172, 167, 167) 80%);
                            text-align: center;
                            color: rgb(0, 0, 0);
                            box-shadow: 1px 1px 2px 6px rgba(85, 82, 82, 0.533);
                            padding: 0px 10px;\">
                    <h1 style=\"padding-top: 10px;
                                font-size: 1.7rem; font-family: Brush Script MT, Brush Script Std, cursive;
                                font-weight: 100\">Recuperação de senha</h1>
                    <p style=\"font-size: 1.0rem;
                                font-family: cursive;
                                font-style: italic;\">Por favor, <a
                            href=\"http://localhost/Projeto-barbearia/novasenha.php?email=$email&hora=$data2&dia=$dia2\"
                            target=\"_blank\">clique aqui</a> para resetar sua senha.</p>
                    <p style=\"font-size: 1.0rem;
                                font-family: cursive;
                                font-style: italic;\">Caso não tenha solicitado este email 
                                                        para resetar sua senha, por favor, 
                                                        entre em contato para resolver o problema.</p>
                    <p style=\"font-size: 0.7rem;
                                font-family: cursive;
                                font-style: italic;\">Este Email foi enviado dia: $data_envio às: $hora_envio</p>
                    <p style=\"font-size: 0.7rem;
                                font-family: cursive;
                                font-style: italic;\">O link irá expirar em: 4 (quatro) horas</p>
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
            text: 'Email não encontrado',
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
        /*$ems = new FuncionarioController();
        $token = $ems->tokenenviar();
        $token->getToken();*/
        
        $msg = new Mensagem();
        $nome = $_POST['nome'];
        $telefone = str_replace("(","", $_POST['telefone']);
        $telefone = str_replace(")","", $telefone);
        $telefone = str_replace(" ","", $telefone);
        $telefone = str_replace("-","", $telefone);
        $cargo = $_POST['cargo'];
        $email = $_POST['email'];
        $token = $_POST['token'];
    
        $senha = $telefone;
        
        

        date_default_timezone_set('America/Sao_Paulo');
        $data_envio = date('d/m/y');
        $hora_envio = date('H:i:s');
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
                        <p>Telefone celular: $telefone</p>
                        <p>Cargo de: $cargo</p>
                        <p>Senha de acesso ao sistema: $senha</p>
                        <p>Código verificador primeiro acesso: $token</p>.
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


    public function EnviarEmailContato()
    {
        $msg = new Mensagem();
        $email = $_POST['contatoEmail'];
        $textoContato = $_POST['contatoTexto'];
        $remetente = $_POST['contaoNome'];

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
                    <h1>Email de contato</h1>
                    <div class=\"filhadiv\">
                        <p>$remetente</p>
                        <p>$textoContato</p>
                        <p>Agradecemos seu contato, orbigrado por ter entrado em comtato conosco.</p>
                        <p>Este Email foi enviado dia: $data_envio às: $hora_envio</p>
                        <p>O email do responsavel $email</p>
                    </div>
                </div>
            </body>
        </html>";
        //enviar
        // emails para quem será enviado o formulário
        $destino = "testetestadotestando51@gmail.com";
        $assunto = "Email de contato.";

        // É necessário indicar que o formato do e-mail é html
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $headers .= 'From: <' . $destino . '>';
        
        //$headers .= "Bcc: $EmailPadrao\r\n";

        //$enviaremail = mail($destino, $assunto, $corpoemail, $headers);
        if (mail($destino, $assunto, $corpoemail, $headers)) {
            //echo "<script>alert('Email enviado com sucesso')</script>";
            $mensagem = "<script>Swal.fire({
                icon: 'success',
                title: 'Email enviado',
                text: 'Obrigrado por entrar em contato conosco!!',
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
        }
        return $msg;
        header("Location: login.php");
    }
}
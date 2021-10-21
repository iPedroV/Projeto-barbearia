<?php 
ob_start();
session_start();

if((!isset($_SESSION['emailc']) || !isset($_SESSION['nomec'])) 
    || !isset($_SESSION['nr']) || 
    ($_SESSION['nr'] != $_SESSION['conferenr'])) { 
    header("Location: sessionDestroy.php");
    exit;
}

$data = $_SESSION['dataAgendamento'];

// Chamando o id da associativa de servicos para poder usar para inserir
$servico = null;
$servico2 = null;

$valor = $_SESSION['agendamentoServicoValor'];
$horario = $_SESSION['horarioAgendamento'];

include_once 'C:/xampp/htdocs/testProjeto/controller/agendamentoController.php';
include_once 'C:/xampp/htdocs/testProjeto/dao/daoAgendamento.php';
include_once 'C:/xampp/htdocs/testProjeto/model/agendamento_model.php';

$dt = new Agendamento();
$dts = new AgendamentoController();

include_once 'C:/xampp/htdocs/testProjeto/bd/banco.php';
include_once 'C:/xampp/htdocs/testProjeto/model/mensagem.php';

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width. initial-scale=1.0">
    <title>💈 Barbearia Neves 💈</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/Estilo_Calend.css">
    <link rel="stylesheet" href="/css/Style-Agend.css">

    <!-- CSS only -->
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="sorcut icon" href="./img/LogoGuia.png" type="image/png" style="width: 16px; height: 16px;">

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

    <!-- SweetAlert -->
    <script src="Js/sweetalert2.all.min.js"></script>

    <!-- JavaScript Para Funções da Página -->

    <script>
        function mascara(t, mask) {
            var i = t.value.length;
            var saida = mask.substring(1, 0);
            var texto = mask.substring(i)

            if (texto.substring(0, 1) != saida) {
                t.value += texto.substring(0, 1);
            }
        }
    </script>

    <Style>
        form.cadastro label {
            font-weight: border;
            font-size: 20px;
        }
    </Style>

<body style="border: 2px solid #000000; background-color: #333;">
    <header>
        <a href="./agendamentoFormulario2.php" class="logo">&#8656; Voltar<span>.</span></a>
    </header>

    <?php

    if (isset($_POST['cancelar'])) {
        header("Location: index.php");
    }

    if (isset($_POST['enviar'])) {
        $dataA = $_POST['data_agendamento'];
            $horario = $_POST['dataInicio'];
            $dataA = $_POST['data_agendamento'];
            $dataA2 = $_POST['data_agendamento'];
            $idUsuario = $_SESSION['idc'];
            $formaPagamento = $_POST['formaPagamento'];

            $servico = $_SESSION['servico'];
            $funcionario = $_SESSION['funcionario'];
            
            echo " <p style='color: white;'>- idUsuário: $idUsuario </p>";
            echo " <p style='color: white;'>- forma de pagamento: $formaPagamento </p>";
            echo " <p style='color: white;'>-: $dataA, $horario <br><br>-: servico 01 :==> $servico, $funcionario </p>";
            
			$valorTotal = $_SESSION['agendamentoServicoValor'];
            echo " <p style='color: white;'>- valor Total a pagar: $valorTotal </p>";

            $funcionario2 = $_SESSION['funcionario2'];
            if($funcionario2 != null){
                $funcionario2 = $_SESSION['funcionario2'];
                $servico2 = $_SESSION['servico2'];
                echo " <p style='color: white;'>-: servico 02 :==>  $servico2, $funcionario2 </p>";
            }
            $status = "agendado";
            $confirmar = "confirmado";

                $dts = new AgendamentoController();
                unset($_POST['enviar']);
                $msg = $dts->inserirAgendamento($horario, $dataA, $formaPagamento, $status, $dataA2, $confirmar, $valorTotal, $idUsuario);

                echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"0;
                        URL='http://localhost/testProjeto/agendamento_ClienteDados.php'\">";
    }

    ?>

    <form method="POST" action="" class="agendamento" id="agendamento" style="background-color: #333;">
        <div class="card-body" style="background-color: #333;">
            <div class="card-header tituloAgend">
                Dados Gerais para confirmação do agendamento
            </div><br>
                <div id="modar3">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="row formulario">
                            <!-- Lado esquerdo do Formulário 2prt -->
                            <div class="col-md-6 p-4">
                                <div class="campoForm2">
                                    <label for="nome">Nome/Usuário: </label><br>
                                    <input type="text" id="nome" name="nome" value="<?php echo $_SESSION['nomec'];?>" disabled><br>
                                
                                    <label for="email">E-mail: </label><br>
                                    <input type="text" id="email" name="email" value="<?php echo $_SESSION['emailc'];?>" disabled><br>
                                
                                    <label for="email">Forma de Pagamento </label><br>
                                    <select id="formaPagamento" name="formaPagamento" >
                                        <option>Dinheiro</option>
                                    </select><br>
                                </div>
                            </div>

                            <!-- Lado direito do Formulário 2prt -->

                            <div class="col-md-6 p-4" style="margin-top: -35px;">
                                <div class="campoForm2">
                                    <div class="barreira2"></div>
                                    <Label>Data de Agendamento:</Label><br>
                                    <input type="date" name="data_agendamento" value="<?php echo $data ?>">
                                
                                    <Label>Início do Serviço:</Label><br>
                                    <input type="time" name="dataInicio" value="<?php echo $horario;?>">
                                
                                    <Label>Valor Total a pagar:</Label><br>
                                    <!--<input type="text" name="valorTotal" class="valorTotal" id="valorTotal" value="">-->
                                    <select id="valorTotal" name="valorTotal" disabled style="color: black;">
                                        <option><?php echo "R$ ".$valor.",00";?></option>
                                    </select><br>
                                </div>

                            </div>
                            <div class="footer" style="background-color: #fff;">
                                <button type="submit" class="btn efeito-btn" name="enviar" id="enviar"> Confirmar Agendamento </button>
                                <button type="submit" class="btn btn-secondary" name="cancelar">Cancelar Agendamento</button>
                            </div>
                        </div>
                    </div>
                </div>
    </form>

    <link rel="stylesheet" href="./css/Style-Agend.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="Js/bootstrap.min.js"></script>
    <script type="text/javascript" charset="utf-8">
    </script>
    <script src="Js/Agendamento.js"></script>
    <script src="Js/testProjeto.js"></script>
</body>
</head>

</html>
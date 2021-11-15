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
$tempo01 = $_SESSION['agendamentoServicoTempo'];
$nome01 = $_SESSION['nome_Servico'];

include_once 'C:/xampp/htdocs/Projeto-barbearia/controller/agendamentoController.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/dao/daoAgendamento.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/agendamento_model.php';

$dt = new Agendamento();
$dts = new AgendamentoController();

include_once 'C:/xampp/htdocs/Projeto-barbearia/bd/banco.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/mensagem.php';

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

<body style="border-top: 2px solid #000000; background-color: #333;">
    <header>
        <a href="./agendamentoFormulario.php" class="logo">&#8656; Voltar<span>.</span></a>
    </header>

    <form method="POST" action="" class="agendamento2" id="agendamento2" style="background-color: #333;">
        <div class="card-body" style="background-color: #333;">
            <div class="card-header tituloAgend">
                Dados Gerais para confirmação do agendamento
            </div><br>
                <div id="modar3">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="row formulario2">
                            <!-- Lado esquerdo do Formulário 2prt -->
                            <div class="col-md-6 p-4">
                                <div class="campoForm2">
                                    <label for="nome">Nome/Usuário: </label><br>
                                    <input type="text" id="nome" name="nome" value="<?php echo $_SESSION['nomec'];?>" disabled><br>
                                
                                    <br><label for="email">E-mail: </label><br>
                                    <input type="text" id="email" name="email" value="<?php echo $_SESSION['emailc'];?>" disabled><br>
                                    <br>
                                </div>
                            </div>

                            <!-- Lado direito do Formulário 2prt -->

                            <div class="col-md-6 p-4" style="margin-top: -35px;">
                                <div class="campoForm4">
                                    <div class="barreira2"></div>
                                    <Label>Data de Agendamento:</Label><br>
                                    <input type="date" name="data_agendamento" value="<?php echo $data ?>">
                                
                                    <br><br><Label>Horário do Serviço:</Label><br>
                                    <input type="time" name="" value="<?php echo $horario;?>" disabled>
                                    <br>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="campoForm3">
                                    <Label style="margin-bottom: 10px;">Dados do Serviço:</Label><br>
                                    <div class="col-10" style="background-color: white; height: 2px; margin-top: -8px; margin-bottom: 8px;"></div>
                                    
                                    <input type="text" name="nomeServico" value="<?php echo $nome01;?>" disabled><br>

                                    <input type="text" value="<?php $tempo01; 
                                        if($tempo01 == "00:05:00"){
                                            echo "05 min";
                                        } elseif ($tempo01 == "00:10:00"){
                                            echo "10 min";
                                        } elseif ($tempo01 == "00:15:00"){
                                            echo "15 min";
                                        } elseif ($tempo01 == "00:20:00"){
                                            echo "20 min";
                                        } elseif ($tempo01 == "00:25:00"){
                                            echo "25 min";
                                        } elseif ($tempo01 == "00:30:00"){
                                            echo "30 min";
                                        } elseif ($tempo01 == "00:35:00"){
                                            echo "35 min";
                                        } elseif ($tempo01 == "00:40:00"){
                                            echo "40 min";
                                        } elseif ($tempo01 == "00:45:00"){
                                            echo "45 min";
                                        } elseif ($tempo01 == "00:50:00"){
                                            echo "50 min";
                                        } elseif ($tempo01 == "00:55:00"){
                                            echo "55 min";
                                        } elseif ($tempo01 == "01:00:00"){
                                            echo "1h (uma) hora";
                                        } elseif ($tempo01 == "01:05:00"){
                                            echo "1h 05min";
                                        } elseif ($tempo01 == "01:10:00"){
                                            echo "1h 10min";
                                        } elseif ($tempo01 == "01:15:00"){
                                            echo "1h 15min";
                                        } elseif ($tempo01 == "01:20:00"){
                                            echo "1h 20min";
                                        } elseif ($tempo01 == "01:25:00"){
                                            echo "1h 25min";
                                        } elseif ($tempo01 == "01:30:00"){
                                            echo "1h 30min";
                                        } elseif ($tempo01 == "01:35:00"){
                                            echo "1h 35min";
                                        } elseif ($tempo01 == "01:40:00"){
                                            echo "1h 40min";
                                        } elseif ($tempo01 == "01:45:00"){
                                            echo "1h 45min";
                                        } elseif ($tempo01 == "01:50:00"){
                                            echo "1h 50min";
                                        } elseif ($tempo01 == "01:55:00"){
                                            echo "1h 55min";
                                        } elseif ($tempo01 == "02:00:00"){
                                            echo "2h (duas) horas";
                                        }
                                        ?>" disabled><br>
                                        
                                    <input type="text" name="valorTotal" value="<?php echo "R$ ".$valor.",00";?>" disabled>
                                    <!--<select id="valorTotal" name="valorTotal" disabled style="color: black;">
                                        <option></option>
                                    </select>--><br>

                                    <div class="col-10" style="background-color: white; height: 2px; margin-top: -5px;"></div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="campoForm3">
                                    <label for="email">Forma de Pagamento </label><br>
                                        <select id="formaPagamento" name="formaPagamento" >
                                            <option>Dinheiro</option>
                                        </select><br>
                                    
                                    <br>
                                    <ul name="id_servicos" id="MostarDados" class="form-control" style="height: 40px; background-color: transparent;" >
                                
                                        <?php
                                        $funcionario = $_SESSION['funcionario'];
                                        $result_post = "SELECT * FROM `usuario` " 
                                            ."WHERE id = " . $funcionario . " LIMIT 1";
                                        $resultado_post = mysqli_query($conn, $result_post);
                                        while ($row_post = mysqli_fetch_assoc($resultado_post)) {
                                            echo '<li style="list-style: none; color: white; font-size: 18px;" 
                                                value="' . $row_post['id'] . '"><strong>Funcionario: </strong>' . $row_post['nome'] . '</li>';
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>

                            <div class="footer" style="background-color: #fff; margin-top: -100px;">
                                <button type="submit" class="btn efeito-btn" name="enviar" id="enviar"> Confirmar agendamento</button>
                                <button type="submit" class="btn btn-secondary" name="cancelar">Cancelar agendamento</button>
                            </div>
                        </div>
                    </div>
                </div>
    </form>
    <?php

    if (isset($_POST['cancelar'])) {
        header("Location: index.php");
    }

    if (isset($_POST['enviar'])) {
        if($_SESSION['dataAgendamento'] != ""){
        $dataA = $_POST['data_agendamento'];
            $dataA = $_POST['data_agendamento'];
            $dataA2 = $_POST['data_agendamento'];
            $idUsuario = $_SESSION['idc'];
            $formaPagamento = $_POST['formaPagamento'];

            $servico = $_SESSION['servico'];
            $funcionario = $_SESSION['funcionario'];
            
            //echo " <p style='color: white;'>- idUsuário: $idUsuario </p>";
            // echo " <p style='color: white;'>- forma de pagamento: $formaPagamento </p>";
            //echo " <p style='color: white;'>-: $dataA, $horario <br><br>-: servico 01 :==> $servico, $nome01, $funcionario </p>";
            
			$valorTotal = $_SESSION['agendamentoServicoValor'];
            //echo " <p style='color: white;'>- valor Total a pagar: $valorTotal </p>";
            $funcionario2 = "";
            $funcionario2 = $_SESSION['funcionario2'];
            if($funcionario2 != ""){
                $funcionario2 = $_SESSION['funcionario2'];
                $servico2 = $_SESSION['servico2'];
                //echo " <p style='color: white;'>-: servico 02 :==> $servico2, $funcionario2 </p>";
            }
            $status = "agendado";
            $confirmar = "confirmado";

                $dts = new AgendamentoController();
                unset($_POST['enviar']);
                $msg = $dts->inserirAgendamento($horario, $dataA, $formaPagamento, $status, $dataA2, $confirmar, 
                        $valorTotal, $idUsuario, $funcionario, $servico);

                $_SESSION['dataAgendamento'] = "";
                ?>
                    <script>
                        Swal.fire({
                            title: 'Agendamento realizado!',
                            text: '',
                            icon: 'success',
                            confirmButtonColor: '#000',
                            confirmButtonText: 'Agendamento Realizado'
                        })
                    </script>
                <?php

                echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"2;
                        URL='http://localhost/Projeto-barbearia/agendamento_ClienteDados.php'\">";
        } else {

            echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"0;
                        URL='http://localhost/Projeto-barbearia/agendamento_ClienteDados.php'\">";
        }
    }

    ?>
    <link rel="stylesheet" href="./css/Style-Agend.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="Js/bootstrap.min.js"></script>
    <script type="text/javascript" charset="utf-8">
    </script>
    <script src="Js/Agendamento.js"></script>
    <script src="Js/Projeto-barbearia.js"></script>
</body>
</head>

</html>
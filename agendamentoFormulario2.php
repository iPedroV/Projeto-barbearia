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
$dataForm = $_SESSION['dataAgendamentoFormatado'];
$nomeFuncionario = $_SESSION['nomeFuncionarioFormulario'];

// Chamando o id da associativa de servicos para poder usar para inserir
$servico = null;
$servico2 = null;


include_once 'C:/xampp/htdocs/Projeto-barbearia/controller/agendamentoController.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/dao/daoAgendamento.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/agendamento_model.php';

$dt = new Agendamento();
$dts = new AgendamentoController();

include_once 'C:/xampp/htdocs/Projeto-barbearia/bd/banco.php';

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
        <a href="./agendamentoFormulario.php" class="logo">&#8656; Voltar<span>.</span></a>
    </header>

    <?php

    if (isset($_POST['voltar'])) {
        header("Location: agendamentoFormulario.php");
    }

    if (isset($_POST['enviar'])) {
        
        $horario = $_POST['horario_agendamento'];
        $_SESSION['horarioAgendamento'] = $horario;

        echo "<p style='color: #fff;'>--> Horário: " . $horario . "</p>";
        
        header("Location: agendamentoFormulario3.php");
                  
    }

    ?>

    <form method="POST" action="" class="agendamento" id="agendamento" style="background-color: #333;">
        <div class="card-body" style="background-color: #333;">
            <div class="card-header tituloAgend">
                Escolher horário para Realizar o serviço
            </div><br>
                <div id="modar3">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="row formulario">
                            <!-- Lado esquerdo do Formulário 2prt -->
                            <div class="col-md-12 offset-2">
                                <div class="campoFormData">
                                    <div class="barreira"></div>
                                    <Label>Data de Agendamento:</Label><br>
                                    <input type="text" name="data_agendamento" value="<?php echo $dataForm ?>"><br>
                                </div>
                            </div>

                            <div class="col-md-12 offset-12" style="border-bottom: 2px solid white; margin-bottom: -15px;"></div>
                            <div class="col-md-12 offset-12">
                                <div class="campoFormHorario">
                                    <label>Realizador do Serviço &nbsp;&#8658;</label>
                                    <input type="text" name="data_agendamento" value="<?php echo $nomeFuncionario ?>" disabled>
                                </div>
                            </div>
                            <div class="col-md-12 offset-12" style="border-bottom: 2px solid white; margin-bottom: -15px;"></div>

                            <div class="col-md-6 p-4" style="align-items: center; text-align: center;">
                                <button name="horarioAgend" id="btnHorario" onclick="horario()" type="button" class="btn btn-outline-secondary" style="margin-bottom: 10px; margin-top: 20px;"><span style="color: white;">08:00</span></button>
                                <button name="horarioAgend" id="btnHorario2" onclick="horario2()" type="button" class="btn btn-outline-secondary" style="margin-bottom: 10px;"><span style="color: white;">08:45</span></button>
                                <button name="horarioAgend" id="btnHorario3" onclick="horario3()" type="button" class="btn btn-outline-secondary" style="margin-bottom: 10px;"><span style="color: white;">09:30</span></button>
                                <button name="horarioAgend" id="btnHorario4" onclick="horario4()" type="button" class="btn btn-outline-secondary" style="margin-bottom: 10px;"><span style="color: white;">10:15</span></button>
                                <button name="horarioAgend" id="btnHorario5" onclick="horario5()" type="button" class="btn btn-outline-secondary" style="margin-bottom: 10px;"><span style="color: white;">11:00</span></button>
                                <label class="almoco">Horário de Almoço: <br><span>12h ás 14h</span></label> 
                            </div>

                            <!-- DIVISÃO DE SERVIÇOS --> 
                            
                            <div class="col-md-6 p-4" style="align-items: center; text-align: center;">
                                <button name="horarioAgend" id="btnHorario6" onclick="horario6()" type="button" class="btn btn-outline-secondary" style="margin-bottom: 10px; margin-top: 20px;"><span style="color: white;">14:00</span></button>
                                <button name="horarioAgend" id="btnHorario7" onclick="horario7()" type="button" class="btn btn-outline-secondary" style="margin-bottom: 10px;"><span style="color: white;">14:45</span></button>
                                <button name="horarioAgend" id="btnHorario8" onclick="horario8()" type="button" class="btn btn-outline-secondary" style="margin-bottom: 10px;"><span style="color: white;">15:30</span></button>
                                <button name="horarioAgend" id="btnHorario9" onclick="horario9()" type="button" class="btn btn-outline-secondary" style="margin-bottom: 10px;"><span style="color: white;">16:15</span></button>
                                <button name="horarioAgend" id="btnHorario10" onclick="horario10()" type="button" class="btn btn-outline-secondary" style="margin-bottom: 10px;"><span style="color: white;">17:00</span></button>
                                <button name="horarioAgend" id="btnHorario11" onclick="horario11()" type="button" class="btn btn-outline-secondary" style="margin-bottom: 10px;"><span style="color: white;">17:45</span></button>
                            </div>

                            <div class="col-md-12 offset-12" style="border-bottom: 2px solid white; margin-bottom: 15px; margin-top: 0px;"></div>
                            <div class="col-md-12 offset-12">
                                <div class="campoFormHorario2">
                                    <label>Horáio Escolhido &nbsp;&#8658;</label>
                                    <input type="time" name="horario_agendamento" id="horarioEscolhido" value="" >
                                </div>
                            </div>
                            <div class="col-md-12 offset-12" style="border-bottom: 2px solid white; margin-bottom: 30px; margin-top: -15px;"></div>
                            <div class="footer" style="background-color: #fff;">
                                <button type="submit" class="btn btn-secondary" name="voltar">&#8666; Voltar</button>
                                <button type="submit" class="btn efeito-btn" name="enviar" id="enviar">Avançar &#8667;</button>
                            </div>
                        </div>
                    </div>
                </div>
    </form>

    <link rel="stylesheet" href="./css/Style-Agend.css">
	<script src="Js/bootstrap.min.js"></script>

	<script>
        function horario(){
            var horario = '08:00';
            document.getElementById('horarioEscolhido').value = horario;
        }
        function horario2(){
            var horario = '08:45';
            document.getElementById('horarioEscolhido').value = horario;
        }
        function horario3(){
            var horario = '09:30';
            document.getElementById('horarioEscolhido').value = horario;
        }
        function horario4(){
            var horario = '10:15';
            document.getElementById('horarioEscolhido').value = horario;
        }
        function horario5(){
            var horario = '11:00';
            document.getElementById('horarioEscolhido').value = horario;
        }
        function horario6(){
            var horario = '14:00';
            document.getElementById('horarioEscolhido').value = horario;
        }
        function horario7(){
            var horario = '14:45';
            document.getElementById('horarioEscolhido').value = horario;
        }
        function horario8(){
            var horario = '15:30';
            document.getElementById('horarioEscolhido').value = horario;
        }
        function horario9(){
            var horario = '16:15';
            document.getElementById('horarioEscolhido').value = horario;
        }
        function horario10(){
            var horario = '17:00';
            document.getElementById('horarioEscolhido').value = horario;
        }
        function horario11(){
            var horario = '17:45';
            document.getElementById('horarioEscolhido').value = horario;
        }
    </script>

    <script src="Js/Agendamento.js"></script>
    <script src="Js/Projeto-barbearia.js"></script>
</body>
</head>

</html>
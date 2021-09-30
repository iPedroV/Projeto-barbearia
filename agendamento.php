<?php
    ob_start();
    session_start();

if((!isset($_SESSION['emailc']) || !isset($_SESSION['nomec'])) 
    || !isset($_SESSION['nr']) || 
    ($_SESSION['nr'] != $_SESSION['conferenr'])) { 
    header("Location: sessionDestroy.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width. initial-scale=1.0">
    <title>💈 Barbearia Neves 💈</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/Estilo_Calend.css">
    <link rel="stylesheet" href="./css/Style-Agend.css">

    <!-- CSS only -->
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="sorcut icon" href="./img/LogoGuia.png" type="image/png" style="width: 16px; height: 16px;">

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj"
        crossorigin="anonymous"></script>

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

<body>
    <header>
        <a href="./index.html" class="logo">Barbearia Neves<span>.</span></a>
        <div class="menuToggle" onclick=" toggleMenu();"></div>
        <ul class="navigation">
            <li><a href="#banner" onclick=" toggleMenu();">Home</a></li>
            <li><a href="#about" onclick=" toggleMenu();">Sobre</a></li>
            <li><a href="#menu" onclick=" toggleMenu();">Cortes</a></li>
            <li><a href="#salao" onclick=" toggleMenu();">Salão</a></li>
            <li><a href="#feedbacks" onclick=" toggleMenu();">Feedbacks</a></li>
            <li><a href="#contato" onclick=" toggleMenu();">Contato</a></li>
        </ul>
    </header>

    <div class="pcs" style="background-color: #333; position: relative; width: 100%; height: 200px;"></div>
    <section class="agenda" id="agenda">
        <div class="nome_agendamento" style="color: #fff; font-size: 25px; position: relative; left: 16%; width: 400px;">
        <strong>Olá, <?php echo $_SESSION['nomec']; ?></strong></div>

        <h2 class="titleText"><span>A</span>gendamento</h2>
        <div class="PainelAG">
            <div class="conteudo">
                <div class="calendario">
                    <div>
                    <div class="calendar disable-selection" id="calendar">
                        <div class="left-side">
                            <div class="current-day text-center">
                                <div class="calendar-left-side-month"></div>
                                <h1 class="calendar-left-side-day"></h1>
                                <div class="calendar-left-side-day-of-week"></div>
                            </div>
                            <div class="current-day-events">
                                <div>Pesquisar status do Clinte:</div>
                                <ul class="current-day-events-list" style="color: transparent;"></ul>
                                <a href="agendamento_ClienteDados.php"><input type="submit" class="agendamento" value="Agendamentos Realizados"></a>
                            </div>
                            <div class="add-event-day">
                                <span type="" class="add-event-day-field" placeholder=""></span>
                                <form method="POST" action="">
                                    <input type="text" name="data_agendamento" id="dataAgendamento" class="campoData" value="">
                                    <input type="submit" name="enviar" class="add-event-day-field-btn" id="Modalagenda" value="Agende Aqui!">
                                </form>
                                </div>
                        </div>
                        <div class="right-side">
                            <div class="text-right calendar-change-year">
                                <div class="calendar-change-year-slider">
                                    <span
                                        class="fa fa-caret-left cursor-pointer calendar-change-year-slider-prev"></span>
                                    <span class="calendar-current-year"></span>
                                    <span
                                        class="fa fa-caret-right cursor-pointer calendar-change-year-slider-next"></span>
                                </div>
                            </div>
                            <div class="calendar-month-list">
                                <ul class="calendar-month"></ul>
                            </div>
                            <div class="calendar-week-list">
                                <ul class="calendar-week"></ul>
                            </div>
                            <div class="calendar-day-list">
                                <ul class="calendar-days"></ul>
                            </div>
                        </div>
                    </div>

                    <!-- Modal para Cadstrar -->
                    <link rel="stylesheet" href="./css/Style-Agend.css">
                    <script src="Js/Agendamento.js"></script>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="botaoCancelar">
        <a href="index.html" class="CancelarAgendamento"><span>C</span>ancelar agendamento</a>
    </div>
    
    <?php

    $defaultTimeZone = 'UTC';
    if (date_default_timezone_get() != $defaultTimeZone) date_default_timezone_set($defaultTimeZone);

    function _dateAtual($format = "r", $timestamp = false, $timezone = false)
    {
        $userTimezone = new DateTimeZone(!empty($timezone) ? $timezone : 'GMT');
        $gmtTimezone = new DateTimeZone('GMT');
        $myDateTime = new DateTime(($timestamp != false ? date("r", (int)$timestamp) : date("r")), $gmtTimezone);
        $offset = $userTimezone->getOffset($myDateTime);
        return date($format, ($timestamp != false ? (int)$timestamp : $myDateTime->format('U')) + $offset);
    }
    $dateEscolhida = _dateAtual("Y-m-j", false, 'America/Sao_Paulo');

        if(isset($_POST['enviar'])) {
            $data = $_POST['data_agendamento'];
            if ($data < $dateEscolhida) {
                ?>
                    <script>
                        Swal.fire({
                            title: 'Cadastro não realizado!',
                            text: 'O dia escolhido não pode ser agendado antes do dia atual (<?php echo $dateEscolhida ?>)!',
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        })
                    </script>
                <?php    
            }else{
                $_SESSION['dataAgendamento'] = $_POST['data_agendamento'];
                echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"0;
                    URL='http://localhost/Projeto-barbearia/agendamentoFormulario.php'\">";
            }
        }
    ?>

    <div class="copyrightText">
        <p>Copyright 2021 <a href="#">Senac</a>. Todos os Direitos Reservados</p>
    </div>

    <a class="whatsapp-link" href="https://web.whatsapp.com/send?phone=559891355162" target="_blank">
        <i class="fa fa-whatsapp"></i>
    </a>

    <script src="Js/Calendario.js"></script>
</body>
</head>

</html>
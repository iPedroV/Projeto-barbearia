<?php
    ob_start();
    session_start();

if((!isset($_SESSION['emailc']) || !isset($_SESSION['nomec'])) 
    || !isset($_SESSION['nr']) || 
    ($_SESSION['nr'] != $_SESSION['conferenr'])) { 
        header("Location: agendamento.php");
    exit;
}

$id = $_SESSION['idc'];
$nomeUser = $_SESSION['nomec'];

$_SESSION['funcionario2'] = "";
$_SESSION['servico2'] = "";
$_SESSION['nome_Servico2'] = "";
$_SESSION['agendamentoServicoTempo2'] = "";
$_SESSION['agendamentoServicoValor'] = "";
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

    <!-- SweetAlert -->
    <script src="Js/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">

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
        <a href="./index.php" class="logo">Barbearia Neves<span>.</span></a>
        <div class="menuToggle" onclick=" toggleMenu();"></div>
        <ul class="navigation">
            <li><a href="index.php" onclick=" toggleMenu();">Home</a></li>
        <div class="dados">
        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                aria-expanded="false" style="padding: 0px; margin: 0px;">
                <span class="account-user-avatar"> 
                    <img src="img/user.png" alt="user-image" class="rounded-circle" width="45px" height="45px" style="background-color: white; border: 1px solid #fff;">
                </span>
                <span>
                    <span class="account-user-name"><?php echo $_SESSION['nomec']; ?></span>
                    <span class="account-position"><?php echo $_SESSION['perfilc']; ?></span>
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown" style="height: 135px;">
                <!-- item-->
                <div class=" dropdown-header noti-title">
                    <h6 class="text-overflow m-0">Bem-Vindo !</h6>
                </div>

                <!-- item-->
                <a href="index.php" class="dropdown-item notify-item">
                    <i class="mdi mdi-account-circle me-1"></i>
                    <span>Minha Página</span>
                </a>

                <div class="dropdown-divider"></div>

                <!-- item-->
                <div class="SairDiv">
                  <a href="sessionDestroy.php" class="SairLogin">
                    <i class="mdi mdi-lock-outline me-1"></i> 
                    <span>Sair &#8608;</span>
                  </a>
                </div>

            </div>
        </li>
        </div>
        </ul>
          
    </header>

    <div class="pcs" style="background-color: #333; position: relative; height: 200px;"></div>
    <section class="agenda" id="agenda">
        <h2 class="titleText"><span>A</span>gendamento</h2>
        <div class="PainelAG">
            <div class="conteudo">
                <label>Por favor, escolha o dia que deseja realizar o agendamento &#9660;</label>
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
                                <div>Pesquisar agendamento:</div>
                                <ul class="current-day-events-list" style="color: transparent;"></ul>
                                <a href="agendamento_ClienteDados.php"><input type="submit" class="agendamento" value="Verificar Agendamento"></a>
                            </div>
                            <div class="add-event-day">
                                <span type="" class="add-event-day-field" placeholder=""></span>
                                <form method="POST" action="">
                                    <input type="text" name="data_agendamento" id="dataAgendamento" class="campoData" value="">
                                    <input type="text" name="data_agendamentoFormatado" id="dataAgendamentoFormatado" class="campoData" value="">
                                    <input type="text" name="final_semana" id="final_semana" class="campoData" value="">
                                    <?php 
                                        if ($_SESSION['perfilc'] == "Cliente") {
                                            ?>
                                            <input type="submit" name="enviar" class="add-event-day-field-btn" id="Modalagenda" value="Agende Aqui!">
                                            <?php
                                        } else if($_SESSION['perfilc'] == "Funcionario" || $_SESSION['perfilc'] == "Administrador") {
                                            
                                        }
                                        ?>
                                    
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
                            <h4>Meses</h4>
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
        <a href="index.php" class="CancelarAgendamento"><span>C</span>ancelar agendamento</a>
    </div>
    
    <?php
    require_once __DIR__ . "/bd/banco.php";

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
    $dateEscolhida = _dateAtual("Y-m-d", false, 'America/Sao_Paulo');

        if(isset($_POST['enviar'])) {
            $data = $_POST['data_agendamento'];
            $dataFinalSemana = $_POST['final_semana'];

            $result_usuario = "select * from agendamentos inner join usuario "
                . "on agendamentos.usuario_id = usuario.id where usuario.id = ". $id;
            $resultado_usuario = mysqli_query($conn, $result_usuario);

            while($row_usuario = mysqli_fetch_assoc($resultado_usuario)){
                $row_usuario['idAgendamento'];
                $row_usuario['usuario_id'];

                $user = 0;
                $user = $row_usuario['idAgendamento'];

            }    
        
            if ($data < $dateEscolhida) {
                function vemData($qqdata){
                    $tempdata=substr($qqdata,8,2).'/'.
                        substr($qqdata,5,2).'/'.
                        substr($qqdata,0,4);
                    return($tempdata);
                }
                ?>
                    <script>
                        Swal.fire({
                            title: 'Agende o seu serviço apartir de hoje!',
                            text: 'O dia escolhido não pode ser agendado antes do dia atual (<?php echo vemData($dateEscolhida) ?>)! Agende o serviço a partir de hoje.',
                            icon: 'error',
                            confirmButtonText: '<a href="">Voltar_Calendário</a>'
                        })
                    </script>
                <?php    
            } else if($user != 0) {
                ?>
                    <script>
                        Swal.fire({
                            icon: 'warning',
                            title: 'O cliente já possui um agendamento em andamento!',
                            text: 'Para saber mais detalhes clique no botão "Verificar Agendamento".',
                            showCancelButton: true,
                            confirmButtonText: '<a href="./agendamento_ClienteDados.php">Verificar Agendamento</a>'  
                        })
                    </script>
                    <a href="./"></a>
                <?php
                $data = null;
            } else if ($dataFinalSemana == "Domingo") {
                ?>
                    <script>
                        Swal.fire({
                            title: 'Não efetuamos serviços em dia de Domingo!',
                            text: 'Por favor, escolha outro dia para agendar.',
                            icon: 'error',
                            confirmButtonText: '<a href="">Voltar_Calendário</a>'
                        })
                    </script>
                <?php   
            } else if($data != null && $user == 0) {
                $_SESSION['dataAgendamento'] = $_POST['data_agendamento'];
                $_SESSION['dataAgendamentoFormatado'] = $_POST['data_agendamentoFormatado'];
                echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"0;
                   URL='http://localhost/Projeto-barbearia/agendamentoFormulario.php'\">";

                /*
                Teste já realizado nas dastas normal e formatada!

                $data = $_SESSION['dataAgendamento'];
                echo "".$data;

                $dataF = $_SESSION['dataAgendamentoFormatado'];
                echo "<br> Teste ".$dataF;
                */
            }
        }
    ?>

    <div class="copyrightText">
        <p>Copyright 2021 <a href="#">Senac</a>. Todos os Direitos Reservados</p>
    </div>

    <a class="whatsapp-link" href="https://web.whatsapp.com/send?phone=559891355162" target="_blank">
        <i class="fa fa-whatsapp"></i>
    </a>

    <script src="./Js/Calendario.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"
        integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT"
        crossorigin="anonymous"></script>

    <script type="text/javascript">
        window.addEventListener('scroll', function() {
            const header = document.querySelector('header');
            header.classList.toggle("sticky", window.scrollY > 0);
        });

        function toggleMenu() {
            const menuToggle = document.querySelector('.menuToggle');
            const navigation = document.querySelector('.navigation');
            menuToggle.classList.toggle('active');
            navigation.classList.toggle('active');
        }
    </script>
</body>
</head>

</html>
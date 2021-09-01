<?php
include_once 'C:/xampp/htdocs/Projeto-barbearia/controller/agendamentoController.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/dao/daoAgendamento.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/agendamento_model.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/mensagem.php';

$msg = new Mensagem();
$dt = new Agendamento();
$dts = new AgendamentoController();
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
    <link rel="stylesheet" href="./CSS/bootstrap.css">
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

    <?php
        $defaultTimeZone='UTC';
        if(date_default_timezone_get()!=$defaultTimeZone) date_default_timezone_set($defaultTimeZone);

        function _dateAtual($format="r", $timestamp=false, $timezone=false) {
            $userTimezone = new DateTimeZone(!empty($timezone) ? $timezone : 'GMT');
            $gmtTimezone = new DateTimeZone('GMT');
            $myDateTime = new DateTime(($timestamp!=false?date("r",(int)$timestamp):date("r")), $gmtTimezone);
            $offset = $userTimezone->getOffset($myDateTime);
            return date($format, ($timestamp!=false?(int)$timestamp:$myDateTime->format('U')) + $offset);
        }
        $dateEscolhida = _dateAtual("Y-m-d", false, 'America/Sao_Paulo');
        
        if (isset($_POST['enviar'])) {
            $dataA = $_POST['data_agendamento'];
            if ($dataA < $dateEscolhida) {
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
            } else {
                $horario = $_POST['escolherHorario'];
                if ($horario != "") {  
                    $dataA = $_POST['data_agendamento'];
                    $dts = new AgendamentoController();
                    unset($_POST['enviar']);
                    $msg = $dts->inserirDataAgendamento($dataA, $horario);
                    echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"0;
                        URL='http://localhost/Calendario/agendamento.php'\">";
                }
            } 
        }
    ?>

    <div style="background-color: #333; position: relative; width: 100%; height: 100px;"></div>
    <section class="agenda" id="agenda">
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
                                <ul class="current-day-events-list"></ul>
                            </div>
                            <div class="add-event-day">
                                <span type="" class="add-event-day-field" placeholder=""></span>
                                <button type="button" class="fa cursor-pointer add-event-day-field-btn" id="Modalagenda"
                                    data-bs-toggle="modal" data-bs-target="#exampleModal">Agende Aqui!</button>
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

                    <div class="modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true" style="margin-bottom: 10px;">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header cabecalhoModal">
                                    <h3 class="modal-title" id="exampleModalLabel">Agendamento Cliente</h3>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body" style="background-color: rgb(255, 255, 255);">
                                    <form method="post" action="" class="agendamento" id="agendamento">
                                        <div class="card-body" style="border: 2px solid #000000;">
                                            <div class="card-header tituloAgend">
                                                Escolha o serviço desejado
                                            </div><br>

                                            <div class="col-12 " style="margin-bottom: 25px;">
                                                <div class="card-header text-start text-dark"
                                                    style="background-color: rgb(255, 255, 255);">

                                                    <div class="row" style="background-color: rgb(255, 255, 255);">
                                                        <div class="col-md-3">
                                                            <img width="100%" height="180" src="img/corteMasculino.jpg"
                                                                style="border: 1px solid black;">
                                                            <div>
                                                                <label style="padding: 5px; font-size: 18px;"><strong>Corte
                                                                        Masculino</strong></label>
                                                                <label class="cliqueAqui"
                                                                    style="color: black; position: relative; font-size: 14px; margin-left: 5px;">
                                                                    Clique aqui.&#9660;</label>
                                                                <select name="cor" class="form-control">
                                                                    <option>[--Nenhum Serviço--]</option>
                                                                    <option name="cor">Serviço(1)</option>
                                                                    <option name="cor">Serviço(2)</option>
                                                                    <option name="cor">Serviço(3)</option>
                                                                    <option name="cor">Serviço(4)</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <img width="100%" height="180"
                                                                src="img/como-aparar-a-barba-02.jpg"
                                                                style="border: 1px solid black;">
                                                            <div>
                                                                <label style="padding: 5px; font-size: 18px;"><strong>Barba
                                                                        Masculino</strong></label>
                                                                <label class="cliqueAqui"
                                                                    style="color: black; position: relative; font-size: 14px; margin-left: 5px;">
                                                                    Clique aqui.&#9660;</label>
                                                                <select name="Perfil" class="form-control">
                                                                    <option>[--Nenhum Serviço--]</option>
                                                                    <option name="cor">Serviço(1)</option>
                                                                    <option name="cor">Serviço(2)</option>
                                                                    <option name="cor">Serviço(3)</option>
                                                                    <option name="cor">Serviço(4)</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <img width="100%" height="180" src="img/corteFeminino.jpg"
                                                                style="border: 1px solid black;">
                                                            <div>
                                                                <label style="padding: 5px; font-size: 18px;"><strong>Cabelo
                                                                        Feminino</strong></label>
                                                                <label class="cliqueAqui"
                                                                    style="color: black; position: relative; font-size: 14px; margin-left: 5px;">
                                                                    Clique aqui.&#9660;</label>
                                                                <select name="Perfil" class="form-control">
                                                                    <option>[--Nenhum Serviço--]</option>
                                                                    <option name="cor">Serviço(1)</option>
                                                                    <option name="cor">Serviço(2)</option>
                                                                    <option name="cor">Serviço(3)</option>
                                                                    <option name="cor">Serviço(4)</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <img width="100%" height="180"
                                                                src="img/manicure-de-sucesso.jpg"
                                                                style="border: 1px solid black;">
                                                            <div>
                                                                <label style="padding: 5px; font-size: 18px;"><strong>Manicure
                                                                        Feminino</strong></label>
                                                                <label class="cliqueAqui"
                                                                    style="color: black; position: relative; font-size: 14px; margin-left: 5px;">
                                                                    Clique aqui.&#9660;</label>
                                                                <select name="Perfil" class="form-control">
                                                                    <option>[--Nenhum Serviço--]</option>
                                                                    <option name="cor">Serviço(1)</option>
                                                                    <option name="cor">Serviço(2)</option>
                                                                    <option name="cor">Serviço(3)</option>
                                                                    <option name="cor">Serviço(4)</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div>
                                                <Label>Parte 2 FORM</Label>
                                                <br><br>
                                            </div>

                                            <div class="row formulario">
                                                <!-- Lado esquerdo do Formulário 2prt -->
                                                <div class="col-md-6 p-4">
                                                    <div class="campoForm2">
                                                        <label for="nome">Nome/Usuário: </label><br>
                                                        <input type="text" id="nome" name="nome" value="testeNome"
                                                            disabled><br>
                                                    </div>
                                                    <div class="campoForm2">
                                                        <label for="telefone">Telefone: </label><br>
                                                        <input type="text" id="telefone" name="telefone"
                                                            value="testTelefone" disabled><br>
                                                    </div>
                                                    <div class="campoForm2">
                                                        <label for="email">E-mail: </label><br>
                                                        <input type="text" id="email" name="email"
                                                            value="testeEmail20@gmail.com" disabled><br>
                                                    </div>
                                                </div>

                                                <!-- Lado direito do Formulário 2prt -->
                                                
                                                <div class="col-md-6 p-4">
                                                    <div class="campoForm2">
                                                        <div class="barreira"></div>
                                                        <Label>Data de Agendamento:</Label><br>
                                                        <input type="text" name="data_agendamento" id="dateAgend" value="" >
                                                    </div>

                                                    <div class="campoForm2">
                                                        <Label>Tipo de serviço:</Label><br>
                                                        <input type="text" name="servico" id="servico"
                                                            value="Corte Masculino" disabled>
                                                    </div>

                                                    <div class="campoForm2">
                                                        <Label>Serviço Escolhido:</Label><br>
                                                        <input type="text" name="servico" id="servico"
                                                            value="Serviço(4)" disabled>
                                                    </div>
                                                    <div class="campoForm2">
                                                        <Label>Serviço Escolhido:</Label><br>
                                                        <div class="row">
                                                            <div class="col-md-10">
                                                                <select name="escolherHorario" class="form-control" required>
                                                                    <option>[--Nenhum Serviço--]</option>
                                                                    <option name="cor">08:30</option>
                                                                    <option name="cor">09:15</option>
                                                                    <option name="cor">10:45</option>
                                                                    <option name="cor">11:10</option>
                                                                    <option name="cor">11:40</option>
                                                                    <option name="cor">14:00</option>
                                                                    <option name="cor">14:20</option>
                                                                    <option name="cor">15:00</option>
                                                                    <option name="cor">15:30</option>
                                                                    <option name="cor">16:15</option>
                                                                    <option name="cor">16:50</option>
                                                                    <option name="cor">17:30</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="footer" style="background-color: #fff;">
                                                    <button type="submit" class="btn efeito-btn" name="enviar"
                                                        id="enviar">Fazer agendamento</button>
                                                    <button type="reset" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancelar</button>
                                                </div>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

    </section>


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
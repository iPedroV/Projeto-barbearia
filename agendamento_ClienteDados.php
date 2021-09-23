<?php
include_once 'C:/xampp/htdocs/Calendario/controller/agendamentoController.php';
include_once 'C:/xampp/htdocs/Calendario/dao/daoAgendamento.php';
include_once 'C:/xampp/htdocs/Calendario/model/agendamento_model.php';

$dt = new Agendamento();
$dts = new AgendamentoController();

include_once 'C:/xampp/htdocs/Calendario/model/mensagem.php';
$msg = new Mensagem();

include_once 'C:/xampp/htdocs/Calendario/controller/servicos_has_funcionariosController.php';
include_once 'C:/xampp/htdocs/Calendario/model/servicos_has_funcionarios.php';
$sev = new Servicos_has_funcionarios();


$s_has_f = new Servicos_has_funcionariosController();

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width. initial-scale=1.0">
    <title>💈 Barbearia Neves 💈</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/agendamento_ClienteStyle.css">

    <!-- CSS only -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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

</body>
</head>

</html>
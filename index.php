<?php


ob_start();
session_start();

if ((!isset($_SESSION['emailc']) || !isset($_SESSION['nomec']))
    || !isset($_SESSION['nr']) ||
    ($_SESSION['nr'] != $_SESSION['conferenr'])
) {
    header("Location: sessionDestroy.php");
    exit;
}

include_once 'C:/xampp/htdocs/Projeto-barbearia/controller/ClientesController.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/Usuario.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/mensagem.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/bd/banco.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/enviar.php';

$ce = new Usuario();
$msg = new Mensagem();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width. initial-scale=1.0">
    <title>💈 Barbearia Neves 💈</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style-index.css">

<body>

    <?php
    //Também faz parte da validação de login
    if (isset($_SESSION['msg'])) {
        if ($_SESSION['msg'] != "") {
            echo $_SESSION['msg'];
            echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"2;
                                URL='./index.php'\">";
            $_SESSION['msg'] = "";
        }
    }

    ?>

    <header>
        <a href="#" class="logo">Barbearia Neves<span>.</span></a>
        <a href="feedNoticias.php" class="dropdown-toggle" data-toggle="dropdown"><span class="label label-pill label-danger count" style="border-radius:10px;"></span> <span class="glyphicon glyphicon-bell" style="font-size:18px; color:aliceblue"></span></a>
                    <ul class="dropdown-menu" style="top: 65%; left: 400px;"></ul>
        <div class="menuToggle" onclick=" toggleMenu();"></div>
        <?php
        include_once 'C:/xampp/htdocs/Projeto-barbearia/nav.php';
        echo navBar();
        ?>

    </header>
    <section class="banner" id="banner">
        <div class="content">
            <h2>Bem-vindo</h2>
            <?php


            ?>
            <p class="nome"><strong>Olá, <?php echo $_SESSION['nomec']; ?></strong></p>


            <a href="feedNoticias.php" class="btn">Feed de notícias</a><br>
            <a href="agendamento.php" class="btn">Fazer Agendamento</a>

        </div>
    </section>

    <section class="about" id="about">
        <div class="row">
            <div class="col150">
                <h2 class="titleText"><span>S</span>obre Nós</h2>
                <p style="text-align: justify; padding-right: 20px;">A mais de 17 anos no mercado da beleza, a Barbearia
                    Neves está sempre atenta as novidades para cuidar
                    melhor da beleza de seus clientes. Gildoes, mais
                    conhecido por todos como Gildo, além de ser um
                    excelente profissional, é muito carismático com seus
                    clientes!</p>
            </div>
            <div class="col150">
                <div class="imgBx">
                    <img src="img/img_barbearia_neves/gildo1.jpg">
                </div>
            </div>
        </div>
    </section>

    <section class="menu" id="menu">
        <div class="title">
            <h2 class="titleText"><span>C</span>ortes</h2>
            <p>Tipos de cortes</p>
        </div>
        <div class="content">
            <div class="box">
                <div class="imgBx">
                    <img src="img/img_barbearia_neves/cliente2.jpg">
                </div>
                <div class="text">
                    <h3>Barbas</h3>
                </div>
            </div>

            <div class="box">
                <div class="imgBx">
                    <img src="img/img_barbearia_neves/cliente3.jpg">
                </div>
                <div class="text">
                    <h3>Cortes na Máquina e Tesoura</h3>
                </div>
            </div>

            <div class="box">
                <div class="imgBx">
                    <img src="img/img_barbearia_neves/cliente4.jpg">
                </div>
                <div class="text">
                    <h3>Cortes para festas</h3>
                </div>
            </div>

            <div class="box">
                <div class="imgBx">
                    <img src="img/img_barbearia_neves/cliente5.jpg">
                </div>
                <div class="text">
                    <h3>Alisamentos</h3>
                </div>
            </div>

            <div class="box">
                <div class="imgBx">
                    <img src="img/img_barbearia_neves/cliente1.jpg">
                </div>
                <div class="text">
                    <h3>Cortes especiais</h3>
                </div>
            </div>

            <div class="box">
                <div class="imgBx">
                    <img src="img/corte6.jpg">
                </div>
                <div class="text">
                    <h3>Cortes do momento</h3>
                </div>
            </div>
        </div>
        <div class="title">
            <a href="#" class="btn">Ver todos</a>
        </div>
    </section>

    <section class="salao" id="salao">
        <div class="title">
            <h2 class="titleText"><span>N</span>osso Salão</h2>
            <p> Espaço </p>
            <div class="content">
                <div class="box">
                    <div class="imgBx">
                        <img src="img/img_barbearia_neves/salao1.jpg">
                    </div>
                    <div class="text">
                        <h3>"Muito conforto!" - Fábio</h3>
                    </div>
                </div>

                <div class="box">
                    <div class="imgBx">
                        <img src="img/img_barbearia_neves/salao3.jpg">
                    </div>
                    <div class="text">
                        <h3>"Bem espaçoso!" - Pedro</h3>
                    </div>
                </div>

                <div class="box">
                    <div class="imgBx">
                        <img src="img/img_barbearia_neves/salao2.jpg">
                    </div>
                    <div class="text">
                        <h3>"Muito bonito!" - João</h3>
                    </div>
                </div>
            </div>
    </section>

    <section class="feedbacks" id="feedbacks">
        <div class="title white">
            <h2 class="titleText"><span>F</span>eedbacks</h2>
            <p> Avaliações sobre o atendimento </p>
        </div>
        <div>
            <div class="content">
                <div class="box">
                    <div class="imgBx">
                        <img src="img/img_barbearia_neves/cliente4.jpg">
                    </div>
                    <div class="text">
                        <p>"Corto com ele a mais de 15 anos!
                            Excelente profissional"</p>
                        <h3>Fábio</h3>
                    </div>
                </div>

                <div class="box">
                    <div class="imgBx">
                        <img src="img/img_barbearia_neves/cliente2.jpg">
                    </div>
                    <div class="text">
                        <p>"O melhor no que faz! Não tem nem como
                            cortar com outro... Muito bom!"</p>
                        <h3>Rafael</h3>
                    </div>
                </div>

                <div class="box">
                    <div class="imgBx">
                        <img src="img/img_barbearia_neves/cliente5.jpg">
                    </div>
                    <div class="text">
                        <p>"Não há outro barbeiro que consiga cortar
                            meu cabelo!"</p>
                        <h3>Hudson</h3>
                    </div>
                </div>
            </div>
    </section>

    <section class="contato" id="contato">
        <div class="title">
            <h2 class="titleText"><span>C</span>ontato</h2>
            <p>Entre em contato com a gente!</p>
            <script src="Js/sweetalert2.all.min.js"></script>
            <div class="contactForm">
                <?php
                if (isset($_POST['contatoEnviar'])) {
                    $msg = new Mensagem();
                    $EmailEnviado = new ClientesController();
                    $msg = $EmailEnviado->EnviarEmailControllerContato();
                    echo $msg->getMsg();
                    echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"2;
                    URL='index.php'\">";
                }
                ?>
                <form method="post">
                    <!-- <h3>Nos envie uma mensagem</h3> -->
                    <div class="inputBox">
                        <input type="text" placeholder="Nome" name="contatoNome">
                    </div>
                    <div class="inputBox">
                        <input type="email" placeholder="Email" name="contatoEmail">
                    </div>
                    <div class="inputBox">
                        <textarea placeholder="Digite aqui o que deseja" name="contatoTexto"></textarea>
                    </div>
                    <div class="inputBox">
                        <input type="submit" value="Enviar" name="contatoEnviar" id="contatoEnviar">
                    </div>
                </form>
            </div>
        </div>
    </section>


    <div class="copyrightText">
        <p>Copyright 2021 <a href="#">Senac</a>. Todos os Direitos Reservados</p>
    </div>

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
    <script>
        $(document).ready(function() {

            function load_unseen_notification(view = '') {
                $.ajax({
                    url: "fetch.php",
                    method: "POST",
                    data: {
                        view: view
                    },
                    dataType: "json",
                    success: function(data) {
                        $('.dropdown-menu').html(data.notification);
                        if (data.unseen_notification > 0) {
                            $('.count').html(data.unseen_notification);
                        }
                    }
                });
            }

            load_unseen_notification();

            $('#comment_form').on('submit', function(event) {
                event.preventDefault();
                if ($('#subject').val() != '' && $('#comment').val() != '') {
                    var form_data = $(this).serialize();
                    $.ajax({
                        url: "insert.php",
                        method: "POST",
                        data: form_data,
                        success: function(data) {
                            $('#comment_form')[0].reset();
                            load_unseen_notification();
                        }
                    });
                } else {
                    alert("Both Fields are Required");
                }
            });

            $(document).on('click', '.dropdown-toggle', function() {
                $('.count').html('');
                load_unseen_notification('yes');
            });

            setInterval(function() {
                load_unseen_notification();;
            }, 5000);

        });
    </script>

    <a class="whatsapp-link" href="https://web.whatsapp.com/send?phone=559891355162" target="_blank">
        <i class="fa fa-whatsapp"></i>




    </a>
</body>
</head>

</html>

<?php ob_end_flush(); ?>
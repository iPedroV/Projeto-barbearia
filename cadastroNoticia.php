<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['msg'])) {
    $_SESSION['msg'] = "";
}
include_once 'C:/xampp/htdocs/Projeto-barbearia/controller/indexController.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/mensagem.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/bd/banco.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/dao/DaoClientes.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/dao/daoIndex.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/Noticia.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/enviar.php';
$nt = new Noticia();
$msg = new Mensagem();
?>


<!DOCTYPE html>

<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cadastro Salão & Barbearia Neves</title>
    <link rel="stylesheet" href="./css/style-Funcionario.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font/awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">


    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .big-text {
            height: 45px;
            width: 100%;
            outline: none;
            border-radius: 5px;
            border: 1px solid #ccc;
            padding-left: 15px;
            font-size: 16px;
            border-bottom-width: 2px;
            transition: all 0.3s ease;
        }

        header {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            width: 100% !important;
            padding: 30px 42px !important;
            z-index: 10000 !important;
            display: flex !important;
            justify-content: space-between !important;
            align-items: center !important;
            transition: 0.5s !important;
        }

        @media (max-width: 704px) {
            header .navigation.active {
                width: 100%;
                height: 100%;
                position: fixed;
                top: 109px;
                left: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
                background: #fff;
            }
        }
    </style>
</head>

<body>

    <header>
        <a href="index.php" class="logo">Barbearia Neves<span>.</span></a>
        <div class="menuToggle" onclick=" toggleMenu();"></div>
        <?php
        include_once 'C:/xampp/htdocs/Projeto-barbearia/nav.php';
        echo navBar();
        ?>
    </header>

    <div class="container">
        <div class="title"><span><b>P</b></span>ublicar uma Notícia</div>

        <?php

        //Fução do Token*
        //substr((time()), 0, 20 )

        $conn = new Conecta();
        $msg = new Mensagem();
        $conecta = $conn->conectadb();
        if (isset($_POST['cadastrar'])) {


            

                $titulo = $_POST['titulo'];
                $descricao = $_POST['descricao'];
                $autor = $_POST['autor'];
                

            $ic = new indexController();
            unset($_POST['cadastrar']);
            $resp = $ic->inserirNoticia(
                /*precisa ta na MESMA ORDEM DO BANCO*/
                $titulo,
                $descricao,
                $autor
            );


            echo $resp;
            echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"2;
			    URL='../Projeto-Barbearia/feedNoticias.php'\">";
        }

        ?>

        <form method="post" action="">
            <div class="detalhes-usuario">
                <div class="input-box">
                    <?php
                    if ($nt != null) {
                        echo $nt->getId();
                    ?>

                        <input type="hidden" name="idclientes" value="<?php echo $nt->getId() ?>">
                    <?php
                    }
                    ?>
                    <span>Titulo</span>
                    <input type="text" placeholder="Digite o Título" name="titulo" required value="<?php echo $nt->getTitulo(); ?>">

                    <span class="detalhes">Autor</span>
                    <input type="text" placeholder="Digite o autor" name="autor" required value="<?php echo $nt->getAutor(); ?>">
                </div>


                <div class="input-box">
                    <span class="detalhes">Descrição</span>
                    <textarea id="descricao" type="text" placeholder="Digite a mensagem" name="descricao" required value="<?php echo $nt->getDescricao(); ?>"></textarea>
                </div>









            </div>

            <div>
                <button type="submit" class="btn efeito-btn" name="cadastrar">Cadastrar</button>
            </div>
        </form>
    </div>


    <script>
        var telefone = document.querySelector('#tel');

        telefone.addEventListener('blur', (evento) => {
            verificaTelefone(evento.target);
        })

        var expTel = /(^\(?[0]?[1-9]{2}\)?)[.-\s]?([9]?[\s]?[1-9]\d{3})[.-\s]?(\d{4})$/g;

        function verificaTelefone(elemento) {
            var telValido = expTel.exec(elemento.value);
            var msgTel = '';

            if (!telValido) {
                msgTel = 'Insira um número de telefone válido com DDD e o 9';
            }

            elemento.setCustomValidity(msgTel);
            elemento.value = unificaTel(elemento.value);
        }

        function unificaTel(numero) {
            var telNum = numero.replace(/[().-\s]/g, ''); //limpa
            var telFormatado = telNum.replace(expTel,
                function(valorTel, ddd, prefixo, numero) {
                    var numeroFinal = '(' + ddd + ') ' + prefixo + '-' + numero;
                    return numeroFinal;
                })
            return telFormatado;
        }
    </script>
    <script>
        function toggle() {
            var x = document.getElementById("senha");
            if (x.type === "password") {
                x.type = "text";
                document.getElementById("risco").style.display = "inline-block";
                document.getElementById("olho").style.display = 'none';
                document.getElementById("risco").style.color = '#000000';
                document.getElementById("olho").style.color = '#000000';
            } else {
                x.type = "password";
                document.getElementById("risco").style.display = 'none';
                document.getElementById("olho").style.display = 'inline-block';
                document.getElementById("risco").style.color = '#000000';
                document.getElementById("olho").style.color = '#000000';
            }
        }
    </script>
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

</html>
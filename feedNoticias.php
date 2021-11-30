<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['msg'])) {
    $_SESSION['msg'] = "";
}
//Tela principal para listar as informações que vem do feedData.php

$feed_url = "http://localhost/Projeto-barbearia/feedData.php";

$object = new DOMDocument();

$object->load($feed_url);

$content = $object->getElementsByTagName("item");


?>

<!DOCTYPE html>
<html>

<head>
    <title>Barbearia Neves</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
            scroll-behavior: smooth;
            border: none;
        }

        body {
            display: flex;
            height: 100%;
            justify-content: center;
            align-items: center;
            background-color: #888;
            background-image: url('../img/fundo-login.jpg');
            background-repeat: no-repeat;
            background-size: cover;
        }

        header {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            width: 100% !important;
            padding: 30px 100px !important;
            z-index: 10000 !important;
            display: flex !important;
            justify-content: space-between !important;
            align-items: center !important;
            transition: 0.5s !important;
        }

        header.sticky

        /* Não pode espaço!!!*/
            {
            background: #fff;
            padding: 10px 100px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        }

        header .logo {
            color: #fff;
            font-weight: 700;
            font-size: 2em;
            text-decoration: none;

        }

        header.sticky .logo

        /* Não pode espaço em "header.stick"!!!*/
            {
            color: #111;
        }

        header .logo span {
            color: #888;
        }

        header .navigation {
            position: relative;
            display: flex;
        }

        header .navigation li {
            list-style: none;
            /* Tira os pontinhos da lista ul */
            margin-left: 30px;
            /* Separa os itens da lista */
        }

        header .navigation li a {
            text-decoration: none;
            color: #fff;
            font-weight: 300;
            font-weight: bolder;
        }

        header.sticky .navigation li a {
            color: #111;
            font-weight: bolder;
        }

        header .navigation li a:hover {
            color: #888;
        }

        .container {

            width: 90%;
            height: 99%;
            font-size: 15px;
            margin-top: 80px!important;
            background-color: white;
            border-radius: 40px;
        }

        .menuToggle {
            visibility: hidden;
            position: relative;
            width: 40px;
            height: 40px;
            background: url(../img/menu.jpg);
            background-size: 30px;
            background-repeat: no-repeat;
            background-position: center;
            cursor: pointer;
        }

        .menuToggle.active {
            background: url(../img/menu-close.png);
            background-size: 25px;
            background-repeat: no-repeat;
            background-position: center;
        }

        header.sticky .menuToggle {
            filter: invert(1);
        }

        ::-webkit-scrollbar {
            width: 6px;
            background-color: #fffdfd;
        }

        ::-webkit-scrollbar-thumb {
            background-color: #050505;
        }

        @media (max-width: 768px) {
            .container {
                width: 750px !important;
                width: 90% !important;
                height: 99% !important;
                font-size: 50px !important;
            }

            h2 {
                font-size: 78px;
            }

            .h3,
            h3 {
                font-size: 67px;
            }

            header,
            header.sticky {
                padding: 10px 20px;
            }

            header .navigation {
                display: none;
            }

            header .navigation.active {
                width: 100%;
                height: 100%;
                position: fixed;
                top: 65px;
                left: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
                background: #fff;
            }

            header .navigation li {
                margin-left: 0
            }

            header .navigation li a {
                text-decoration: none;
                color: #111;
                font-size: 1.6em;
                font-weight: 300;
            }

            .menuToggle {
                visibility: visible;
                position: relative;
                width: 40px;
                height: 40px;
                background: url(../img/menu.jpg);
                background-size: 30px;
                background-repeat: no-repeat;
                background-position: center;
                cursor: pointer;
            }

            .menuToggle.active {
                background: url(../img/menu-close.png);
                background-size: 25px;
                background-repeat: no-repeat;
                background-position: center;
            }

            header.sticky .menuToggle {
                filter: invert(1);
            }
        }
    </style>
</head>

<body>
    <header>
        <a href="index.php" class="logo" style="padding-bottom: 5px;">Barbearia Neves<span>.</span></a>
        <div class="menuToggle" onclick=" toggleMenu();"></div>
        <?php
        include_once 'C:/xampp/htdocs/Projeto-barbearia/nav.php';
        echo navBar();
        ?>
    </header>
    <div class="container">
        <br />
        <h2 class="text-center">Feed de Notícias</h2>
        <br />
        <?php

        foreach ($content as $row) {
            echo '<h3 class="text-info">' . $row->getElementsByTagName("title")->item(0)->nodeValue . '</h3>';
            echo '<hr />';
            echo '
    <div class="row">
     <div class="col-md-3">
      <p>' . $row->getElementsByTagName("pubDate")->item(0)->nodeValue . '</p>
      <br />
      
     </div>
     <div class="col-md-12">
     <p>' . $row->getElementsByTagName("description")->item(0)->nodeValue . '</p>
      
     
      <p align="right"><b><i>Por: ' . $row->getElementsByTagNameNS("ns:1", "*")->item(0)->nodeValue . '</i></b></p>
     </div>
    </div>
    ';

            echo '<span class="label label-primary">' . $row->getElementsByTagName("category")->item(0)->nodeValue . '</span>';
            echo '<br />';
            echo '<hr />';
            echo '<br />';
        }

        ?>
    </div>
</body>
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

</html>
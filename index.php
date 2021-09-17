<?php
include_once 'C:/xampp/htdocs/Projeto-barbearia/controller/ClientesController.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/Clientes.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/mensagem.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/bd/banco.php';
$ce = new Clientes();
$msg = new Mensagem();
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width. initial-scale=1.0">
        <title>💈 Barbearia Neves 💈</title>
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/style-index.css">
        
        <body>
            <header>
                <a href="#" class="logo">Barbearia Neves<span>.</span></a>
                <div class="menuToggle" onclick=" toggleMenu();"></div>
                <ul class="navigation">
                    <li><a href="#banner"  onclick=" toggleMenu();">Home</a></li>
                    <li><a href="#about" onclick=" toggleMenu();">Sobre</a></li>
                    <li><a href="#menu" onclick=" toggleMenu();">Cortes</a></li>
                    <li><a href="#salao" onclick=" toggleMenu();">Salão</a></li>
                    <li><a href="#feedbacks" onclick=" toggleMenu();">Feedbacks</a></li>
                    <li><a href="#contato" onclick=" toggleMenu();">Contato</a></li>
                    <li><a href="#sair" onclick=" toggleMenu();">Contato</a></li>
                </ul>
            </header>
            <section class="banner" id="banner">
                <div class="content">
                    <h2>Bem-vindo</h2>
                    
                    <p>Pedro</p>
                    <a href="#" class="btn">Feed de notícias</a><br>
                    <a href="agendamento.php" class="btn">Fazer Agendamento</a>
                </div>
            </section>

            <section class="about" id="about">
                <div class="row">
                    <div class="col150">
                        <h2 class="titleText"><span>S</span>obre Nós</h2>
                        <p>A mais de 17 anos no mercado da beleza, a Barbearia
                            Neves está sempre atenta as novidades para cuidar
                            melhor da beleza de seus clientes. Gildoes, mais
                            conhecido por todos como Gildo, além de ser um
                            excelente profissional, é muito carismático com seus
                            clientes!</p>
                    </div>
                    <div class="col150">
                        <div class="imgBx">
                            <img src="/img/img_barbearia_neves/gildo1.jpg">
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
                            <img src="/img/img_barbearia_neves/cliente2.jpg">
                        </div>
                        <div class="text">
                            <h3>Cortes Especiais</h3>
                        </div>
                    </div>

                    <div class="box">
                        <div class="imgBx">
                            <img src="/img/img_barbearia_neves/cliente3.jpg">
                        </div>
                        <div class="text">
                            <h3>Cortes Básicos</h3>
                        </div>
                    </div>

                    <div class="box">
                        <div class="imgBx">
                            <img src="/img/img_barbearia_neves/cliente4.jpg">
                        </div>
                        <div class="text">
                            <h3>Cortes mais ou menos</h3>
                        </div>
                    </div>

                    <div class="box">
                        <div class="imgBx">
                            <img src="/img/img_barbearia_neves/cliente5.jpg">
                        </div>
                        <div class="text">
                            <h3>Cortes top</h3>
                        </div>
                    </div>

                    <div class="box">
                        <div class="imgBx">
                            <img src="/img/img_barbearia_neves/cliente1.jpg">
                        </div>
                        <div class="text">
                            <h3>Cortes Doidera</h3>
                        </div>
                    </div>

                    <div class="box">
                        <div class="imgBx">
                            <img src="/img/corte6.jpg">
                        </div>
                        <div class="text">
                            <h3>Cortes de Graça</h3>
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
                                <img src="/img/img_barbearia_neves/salao1.jpg">
                            </div>
                            <div class="text">
                                <h3>"Muito conforto!" - Fábio</h3>
                            </div>
                        </div>

                        <div class="box">
                            <div class="imgBx">
                                <img src="/img/img_barbearia_neves/salao3.jpg">
                            </div>
                            <div class="text">
                                <h3>"Bem espaçoso!" - Pedro</h3>
                            </div>
                        </div>

                        <div class="box">
                            <div class="imgBx">
                                <img src="/img/img_barbearia_neves/salao2.jpg">
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
                                    <img
                                        src="/img/img_barbearia_neves/cliente4.jpg">
                                </div>
                                <div class="text">
                                    <p>"Corto com ele a mais de 15 anos!
                                        Excelente profissional"</p>
                                    <h3>Fábio</h3>
                                </div>
                            </div>

                            <div class="box">
                                <div class="imgBx">
                                    <img
                                        src="/img/img_barbearia_neves/cliente2.jpg">
                                </div>
                                <div class="text">
                                    <p>"O melhor no que faz! Não tem nem como
                                        cortar com outro... Muito bom!"</p>
                                    <h3>Rafael</h3>
                                </div>
                            </div>

                            <div class="box">
                                <div class="imgBx">
                                    <img
                                        src="/img/img_barbearia_neves/cliente5.jpg">
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
                            <div class="contactForm">
                                <!-- <h3>Nos envie uma mensagem</h3> -->
                                <div class="inputBox">
                                    <input type="text" placeholder="Nome">
                                </div>
                                <div class="inputBox">
                                    <input type="email" placeholder="Email">
                                </div>
                                <div class="inputBox">
                                    <textarea placeholder="Digite aqui o que deseja"></textarea>
                                </div>
                                <div class="inputBox">
                                    <input type="submit" value="Enviar">
                                </div>
                            </div>
                        </div>
                    </section>


                    <div class="copyrightText">
                        <p>Copyright 2021 <a href="#">Senac</a>. Todos os Direitos Reservados</p>
                    </div>

                    <script type="text/javascript">
                        window.addEventListener('scroll', function(){
                            const header = document.querySelector('header');
                            header.classList.toggle("sticky", window.scrollY > 0);
                        });

                        function toggleMenu(){
                            const menuToggle = document.querySelector('.menuToggle');
                            const navigation = document.querySelector('.navigation');
                            menuToggle.classList.toggle('active');
                            navigation.classList.toggle('active');
                        }
                    </script>

                    <a class="whatsapp-link"
                        href="https://web.whatsapp.com/send?phone=559891355162"
                        target="_blank">
                        <i class="fa fa-whatsapp"></i>
                    </a>
                </body>
            </head>
        </html>
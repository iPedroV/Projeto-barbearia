<?php
ob_start();
session_start();

if((!isset($_SESSION['emailc']) || !isset($_SESSION['nomec'])) 
    || !isset($_SESSION['nr']) || 
    ($_SESSION['nr'] != $_SESSION['conferenr'])) { 
        header("Location: agendamento_ClienteDados.php");
    exit;
}
//header("Location: agendamento_ClientesDados.php");

include_once 'C:/xampp/htdocs/Projeto-barbearia/controller/agendamentoController.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/dao/daoAgendamento.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/agendamento_model.php';

$dt = new Agendamento();
$dts = new AgendamentoController();

include_once 'C:/xampp/htdocs/Projeto-barbearia/bd/banco.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/mensagem.php';

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
        <a href="./index.php" class="logo">Barbearia Neves<span>.</span></a>
        <div class="menuToggle" onclick=" toggleMenu();"></div>
        <ul class="navigation">
            <li><a href="index.php" onclick=" toggleMenu();">Home</a></li>
            <li><a href="agendamento.php" onclick=" toggleMenu();">Agendamento</a></li>

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


    <div class="page-header">
            <h1 style="margin-top: 15px; margin-bottom: 15px; margin-left: 15px;">Agendamento do <?php echo $_SESSION['nomec']; ?></h1>
        </div>
        
        <table class="table table-striped" style="border-radius: 3px; overflow:hidden;">
            <thead class="table-dark">
                <tr>
                    <th>Código</th>
                    <th>Horário</th>
                    <th>Data Agendada</th>
                    <th>Forma de Pagamento</th>
                    <th>Status</th>
                    <th>Data de Realização</th>
                    <th>Valor</th>
                    <th>Usuario</th>
                    <th>Nome Usuario</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                $TabelaVisual = new AgendamentoController();
                $listaAgendamento = $TabelaVisual->ListarClienteAgendamento();
                $a = 0;
                if ($listaAgendamento != null) {
                    foreach ($listaAgendamento as $la) {
                        $a++;
                ?>
                        <tr>
                            <td><?php print_r($la->getId()); ?></td>
                            <td><?php print_r($la->getHorario()); ?></td>
                            <td><?php print_r($la->getDataAgenda()); ?></td>
                            <td><?php print_r($la->getForma_Pagamento()); ?></td>
                            <td><?php print_r($la->getStatusAgendamento()); ?></td>
                            <td><?php print_r($la->getDateTime()); ?></td>
                            <td><?php print_r($la->getValor()); ?></td>
                            <td><?php print_r($la->getUsuarioID()->getId()); ?></td>
                            <td><?php print_r($la->getUsuarioID()->getNome()); ?></td>
                        </tr>

                    </tbody>
                    </table>
                    <div class="col-md-12 offset-12" style="background-color: #222; height: 30px;"></div>
                <?php
                    }
                } else {
                    ?> 
                    </tbody>
                    </table>
                        <div class="row" style="width: 99%;">
                            <div class="col-md-2 offset-2"></div>
                            <form method="POST" action="" class="agendamento" id="agendamento">
                                <label class="nenhumAgendamento">Nenhum agendamento foi realizado.</label>
                                <button type="submit" class="btn efeito-btn" name="fazerAgendamento" id="fazerAgendamento">&#8652; Fazer Agendamento &#8651;</button>
                            </form>
                        </div>

                        <div class="col-md-12 offset-12" style="background-color: #222; height: 30px;"></div>
                    <?php
                        if (isset($_POST['fazerAgendamento'])) {
                            header("Location: agendamento.php");
                        }
                    
                }
            ?>
</body>
</head>

</html>
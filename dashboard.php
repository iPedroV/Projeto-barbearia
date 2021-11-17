<?php
ob_start();
session_start();

if ((!isset($_SESSION['emailc']) || !isset($_SESSION['nomec']))
    || !isset($_SESSION['nr']) ||
    ($_SESSION['nr'] != $_SESSION['conferenr'])
) {
    header("Location: agendamento.php");
    exit;
}

$id = $_SESSION['idc'];
$nomeUser = $_SESSION['nomec'];
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8" />
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <title>💈 Barbearia Neves 💈</title>


    <!--Fontes-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!--CSS-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/style-dashboard.css" rel="stylesheet">
    <link href="css/Style-Agend.css" rel="stylesheet">


</head>

<body id="page-top">
    <header>
        <a href="./index.php" class="logo">Barbearia Neves<span>.</span></a>
        <div class="menuToggle" onclick=" toggleMenu();"></div>
        <ul class="navigation">
            <li><a href="index.php" onclick=" toggleMenu();">Home</a></li>


            <div class="dados">
                <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false" style="padding: 0px; margin: 0px;">
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

    <!-- Página -->
    <div id="wrapper">
        <!-- Conteúdo da Página -->
        <div id="content-wrapper" class="d-flex flex-column">
            <section class="mt-5">
                <!-- Dashboards -->
                <div id="content">
                    <!-- Começo -->
                    <div class="container-fluid">
                        <!-- Cartões -->
                        <div class="row">
                            <div class="col-md-10 offset-1 mt-12">
                                <div class="card mt-4 mb-4">
                                    <div class="card-header">Gráfico de Lucros</div>
                                    <div class="card-body">
                                        <div class="chart-container pie-chart">
                                            <canvas id="bar_chart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- Fim dashboard -->

                <!-- Footer -->

                <!-- Fim do Footer -->

            </section>
            <!-- Fim do conteúdo -->

        </div>
        <!-- Fim da página -->
    </div>
    <!-- Botão pra voltar pra cima-->
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyrightText bg-white">
                <p>Copyright 2021 <a href="#">Senac</a>. Todos os Direitos Reservados</p>
            </div>
        </div>
    </footer>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    

    <!-- Possível  PARTE EXTRA

    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>
 
    -->
</body>

</html>
<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="Js/dashboard.js"></script>

<!-- Page level plugins -->

<script src="Js/teste.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
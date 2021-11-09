<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>💈 Barbearia Neves 💈</title>

    <!--Fontes-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!--CSS-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/style-dashboard.css" rel="stylesheet">

</head>

<body id="page-top">
    
    <!-- Página -->
    <div id="wrapper">

        

        <!-- Conteúdo da Página -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Dashboards -->
            <div id="content">


                <!-- Começo -->
                <div class="container-fluid">

                    <!-- Header -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-light">Dashboard</h1>
                        
                    </div>

                    <!-- Cartões -->
                    <div class="row">

                        <!-- Card 1 -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Ganhos (Semanal)</div>
                                            <!-- Função php para pegar o lucro mensal abaixo  -->    
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card 2 -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Ganhos (Mensal)</div>
                                                <!-- Função php para pegar o lucro mensal abaixo  -->    
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card 3 -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Clientes satisfeitos
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <!-- Função php para pegar o total de feedbacks com 3 estrelas ou mais abaixo  --> 
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card 4 -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Total de feedbacks</div>
                                            <!-- Função php para pegar o total de feedbacks abaixo  -->
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Dashboard Lucro -->

                    <div class="row">

                        <!-- Conteudo -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Drop do dashbaord 1 -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Gráfico de Lucros</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Opções:</div>
                                            <a class="dropdown-item" href="#">Fábio</a>
                                            <a class="dropdown-item" href="#">Fábio</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Fábio</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Corpo -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Gráfico de pizza 1 -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Drop do card de pizza 1-->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Gráfico de Pizza</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Opções:</div>
                                            <a class="dropdown-item" href="#">Fábio</a>
                                            <a class="dropdown-item" href="#">Fábio</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Fábio</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Corpo -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="myPieChart"></canvas>
                                    </div>
                                    <div class="mt-4 text-center small">
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-primary"></i> Cortes
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-success"></i> Unhas
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-info"></i> Escovas
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <!-- Dashbaord 1 -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Drop do dashbaord 1 -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-danger">Gráfico de Despesas</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Opções:</div>
                                            <a class="dropdown-item" href="#">Fábio</a>
                                            <a class="dropdown-item" href="#">Fábio</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Fábio</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Conteúdo -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart2"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Gráfico de Pizza 2 -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Opções gráfico de pizza 2 -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-danger">Gráfico de Pizza</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Opções:</div>
                                            <a class="dropdown-item" href="#">Fábio</a>
                                            <a class="dropdown-item" href="#">Fábio</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Fábio</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Conteúdo -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="myPieChart2"></canvas>
                                    </div>
                                    <div class="mt-4 text-center small">
                                        <span class="mr-2">
                                            <i class="fas fa-circle" style="color: #f59b3b;"></i> Alugel
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle 2" style="color: #955ed1;"></i> Água
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle" style="color: #edca61;"></i> Luz
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-danger"></i> Irmã
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                   
                    

                </div>
             

            </div>
            <!-- Fim conteúdo -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; SENAC 2021</span>
                    </div>
                </div>
            </footer>
            <!-- Fim do Footer -->

        </div>
        <!-- Fim do conteúdo -->

    </div>
    <!-- Fim da página -->

    <!-- Botão pra voltar pra cima-->
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
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="Js/dashboard.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="Js/variaveis/chart-area-demo.js"></script>
    <script src="Js/variaveis/chart-pie-demo.js"></script>

</body>

</html>
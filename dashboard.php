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
include_once 'C:/xampp/htdocs/Projeto-barbearia/controller/dashboardController.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/dao/daoDashboard.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/agendamento_model.php';

$am = new Agendamento();
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
    <script src="Js/sweetalert2.all.min.js"></script>
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
    <?php
    if (isset($_POST['finalizar'])) {
        if ($am != null) {
            $id = $_POST['ide'];

            $ac = new DashboardController();
            $msg = $ac->concluirAgendamento($id);

            echo "<script>Swal.fire({
                icon: 'success',
                title: 'O agendamento encerrado com sucesso!',
                
                timer: 2000
              })</script>";
            unset($_POST['finalizar']);
            echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"2;
                URL='dashboard.php'\">";
        }
    }
    ?>
    <header style="z-index: 1000;">
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
    <div class="container mb-4" style="margin-top: 90px;">
        <table class="table table-bordered mt-4">
            <thead class="table-dark">
                <tr>
                    <th style="text-align: center;">Data agendamento</th>
                    <th style="text-align: center;">Forma de pagamento </th>
                    <th style="text-align: center;">Valor </th>
                    <th style="text-align: center;">Status do agendamento </th>
                    <th style="text-align: center;">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                //Data e hora juntos
                function vemDataHora($data)
                {
                    $tempdata = substr($data, 8, 2) . '/' .
                        substr($data, 5, 2) . '/' .
                        substr($data, 0, 4) .
                        substr($data, 10, 9);
                    return ($tempdata);
                }
                function virgula($numero)
                {
                    if (substr($numero, 3, 2) == NULL) {
                        $tempdata = 'R$ ' . substr($numero, 0, 2) . ',' . '00';
                        return ($tempdata);
                    } else {
                        $tempdata = 'R$ ' . substr($numero, 0, 2) . ',' .
                            substr($numero, 3, 2);
                        return ($tempdata);
                    }
                }
                $acTable = new DashboardController();
                $listaAgendamentos = $acTable->ListarTodosAgendamentos();


                $a = 0;
                if ($listaAgendamentos != null) {
                    foreach ($listaAgendamentos as $la) {
                        $a++;
                ?>
                        <tr>
                            <td style="text-align: center; color: black;"><?php print_r(vemDataHora($la->getDataAgenda())); ?></td>
                            <td style="text-align: center; color: black;"><?php print_r($la->getForma_Pagamento()); ?></td>
                            <td style="text-align: center; color: black;"><?php print_r(virgula($la->getValor())); ?></td>
                            <td style="text-align: center; color: black;"><?php print_r($la->getStatusAgendamento()); ?></td>
                            <td class="d-flex justify-content-center">
                                <button type="button" class="btn-sm btn-outline-primary " data-toggle="modal" data-target="#detailModal<?php echo $la->getId(); ?>">Detalhes</button>
                                <button type="button" class="btn-sm btn-outline-success " data-toggle="modal" data-target="#successModal<?php echo $la->getId(); ?>">Finalizar</button>
                            </td>
                        </tr>
                        <!-- INICIO Modal detalhes -->
                        <div class="modal fade" id="detailModal<?php echo $la->getId(); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title " id="myModalLabel"><strong style="color: black;">Detalhes do agendamento</strong></h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <br>
                                    </div>
                                    <div class="modal-body">
                                        <label style="color: black;">Horário: <?php echo $la->getHorario(); ?></label>
                                        <br>
                                        <label style="color: black;">Data do agendamento: <?php echo vemDataHora($la->getDataAgenda()); ?></label>
                                        <br>
                                        <label style="color: black;">Forma de pagamento: <?php echo $la->getForma_Pagamento(); ?></label>
                                        <br>
                                        <label style="color: black;">Data de pagamento: <?php echo vemDataHora($la->getDataPagemento()); ?></label>
                                        <br>
                                        <label style="color: black;">Valor: <?php echo virgula($la->getValor()); ?></label>
                                        <br>
                                        <label style="color: black;">Status: <?php echo $la->getStatusAgendamento(); ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- FIM Modal detalhes -->
                        <div class="modal fade" id="successModal<?php echo $la->getId(); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title " id="myModalLabel"><strong style="color: black;">Finalizar Agendamento</strong></h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <br>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="">
                                            <label><strong>Deseja encerrar esse agendamento?</strong></label>
                                            <input type="hidden" name="ide" value="<?php echo $la->getId(); ?>">
                                    </div>
                                    <div class="modal-footer">
                                        <div class="row">
                                            <button type="reset" class="btn-sm btn-secondary" data-dismiss="modal">Não</button>
                                            <button type="submit" id="finalizar" name="finalizar" class="btn-sm btn-primary">Sim</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <div id="wrapper flex-column">
        <!-- Conteúdo da Página -->
        <div id="content-wrapper" class="d-flex flex-column">
            <section class="mt-5">
                <!-- Dashboards -->
                <div id="content">
                    <!-- Começo -->
                    <div class="container-fluid">
                        <!-- Cartões -->
                        <div class="row">
                            <div class="col-md-12 mt-12">
                                <div class="card mt-5 mb-4">
                                    <div class="card-header">
                                        <h2>Gráfico de Lucros</h2>
                                    </div>
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
    <div class="container">


        <div class="card mt-4 mb-4">
            <div class="card-header"><h2> Cadastro de Despesas </h2></div>
            <div class="card-body">
                <div class="form-group">
                    <h4 class="mb-4">Tipo de conta:</h4>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="tipo" id="tipo_1" value="Agua" checked>
                        <label class="form-check-label mb-2" for="tipo_1">Água</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" name="tipo" id="tipo_2" class="form-check-input" value="Luz">
                        <label class="form-check-label mb-2" for="tipo_2">Luz</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" class="form-check-input" type="radio" name="tipo"  id="tipo_3" value="Salao">
                        <label class="form-check-label mb-2" for="tipo_3">Salão</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" class="form-check-input" type="radio" name="tipo"  id="tipo_4" value="Outros">
                        <label class="form-check-label mb-2" for="tipo_4">Outros</label>
                    </div>

                    <div class="form-group">
                    <h4 class="mb-4">Já foi paga?</h4>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="status_1" value="Sim" checked>
                        <label class="form-check-label mb-2" for="pago_1">Sim</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" name="status" id="status_2" class="form-check-input" value="Nao">
                        <label class="form-check-label mb-2" for="tipo_2">Não</label>
                    </div>
                    
                    </div>
                        
                </div>
                <div class="form-group">
                    <button type="button" name="submit_data" class="btn btn-primary" id="submit_data">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Botão pra voltar pra cima-->
    <footer class="sticky-footer bg-white pt-0 pb-0">
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
<script>
    $(document).ready(function() {

        $('#submit_data').click(function() {

            var tipo = $('input[name=tipo]:checked').val();
            var status = $('input[name=status]:checked').val();

            $.ajax({
                url: "data.php",
                method: "POST",
                data: {
                    action: 'insert',
                    tipo: tipo,
                    status: status
                },
                beforeSend: function() {
                    $('#submit_data').attr('disabled', 'disabled');
                },
                success: function(data) {
                    $('#submit_data').attr('disabled', false);

                    $('#tipo_1').prop('checked', 'checked');
                    $('#tipo_2').prop('checked', false);
                    $('#tipo_3').prop('checked', false);
                    $('#tipo_4').prop('checked', false);


                    $('#status_1').prop('checked', 'checked');
                    $('#status_2').prop('checked', false);

                    alert("Dados enviados...");

                    makechart();
                }
            })

        });


        makechart();

        function makechart() {
            $.ajax({
                url: "data.php",
                method: "POST",
                data: {
                    action: 'fetch'
                },
                dataType: "JSON",
                success: function(data) {

                    var total1 = [];
                    var total2 = [];
                    var total3 = [];
                    var total4 = [];
                    var total5 = [];
                    var total6 = [];
                    var total7 = [];

                    var seg = ['Segunda'];
                    var ter = ['Terça'];
                    var qua = ['Quarta'];
                    var qui = ['Quinta'];
                    var sex = ['Sexta'];
                    var sab = ['Sábado'];
                    var dom = ['Domingo'];

                    var dia = [];
                    var date = [];
                    var total = [];
                    var color = [];


                    for (var count = 0; count < data.length; count++) {
                        dia.push(data[count].dia)
                        date.push(data[count].date);
                        total.push(data[count].total);
                        color.push(data[count].color);


                        if (dia[count] == "Monday") {
                            seg.push(date[count])
                            total1.push(total[count])

                        }
                        if (dia[count] == "Tuesday") {
                            ter.push(date[count])
                            total2.push(total[count])

                        }
                        if (dia[count] == "Wednesday") {
                            qua.push(date[count])
                            total3.push(total[count])

                        }
                        if (dia[count] == "Thursday") {
                            qui.push(date[count])
                            total4.push(total[count])

                        }
                        if (dia[count] == "Friday") {
                            sex.push(date[count])
                            total5.push(total[count])

                        }
                        if (dia[count] == "Saturday") {
                            sab.push(date[count])
                            total6.push(total[count])

                        }
                        if (dia[count] == "Sunday") {
                            dom.push(date[count])
                            total7.push(total[count])

                        }





                    }

                    var chart_data = {
                        labels: [seg, ter, qua, qui, sex, sab, dom],
                        datasets: [{
                            label: 'Total em R$',
                            backgroundColor: [color, color, color, color, color, color, color],
                            data: [total1, total2, total3, total4, total5, total6, total7]
                        }],
                    };

                    var options = {
                        responsive: true,
                        plugins: {
                            title: {
                                display: true,
                                text: 'TESTEEEEE'
                            }
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    min: 0
                                }
                            }]
                        }
                    };


                    var group_chart3 = $('#bar_chart');

                    var graph3 = new Chart(group_chart3, {
                        type: 'bar',
                        data: chart_data,
                        options: options
                    });
                }
            })
        }

    });
</script>

<!-- Page level plugins -->


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
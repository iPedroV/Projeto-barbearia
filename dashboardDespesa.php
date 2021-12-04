<?php
ob_start();
session_start();

if ((!isset($_SESSION['emailc']) || !isset($_SESSION['nomec']))
    || !isset($_SESSION['nr']) ||
    ($_SESSION['nr'] != $_SESSION['conferenr'])
) {
    header("Location: index.php");
    exit;
}
include_once 'C:/xampp/htdocs/Projeto-barbearia/controller/dashboardController.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/dao/daoDashboard.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/agendamento_model.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/Despesa.php';

$am = new Agendamento();
$dm = new Despesa();

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
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- Bootstrap core JavaScript-->

    <!-- ESSE CARA TA DANDO
    <script src="vendor/jquery/jquery.min.js"></script>
    -->

    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="Js/sweetalert2.all.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
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
    <style>
        .page-item.active .page-link {
            z-index: 3;
            color: #fff;
            background-color: #414142;
            border-color: #000000;
        }

        .page-item:last-child .page-link {
            border-top-right-radius: 0.35rem;
            border-bottom-right-radius: 0.35rem;
            color: #414142;
        }

        .page-link {
            position: relative;
            display: block;
            padding: 0.5rem 0.75rem;
            margin-left: -1px;
            line-height: 1.25;
            color: #1d1e22;
            background-color: #fff;
            border: 1px solid #dddfeb;
        }
    </style>

</head>

<body id="page-top">
    <?php

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
                        <a href="dashboard.php" class="dropdown-item notify-item">
                            <i class="mdi mdi-account-circle me-1"></i>
                            <span>Meus Lucros</span>
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

        <!-- TABELA DE DESPESAS -->
        <table id="example" class="table  row-border table-striped table-bordered mt-4">
            <thead class="table-dark">
                <tr>
                    <th style="text-align: center;">tipo </th>
                    <th style="text-align: center;">Data </th>
                    <th style="text-align: center;">Pagamento Realizado</th>
                    <th style="text-align: center;">Valor</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $dcTable = new DashboardController();
                $listaDespesas = $dcTable->ListarTodasDespesas();
                function vemData($data)
                {
                    $tempdata = substr($data, 8, 2) . '/' .
                        substr($data, 5, 2) . '/' .
                        substr($data, 0, 4);
                    return ($tempdata);
                }

                function virgula($numero)
                {
                    if (substr($numero, 3, 2) == NULL) {
                        $tempdata = 'R$ ' . substr($numero, 0, 3) . ',' . '00';
                        return ($tempdata);
                    } else {
                        $tempdata = 'R$ ' . substr($numero, 0, 4) . ',' .
                            substr($numero, 5, 2) . '00';
                        return ($tempdata);
                    }
                }

                $a = 0;
                if ($listaDespesas != null) {
                    foreach ($listaDespesas as $ld) {
                        $a++;
                ?>
                        <tr>
                            <td style="text-align: center; color: black;"><?php print_r($ld->getTipo()); ?></td>
                            <td style="text-align: center; color: black;"><?php print_r(vemData($ld->getDataRegistroDespesa())); ?></td>
                            <td style="text-align: center; color: black;"><?php print_r($ld->getStatus()); ?></td>
                            <td style="text-align: center; color: black;"><?php print_r(virgula($ld->getValor())); ?></td>
                        </tr>


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
                                        <h2>Gráfico de Despesas</h2>
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
            <div class="card-header">
                <h2> Cadastro de Despesas </h2>
            </div>
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
                        <input class="form-check-input" class="form-check-input" type="radio" name="tipo" id="tipo_3" value="Salao">
                        <label class="form-check-label mb-2" for="tipo_3">Salão</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" class="form-check-input" type="radio" name="tipo" id="tipo_4" value="Outros">
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
                    <div class="form-group">
                        <h4 class="mb-4">Data da despesa: <input for="data" type="date" name="data" id="data" value="<?php echo date('Y-m-d'); ?>" required></h4>

                    </div>

                    <div class="form-group">
                        <h4 class="mb-4">Valor (apenas números): <input for="valor" type="number" name="valor" id="valor" value="1" required></h4>


                    </div>
                    <div class="form-group">
                        <button type="button" name="submit_data"  class="btn btn-primary" id="submit_data">Cadastrar</button>
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

<script>
    $('#example').DataTable({
        "language": {
            "info": "Mostrando de _START_ até _END_ das _TOTAL_ informações",
            "infoEmpty": "Nada para mostrar!",
            "infoFiltered": "(filtrado das _MAX_ total informações)",
            "lengthMenu": "Mostrar _MENU_ informações",
            "search": "Pesquisa:",
            "emptyTable": "Tabela Vazia!",
            "zeroRecords": "Não há nada com essa informação!",
            "paginate": {
                "previous": "Anterior",
                "next": "Próximo",

            }
        }
    });
</script>

<script>
    $(document).ready(function() {

        $('#submit_data').click(function() {

            var tipo = $('input[name=tipo]:checked').val();
            var status = $('input[name=status]:checked').val();
            var dat = $("input[name=data]").val();
            var valor = $("input[name=valor]").val();
            $.ajax({
                url: "dataDespesa.php",
                method: "POST",
                data: {
                    action: 'insert',
                    tipo: tipo,
                    status: status,
                    dat: dat,
                    valor: valor
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
                    //so serve para voltar o valor original
                    $('#valor').val('1');
                    Swal.fire({
                        icon: 'success',
                        title: 'Dados cadastrados com sucesso',
                
                        timer: 2000
                    })
                    setTimeout(() => {makechart();
                    window.location.reload();}, 2000);
                
                    
                    
                }
            })

        });


        makechart();

        function makechart() {
            $.ajax({
                url: "dataDespesa.php",
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
                        for (i = 0; i < 7; i++) {
                            color.push('#730d10');


                        }

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
                            backgroundColor: color,
                            data: [total1, total2, total3, total4, total5, total6, total7]
                        }],
                    };

                    var options = {
                        responsive: true,

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
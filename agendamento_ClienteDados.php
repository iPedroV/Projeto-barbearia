<?php
ob_start();
session_start();

if ((!isset($_SESSION['emailc']) || !isset($_SESSION['nomec']))
    || !isset($_SESSION['nr']) ||
    ($_SESSION['nr'] != $_SESSION['conferenr'])
) {
    header("Location: agendamento_ClienteDados.php");
    exit;
}
$id = $_SESSION['idc'];
include_once 'C:/xampp/htdocs/Projeto-barbearia/controller/agendamentoController.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/dao/daoAgendamento.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/agendamento_model.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/agendamento_dos_servicos.php';

$dt = new Agendamento();
$agendamento = new Agendamentos_dos_servicos();
$dt->setId($agendamento);

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
        <div class="menuToggle" onclick=" toggleMenu();">
            <ul class="navigation">
                <li><a href="index.php" onclick=" toggleMenu();">Home</a></li>
                <li><a href="agendamento.php" onclick=" toggleMenu();">Agendamento</a></li>

                <div class="dados" onclick=" toggleMenu();">
                    <li class="dropdown notification-list" onclick=" toggleMenu();">
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

    <?php

    if (isset($_POST['excluir'])) {

        if ($dt != null) {
            $id = $_POST['ide'];

            $pc = new AgendamentoController();
            unset($_POST['excluir']);
            $msg = $pc->excluirAgendamento($id);
            $msg = $pc->excluirAgendamento2($id);
    ?>
            <script>
                Swal.fire({
                    title: 'Agendamento não pode ser realizado!',
                    text: 'O dia escolhido não pode ser agendado antes do dia atual (<?php echo $dateEscolhida ?>)!',
                    icon: 'success',
                    confirmButtonText: 'Ok'
                })
            </script>
    <?php
            $_SESSION['funcionario2'] = "";
            $_SESSION['servico2'] = "";
            $_SESSION['nome_Servico2'] = "";
            $_SESSION['agendamentoServicoTempo2'] = "";
            $_SESSION['agendamentoServicoValor'] = "";
            echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"0;
            URL='agendamento.php'\">";
        }
    }

    ?>
    <div class="page-header">
        <?php
        if ($_SESSION['perfilc'] == 'Cliente') {
        ?>
            <h3 style="padding-top: 25px; padding-bottom: 25px; padding-left: 40px; margin-top: 10px;
                border-top: 2px solid black; border-bottom: 2px solid black; color: white; background: linear-gradient(90deg, #666 35%, #111 80%)!important;">
                Agendamento do(a) <?php echo $_SESSION['nomec']; ?></h3>

        <?php
        } else if ($_SESSION['perfilc'] == 'Funcionario') {
        ?>

            <h3 style="padding-top: 25px; padding-bottom: 25px; padding-left: 40px; margin-top: 10px;
                border-top: 2px solid black; border-bottom: 2px solid black; color: white; background: linear-gradient(90deg, #666 35%, #111 80%)!important;">
                Agendamento em nome do(a) <?php echo $_SESSION['nomec']; ?></h3>
        <?php } else if ($_SESSION['perfilc'] == 'Secretaria' || $_SESSION['perfilc'] == 'Administrador') {
        ?>

            <h3 style="padding-top: 25px; padding-bottom: 25px; padding-left: 40px; margin-top: 10px;
                    border-top: 2px solid black; border-bottom: 2px solid black; color: white; background: linear-gradient(90deg, #666 35%, #111 80%)!important;">
                Listagem dos Agendamentos</h3>
        <?php } ?>

    </div>

    <div class="table-responsive">

        <div class="col-md-10 offset-1">
            <table class="table table-striped" style="border-radius: 3px; overflow:hidden; margin-top: 25px;">
                <thead class="table-dark text-center">
                    <tr>
                        <th>Data Agendada</th>
                        <th>Horário</th>
                        <th>Forma de Pagamento</th>
                        <th>Valor Total</th>
                        <th style="border-right: 8px solid #fff;">Status</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="text-center align-middle" style="border-left: 4px solid black; border-right: 4px solid black;">
                    <?php
                    //FUNÇÃO QUE FORMATA A DATA QUE VEM DO MYSQL
                    function vemData($qqdata)
                    {
                        $tempdata = substr($qqdata, 8, 2) . '/' .
                            substr($qqdata, 5, 2) . '/' .
                            substr($qqdata, 0, 4);
                        return ($tempdata);
                    }

                    //FUNÇÃO QUE FORMATA A HORA QUE VEM DO MYSQL
                    function horaMin($qqdata)
                    {
                        $tempdata = substr($qqdata, 0, 2) . 'h' .
                            substr($qqdata, 3, 2) . 'min';
                        return ($tempdata);
                    }

                    $TabelaVisual = new AgendamentoController();
                    if ($_SESSION['perfilc'] == 'Cliente') {
                        $listaAgendamento = $TabelaVisual->ListarClienteAgendamento();
                    } else if ($_SESSION['perfilc'] == 'Funcionario') {
                        $listaAgendamento = $TabelaVisual->ListarClienteAgendamento02();
                    } else if ($_SESSION['perfilc'] == 'Administrador' || $_SESSION['perfilc'] == 'Secretaria') {
                        $listaAgendamento = $TabelaVisual->ListarClienteAgendamento03();
                    }
                    $a = 0;
                    if ($listaAgendamento != null) {
                        foreach ($listaAgendamento as $la) {

                            $a++;
                    ?>
                            <tr>
                                <td><?php print_r(vemData($la->getDataAgenda())); ?></td>
                                <td><?php print_r(horaMin($la->getHorario())); ?></td>
                                <td><?php print_r($la->getForma_Pagamento()); ?></td>
                                <td>R$ <?php print_r($la->getValor()); ?></td>
                                <td style="border-right: 8px solid #fff;"><?php print_r($la->getStatusAgendamento()); ?></td>
                                <?php
                                if ($_SESSION['perfilc'] == 'Cliente') {
                                ?>
                                    <td>
                                        <button type="submit" class="btnDetalhes" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $a; ?>">
                                            Detalhes</button>
                                    </td>

                                    <td><button type="submit" class="btnReagendar" data-bs-toggle="modal" data-bs-target="#exampleModal2<?php echo $a; ?>">
                                            Reagendar</button>
                                    </td>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal<?php echo $a; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header" style="background: linear-gradient(90deg, #666 30%, #111 80%)!important;">
                                                    <h5 class="modal-title" id="exampleModalLabel" style="color: white;">Detalhes</h5>
                                                    <button type="button" class="" data-bs-dismiss="modal" aria-label="Close" style="color: white; background-color: transparent; font-size: 22px; border: none;">X</button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post" action="">
                                                        <label style="border-bottom: 1px solid black; padding-bottom: 10px; width: 100%;"><strong>Agendamento efetuado em
                                                                <?php echo vemData($la->getDataAgenda()); ?></strong></label>
                                                        <input type="hidden" name="ide" value="<?php echo $la->getId(); ?>">

                                                        <br><br><label>Serviço(s): </label>
                                                        <ul name="id_servicos" id="MostarDados" class="form-control">

                                                            <?php
                                                            $result_post = "SELECT * FROM `agendamentos_dos_servicos` "
                                                                . "WHERE agendamentos_id = " . $la->getId() . "";
                                                            $resultado_post = mysqli_query($conn, $result_post);
                                                            while ($row_post = mysqli_fetch_assoc($resultado_post)) {
                                                                $serv = $row_post['sf_servicos'];

                                                                $result_post02 = "Select * from `servicos` WHERE idServicos = $serv";
                                                                $resultado_post02 = mysqli_query($conn, $result_post02);
                                                                while ($row_post02 = mysqli_fetch_assoc($resultado_post02)) {
                                                                    echo '<li style="list-style: none;">' . $row_post02['nome'] . '</li>';
                                                                }
                                                            }

                                                            ?>
                                                            <li style="list-style: none;"><br>Valor total do serviço: R$ <?php print_r($la->getValor()); ?></li>
                                                        </ul>

                                                        <label>Funcionario(s): </label>
                                                        <ul name="id_servicos" id="MostarDados" class="form-control">

                                                            <?php
                                                            $result_post = "SELECT * FROM `agendamentos_dos_servicos` "
                                                                . "WHERE agendamentos_id = " . $la->getId();
                                                            $resultado_post = mysqli_query($conn, $result_post);
                                                            while ($row_post = mysqli_fetch_assoc($resultado_post)) {
                                                                $func = $row_post['sf_funcionario'];
                                                            }

                                                            $result_post02 = "Select * from `usuario` WHERE id = $func LIMIT 1";
                                                            $resultado_post02 = mysqli_query($conn, $result_post02);
                                                            while ($row_post02 = mysqli_fetch_assoc($resultado_post02)) {
                                                                echo '<li style="list-style: none;">' . $row_post02['nome'] . '</li>';
                                                            }
                                                            ?>
                                                        </ul>
                                                    <?php
                                                } else if ($_SESSION['perfilc'] == 'Funcionario' || $_SESSION['perfilc'] == 'Administrador' || $_SESSION['perfilc'] == 'Secretaria') {

                                                    ?>
                                                        <td colspan="2">
                                                            <button type="submit" class="btnDetalhesCliente" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $a; ?>">
                                                                Dados Cliente</button>
                                                        </td>



                                                        <!-- Modal -->
                                                        <div class="modal fade" id="exampleModal<?php echo $a; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header" style="background: linear-gradient(90deg, #666 30%, #111 80%)!important;">
                                                                        <h5 class="modal-title" id="exampleModalLabel" style="color: white;">Detalhes</h5>
                                                                        <button type="button" class="" data-bs-dismiss="modal" aria-label="Close" style="color: white; background-color: transparent; font-size: 22px; border: none;">X</button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form method="post" action="">
                                                                            <label style="border-bottom: 1px solid black; padding-bottom: 10px; width: 100%;"><strong>Agendamento efetuado em <?php echo $la->getDataAgenda(); ?></strong></label>
                                                                            <input type="hidden" name="ide" value="<?php echo $la->getId(); ?>">

                                                                            <br><br><label>Dados do cliente: </label>
                                                                            <ul name="id_servicos" id="MostarDados" class="form-control">

                                                                                <?php
                                                                                $result_post = "SELECT * FROM `agendamentos` "
                                                                                    . "INNER JOIN usuario on agendamentos.usuario_id = usuario.id WHERE agendamentos.idAgendamento = " . $la->getId();
                                                                                $resultado_post = mysqli_query($conn, $result_post);
                                                                                while ($row_post = mysqli_fetch_assoc($resultado_post)) {
                                                                                    echo '<li style="list-style: none;" >' . $row_post['nome'] . '</li>';
                                                                                    echo '<li style="list-style: none;" >' . $row_post['telefone'] . '</li>';
                                                                                    echo '<li style="list-style: none;" >' . $row_post['email'] . '</li>';
                                                                                }

                                                                                ?>
                                                                            </ul>
                                                                        <?php } ?>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="modalSair" data-bs-dismiss="modal">Sair</button>
                                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal2<?php echo $a; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background: linear-gradient(90deg, #666 30%, #111 80%)!important;">
                                                        <h5 class="modal-title" id="exampleModalLabel" style="color: white;">Reagendar</h5>
                                                        <button type="button" class="" data-bs-dismiss="modal" aria-label="Close" style="color: white; background-color: transparent; font-size: 22px; border: none;">X</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" action="">
                                                            <label><strong>Deseja reagendar o serviço?</strong></label><br><br>
                                                            <label>Obs: Você será redirecionado para página do calendário onde continuará o processo.</label>
                                                            <input type="hidden" name="ide" value="<?php echo $la->getId(); ?>">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" name="excluir" class="btnReagendar">Sim</button>
                                                        <button type="reset" class="btnDetalhes" data-bs-dismiss="modal">Não</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                            </tr>
                        <?php
                        }
                    } else {
                        ?>
                </tbody>
            </table>
        </div>
        <div>
        </div>

        <div class="row" id="some" style="width: 99%;">
            <div class="col-md-2 offset-2"></div>
            <form method="POST" action="">
           
            <?php
             if ($_SESSION['perfilc'] == 'Cliente') {
                $result_post02 = "Select * from `agendamentos` WHERE usuario_id = $id and status_agendamento = 'concluido'";
                $resultado_post02 = mysqli_query($conn, $result_post02);
                while ($row_post02 = mysqli_fetch_assoc($resultado_post02)) {
                    $user = $row_post02['usuario_id'];
                    $status = $row_post02['status_agendamento'];

                    if ($status == "concluido") {
                ?>
                        <script>
                            /*Swal.fire({
                                title: 'Agendamento Concluído!',
                                text: 'Por favor clique em REAGENDAR para poder fazer um novo agendamento.',
                                icon: 'warning',
                                confirmButtonText: '<l>Concluído</l>'
                            })*/
                        </script>
                <?php
                    }
                }
            }
            ?>
                <label class="nenhumAgendamento">Nenhum agendamento foi realizado.</label>
                <button type="submit" class="btn" name="fazerAgendamento" id="fazerAgendamento">&#8652; Fazer Agendamento &#8651;</button>
            </form>
        </div>

        <div class="col-md-10 offset-1" style="background-color: #222; height: 30px;"></div>
    <?php
                        if (isset($_POST['fazerAgendamento'])) {
                            header("Location: agendamento.php");
                        }
                    }
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="Js/bootstrap.min.js"></script>
    <script type="text/javascript">
        window.addEventListener('scroll', function() {
            const header = document.querySelector('header');
            header.classList.toggle("sticky", window.scrollY > 0);
        });

        function toggleMenu() {
            const menuToggle = document.querySelector('.menuToggle');
            const navigation = document.querySelector('.navigation');
            const some = document.querySelector('#some');
            menuToggle.classList.toggle('active');
            navigation.classList.toggle('active');
            some.classList.toggle('disabled');
        }
    </script>
</body>
</head>

</html>
<?php
ob_start();
if (!isset($_SESSION)) {
    session_start();
}

if ((!isset($_SESSION['emailc']) || !isset($_SESSION['nomec']))
    || !isset($_SESSION['nr']) || !isset($_SESSION['perfilc']) ||
    ($_SESSION['nr'] != $_SESSION['conferenr'])
) {
    header("Location: sessionDestroy.php");
    exit;
}

$id = $_SESSION['idc'];

include_once 'C:/xampp/htdocs/Projeto-barbearia/controller/agendamentoController.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/controller/dashboardController.php';

include_once 'C:/xampp/htdocs/Projeto-barbearia/dao/daoAgendamento.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/dao/daoDashboard.php';

include_once 'C:/xampp/htdocs/Projeto-barbearia/model/agendamento_model.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/agendamento_dos_servicos.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/mensagem.php';

include_once 'C:/xampp/htdocs/Projeto-barbearia/bd/banco.php';



$dt = new Agendamento();
$agendamento = new Agendamentos_dos_servicos();
$dt->setId($agendamento);

$dts = new AgendamentoController();



?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="sorcut icon" href="img/barber-shop.png" type="image/png" style="width: 16px; height: 16px;">

    <link href="css/secretaria-agenda.css" rel="stylesheet">

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

    <title>Agendamentos</title>
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

    <div class="table-responsive d-flex justify-content-center mt-3 mb-5">
        <div>
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th colspan="1" class="text-start">Data Agendada:</th>
                        <th colspan="1" class="text-start">Horário:</th>
                        <th colspan="1" class="text-start">Status:</th>
                        <!--<th colspan="1" class="text-start">Forma de Pagamento:</th>-->
                        <th colspan="1" class="text-start">Valor Total:</th>
                        <th colspan="1" class="text-start">Serviço:</th>
                        <th colspan="1" class="text-start">Funcionario:</th>
                        <th colspan="1" class="text-start">Cliente:</th>
                        <th colspan="1" class="text-start">Telefone do Cliente</th>
                        <th></th>
                        <th colspan="1" class="text-start">Cancelar</th>
                        <th colspan="1" class="text-start">Concluir</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    if (isset($_POST['excluir'])) {

                        if ($dt != null) {
                            $id = $_POST['ide'];

                            $pc = new AgendamentoController();
                            unset($_POST['excluir']);
                            $msg = $pc->excluirAgendamento($id);
                            $msg = $pc->excluirAgendamento2($id);

                            echo "<script>Swal.fire({
                                icon: 'success',
                                title: 'O agendamento cancelado com sucesso!',
                                timer: 2000
                                })</script>";

                            echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"2;
                                    URL='agendamentosSecretaria.php'\">";
                        }
                    }


                    if (isset($_POST['concluir'])) {
                        if ($dt != null) {
                            $id = $_POST['ide'];

                            $ac = new DashboardController();
                            $msg = $ac->concluirAgendamento($id);

                            echo "<script>Swal.fire({
                                    icon: 'success',
                                    title: 'O agendamento encerrado com sucesso!',
                                    timer: 2000
                                    })</script>";
                            unset($_POST['concluir']);
                            echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"2;
                                        URL='agendamentosSecretaria.php'\">";
                        }
                    }

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
                    if ($_SESSION['perfilc'] == 'Secretaria') {
                        $listaAgendamento = $TabelaVisual->ListarClienteAgendamento04();
                    }
                    $a = 0;
                    if ($listaAgendamento != null) {
                        foreach ($listaAgendamento as $la) {

                            $a++;
                    ?>
                            <tr class=" align-middle">
                                <td><?php print_r(vemData($la->getDataAgenda())); ?></td>
                                <td><?php print_r(horaMin($la->getHorario())); ?></td>
                                <td><?php print_r($la->getStatusAgendamento()); ?></td>
                                <!--td><?php //print_r($la->getForma_Pagamento());
                                        ?></td>-->
                                <td>R$ <?php print_r($la->getValor()); ?></td>
                                <td>
                                    <!--Select do serviço-->
                                    <?php $result_post = "SELECT * FROM `agendamentos_dos_servicos` "
                                        . "WHERE agendamentos_id = " . $la->getId() . "";
                                    $resultado_post = mysqli_query($conn, $result_post);
                                    while ($row_post = mysqli_fetch_assoc($resultado_post)) {
                                        $serv = $row_post['sf_servicos'];

                                        $result_post02 = "Select * from `servicos` WHERE idServicos = $serv";
                                        $resultado_post02 = mysqli_query($conn, $result_post02);
                                        while ($row_post02 = mysqli_fetch_assoc($resultado_post02)) {
                                            echo '<li style="list-style: none;">' . $row_post02['nome'] . '</li>';
                                        }
                                    } ?>
                                </td>
                                <td>
                                    <!--Select do Funcionario-->
                                    <?php
                                    $result_post = "SELECT * FROM `agendamentos_dos_servicos` "
                                        . "WHERE agendamentos_id = " . $la->getId();
                                    $resultado_post = mysqli_query($conn, $result_post);
                                    while ($row_post = mysqli_fetch_assoc($resultado_post)) {
                                        $func = $row_post['sf_funcionario'];

                                        $result_post02 = "Select * from `usuario` WHERE id = $func";
                                        $resultado_post02 = mysqli_query($conn, $result_post02);
                                        while ($row_post02 = mysqli_fetch_assoc($resultado_post02)) {
                                            $form = $row_post02['nome'];

                                            $form = explode(" ", $form);
                                            $B = end($form); // pega a ultima string do Array
                                            $A = array_shift($form); // pega a primeira string do Array
                                            //echo $A." ".$B." "; impressão das variaveis do Array              
                                            echo '<li style="list-style: none;">' . $A . " " . $B . " " . '</li>';
                                        }
                                    }
                                    ?>
                                </td>
                                <td>
                                    <!--Select do Cliente-->
                                    <?php
                                    $result_post = "SELECT * FROM `agendamentos` "
                                        . "INNER JOIN usuario on agendamentos.usuario_id = usuario.id WHERE agendamentos.idAgendamento = " . $la->getId();
                                    $resultado_post = mysqli_query($conn, $result_post);
                                    while ($row_post = mysqli_fetch_assoc($resultado_post)) {
                                        $form = $row_post['nome'];

                                        $form = explode(" ", $form);
                                        $B = end($form); // pega a ultima string do Array
                                        $A = array_shift($form); // pega a primeira string do Array
                                        //echo $A." ".$B." "; impressão das variaveis do Array              
                                        echo '<li style="list-style: none;">' . $A . " " . $B . " " . '</li>';
                                    }
                                    ?>
                                </td>
                                <td colspan="1" class="text-center">
                                    <!--Select do telefone do Cliente-->
                                    <?php
                                    $result_post = "SELECT * FROM `agendamentos` "
                                        . "INNER JOIN usuario on agendamentos.usuario_id = usuario.id WHERE agendamentos.idAgendamento = " . $la->getId();
                                    $resultado_post = mysqli_query($conn, $result_post);
                                    while ($row_post = mysqli_fetch_assoc($resultado_post)) {
                                        echo $row_post['telefone'];
                                    }
                                    ?>
                                </td>
                                <td></td>
                                <td>
                                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#ModalExcluir<?php echo $a; ?>">
                                        Cancelar</button>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#ModalConcluir<?php echo $a; ?>">
                                        Concluir</button>
                                </td>
                            </tr>

                            <!--Modal de excluir o agendamento pela secretaria-->
                            <div class="modal fade" id="ModalExcluir<?php echo $a; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Cancelar Agendamento</h5>
                                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="post">
                                            <div class="modal-body">
                                                <label style="border-bottom: 1px solid black; padding-bottom: 10px; width: 100%;">Deseja cancelar o agendamento?</label>
                                                <input type="hidden" name="ide" value="<?php echo $la->getId(); ?>">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-outline-danger" name="excluir">Sim</button>
                                                <button type="reset" class="btn btn-outline-primary" data-bs-dismiss="modal">Não</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!--Modal de Concluir o agendamento pela secretaria-->
                            <div class="modal fade" id="ModalConcluir<?php echo $a; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Concluir Agendamento</h5>
                                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="post">
                                            <div class="modal-body">
                                                <label style="border-bottom: 1px solid black; padding-bottom: 10px; width: 100%;">Deseja cancelar o agendamento?</label>
                                                <input type="hidden" name="ide" value="<?php echo $la->getId(); ?>">
                                            </div>
                                            <form method="post">
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-outline-danger" name="concluir">Sim</button>
                                                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Não</button>
                                                </div>
                                            </form>
                                        </form>
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
    </div>
</body>

<script src="Js/bootstrap.min.js"></script>
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
<?php ob_end_flush(); ?>
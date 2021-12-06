<?php
ob_start();
session_start();

if ((!isset($_SESSION['emailc']) || !isset($_SESSION['nomec']))
    || !isset($_SESSION['nr']) ||
    ($_SESSION['nr'] != $_SESSION['conferenr'])
) {
    header("Location: sessionDestroy.php");
    exit;
}
include_once 'C:/xampp/htdocs/Projeto-barbearia/bd/banco.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/controller/funcionarioController.php';
__DIR__ . "/./model/Usuario.php";
__DIR__ . "/./Projeto-barbearia/model/mensagem.php";
__DIR__ . "/./Projeto-barbearia/bd/banco.php";

//usar isso--> require_once __DIR__ . "/../model/Usuario.php"
$ce = new Usuario();
$msg = new Mensagem();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width. initial-scale=1.0">
    <title>💈 Barbearia Neves 💈</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style-lista-funcionario.css" rel="stylesheet">
    <script src="Js/sweetalert2.all.min.js"></script>

    <style>
        .btnDetalhes {
            border: 1px solid #888;
            background-color: #888;
            color: white;
            width: 80px;
            height: 40px;
            border-radius: 4px;
            font-size: 18px;
        }

        .btnDetalhes:hover {
            border: 1px solid #333;
            background-color: #333;
        }

        .btnReagendar {
            border: 1px solid #333;
            background-color: #333;
            color: white;
            width: 80px;
            height: 40px;
            border-radius: 2px;
            text-decoration: none;
            font-size: 18px;

        }

        .btnReagendar:hover {
            border: 1px solid #000;
            background-color: #000;
            color: #fff;
        }

        @media screen and (max-width: 380px) {
            table {
                border-radius: 3px;
                overflow: hidden;
                margin-left: 32em !important;
            }
        }
    </style>

<body>

    <?php
    //Também faz parte da validação de login ... Logica do professor ...
    if (isset($_SESSION['msg'])) {
        if ($_SESSION['msg'] != "") {
            echo $_SESSION['msg'];
            echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"2;
                                    URL='./index.php'\">";
            $_SESSION['msg'] = "";
        }
    }

    if (isset($_POST['excluir'])) {
        if ($ce != null) {
            $id = $_POST['ide'];

            $fc = new funcionarioController();
            unset($_POST['excluir']);
            $msg = $fc->excluirFuncionario($id);
            echo "<script>Swal.fire({
                icon: 'success',
                title: 'Dados excluídos com sucesso',
                
                timer: 2000
              })</script>";
            echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"2;
                URL='ListarFuncionario.php'\">";
        }
    }
    if (isset($_POST['edit'])) {
        if ($ce != null) {
            $id = $_POST['id'];
            $fc = new FuncionarioController();
            $ce = $fc->pesquisarFuncionarioId($id);
            echo $ce;
        }
    }

    if (isset($_POST['alterar'])) {
        if ($ce != null) {
            $id = $_POST['id'];
            unset($_POST['alterar']);
            $fc = new FuncionarioController();
            $msg = $fc->editarFuncionario($id);
            echo "<script>Swal.fire({
                icon: 'success',
                title: 'Dados alterados com sucesso',
                
                timer: 2000
              })</script>";
            echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"2;
                URL='ListarFuncionario.php'\">";
        }
    }
    ?>

    <header>
        <a href="index.php" class="logo">Barbearia Neves<span>.</span></a>
        <div class="menuToggle" onclick=" toggleMenu();"></div>
        <?php
        include_once 'C:/xampp/htdocs/Projeto-barbearia/nav.php';
        echo navBar();
        ?>

    </header>

    <div class="table-responsive d-flex justify-content-center mt-3 mb-5">


        <br>
        <table class="table table-striped" style=" border-radius: 3px; overflow:hidden;">
            <thead class="table-dark">
                <tr>
                    <th>
                        <div class="d-flex justify-content-center">

                            <a href="cadastroFuncionario.php" class="btn btn-success  mb-1 mt-1  " style=" line-height: 0.75;  font-size: 1.2em; font-family: Arial, sans-serif;">
                                Adicionar</a>

                        </div>
                    </th>
                    <th>Nome</th>
                    <th class="text-center ">Perfil</th>
                    <th class="text-center ">E-Mail</th>
                    <th class="text-center ">Sexo</th>
                    <th>Telefone</th>

                    <th colspan="2" class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                function telefone($qqdata)
                {
                    //ajustando a mascara para telefone (problema se for tel fixo)
                    $tempdata = '(' . substr($qqdata, 0, 2) . ') ' .
                        substr($qqdata, 2, 5) . '-' .
                        substr($qqdata, 7, 8);

                    return ($tempdata);
                }
                $fcTable = new funcionarioController();
                $listaFuncionarios = $fcTable->listarFuncionario();
                $a = 0;
                if ($listaFuncionarios != null) {
                    foreach ($listaFuncionarios as $lf) {
                        $a++;
                ?>
                        <tr>
                            <td class="text-center">#</td>
                            <td><?php print_r($lf->getNome()); ?></td>
                            <td class="text-center "><?php print_r($lf->getPerfil()); ?></td>
                            <td class="text-center "><?php print_r($lf->getEmail()); ?></td>
                            <td class="text-center "><?php print_r($lf->getSexo()); ?></td>
                            <td><?php print_r(telefone($lf->getTelefone())); ?></td>

                            <td class="d-flex justify-content-center"> <button type="button" class="btnDetalhes" data-modal-title="<?php $ce->getId() ?>" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $a; ?>" data-whatever="<?php echo $lf->getId(); ?>" data-whatevernome="<?php echo $lf->getNome() ?>" data-whateveremail="<?php echo $lf->getEmail() ?>" data-whateverperfil="<?php echo $lf->getPerfil() ?>" data-whateversexo="<?php echo $lf->getSexo() ?>" data-whatevertelefone="<?php echo $lf->getTelefone() ?>">
                                    Editar</button>
                                </form>

                                <button type="button" class="btnReagendar" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $a; ?>" style="margin-left: 20px;">
                                    Excluir</button>
                            </td>

                        </tr>
                        <!-- INICIO Modal Excluir -->
                        <div class="modal fade" id="exampleModal<?php echo $a; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Excluir funcionário</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="">
                                            <label><strong>Deseja excluir o funcionário
                                                    <?php echo $lf->getNome(); ?>?</strong></label>
                                            <input type="hidden" name="ide" value="<?php echo $lf->getId(); ?>">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
                                        <button type="submit" name="excluir" class="btn btn-primary">Sim</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- FIM Modal Excluir -->

                        <!-- INICIO Modal Editar -->
                        <div class="modal fade" id="editModal<?php echo $a; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">

                                        <h4><strong class="modal-title" id="exampleModalLabel">Código: <label style="color:red;">
                                                    <?php
                                                    if ($lf != null)
                                                        echo $lf->getId();
                                                    ?>
                                                </label></strong></h4>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label class="control-label">Nome:</label>
                                                <input name="nome" type="text" class="form-control" id="nome" value="<?php echo $lf->getNome() ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="message-text" class="control-label">Email:</label>
                                                <input name="email" type="text" class="form-control" id="email" value="<?php echo $lf->getEmail() ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="message-text" class="control-label">Perfil:</label>
                                                <select class="form-select" name="perfil" id="perfil">

                                                    <option <?php
                                                            if ($lf->getPerfil() == "Funcionario") {
                                                                echo "selected = 'selected'";
                                                            }
                                                            ?>>Funcionario</option>
                                                    <option <?php
                                                            if ($lf->getPerfil() == "Secretaria") {
                                                                echo "selected = 'selected'";
                                                            }
                                                            ?>>Secretaria</option>
                                                    <option <?php
                                                            if ($lf->getPerfil() == "Administrador") {
                                                                echo "selected = 'selected'";
                                                            }
                                                            ?>>Administrador</option>

                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="message-text" class="control-label">Sexo:</label>
                                                <input name="sexo" type="text" class="form-control" id="sexo" value="<?php echo $lf->getSexo() ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="message-text" class="control-label">Telefone:</label>
                                                <input name="telefone" type="text" class="form-control" id="telefone" value="<?php echo $lf->getTelefone() ?>">
                                            </div>
                                            <input name="id" type="hidden" class="form-control" id="id-curso" value="<?php echo $lf->getID() ?>">

                                            <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                            <button type="submit" name="alterar" class="btn btn-danger">Alterar</button>

                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- FIM Modal Editar -->
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $('#editmodal<?php echo $a; ?>').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipient = <?php $lf->getId() ?> // Extract info from data-* attributes
            var recipientnome = <?php $lf->getNome() ?>
            var recipientemail = <?php $lf->getEmail() ?>
            var recipientperfil = <?php $lf->getPerfil() ?>
            var recipientsexo = <?php $lf->getSexo() ?>
            var recipienttelefone = <?php $lf->getTelefone() ?>
            //var recipientdetalhes = button.data('whateverdetalhes')
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)

            modal.find('.modal-title').text('ID ' + recipient)
            modal.find('#id').val(recipient)
            modal.find('#nome').val(recipientnome)
            modal.find('#email').val(recipientemail)
            modal.find('#perfil').val(recipientperfil)
            modal.find('#sexo').val(recipientsexo)
            modal.find('#telefone').val(recipienttelefone)

        })
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
</head>

</html>

<?php ob_end_flush(); ?>
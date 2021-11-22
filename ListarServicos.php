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
    include_once 'C:/xampp/htdocs/Projeto-barbearia/controller/servicosController.php';
    __DIR__ . "/./model/Usuario.php";
    include_once "C:/xampp/htdocs/Projeto-barbearia/model/mensagem.php";
    __DIR__ . "/./Projeto-barbearia/bd/banco.php";

    //usar isso--> require_once __DIR__ . "/../model/Usuario.php"
    $sm = new Servicos_model();
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

        /*if (isset($_POST['excluir'])) {
            if ($sm != null) {
                $id = $_POST['ide'];

                $fc = new servicosController();
                unset($_POST['excluir']);
                $msg = $fc->excluirFuncionario($id);
                echo $msg->getMsg();
                echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"2;
                URL='ListarFuncionario.php'\">";
            }
        }*/
        /*if (isset($_POST['edit'])) {
            if ($sm != null) {
                $id = $_POST['id'];
                $fc = new FuncionarioController();
                $sm = $fc->pesquisarFuncionarioId($id);
                echo $sm;
            }
        }*/

        /*if (isset($_POST['alterar'])) {
            echo $msg->getMsg();
                    //sleep(1);
                    
        }*/
        ?>

        <header>
            <a href="index.php" class="logo">Barbearia Neves<span>.</span></a>
            <div class="menuToggle" onclick=" toggleMenu();"></div>
            <?php
            include_once 'C:/xampp/htdocs/Projeto-barbearia/nav.php';
            echo navBar();
            ?>

        </header>

        <div class="table-responsive d-flex justify-content-center mt-3">

        

            <table class="table table-striped" style="width: 70%;border-radius: 3px; overflow:hidden;">

                <thead class="table-dark">

                    <tr>
                        <th>
                            <div class="d-flex justify-content-center">

                                <a href="cadastroFuncionario.php" class="btn btn-success  mb-1 mt-1  " style=" line-height: 0.5;  font-size: 1.2em; font-family: Arial, sans-serif;">
                                    Adicionar &#10012;</a>

                            </div>
                        </th>
                        <!--<th class="text-center">Código</th> -->
                        <th>Nome</th>
                        <th class="text-center ">Valor</th>
                        <th class="text-center">Tempo Estimado</th>


                        <th colspan="2" class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    function horaMin02($qqdata){
                        if ($tempdata=substr($qqdata,0,2) == 00) {
                            $tempdata=substr($qqdata,0,0).''.
                                substr($qqdata,3,2).' Minutos';
                            return($tempdata);
                        } else {
                            $tempdata=substr($qqdata,1,1).'h '.
                            substr($qqdata,3,2).'min';
                            return($tempdata);
                        }
                    }

                    $fcTable = new servicosController();
                    $listaServicos = $fcTable->listarServicos();
                    $a = 0;
                    if ($listaServicos != null) {
                        foreach ($listaServicos as $ls) {
                            $a++;
                            
                            
                    ?>      
                            <tr class=" align-middle" >
                                <td class="text-center">#</td>
                                <!--<td class="text-center " ></td> -->
                                <td style="width: 25%"><?php print_r($ls->getNomeServico()); ?></td>
                                <td class="text-center "><?php print_r($ls->getValorServico()); ?></td>
                                <td class="text-center"><?php print_r(horaMin02(($ls->getTempoServico()))); ?></td>


                                <td class=" d-flex justify-content-center"> <button type="button" class="btn btn-outline-warning" data-modal-title="<?php $sm->getIdServicos() ?>" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $a; ?>" data-whatever="<?php echo $ls->getIdServicos(); ?>" data-whatevernome="<?php echo $ls->getNomeServico() ?>" data-whateveremail="<?php echo $ls->getValorServico() ?>" data-whateversexo="<?php echo $ls->getTempoServico(); ?>" style="color: black;">
                                        Editar</button>
                                    </form>

                                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $a; ?>" style="color: black; margin-left: 20px;">
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
                                                <label><strong>Deseja excluir o servico
                                                        <?php echo $ls->getNomeServico(); ?>?</strong></label>
                                                <input type="hidden" name="ide" value="<?php echo $ls->getIdServicos(); ?>">
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
                var recipient = <?php $ls->getIdServicos() ?> // Extract info from data-* attributes
                var recipientnome = <?php $ls->getNomeServico(); ?>
                var recipientemail = <?php $ls->getValorServico() ?>
                var recipientperfil = <?php $ls->getTempoServico() ?>

                //var recipientdetalhes = button.data('whateverdetalhes')
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var modal = $(this)

                modal.find('.modal-title').text('ID ' + recipient)
                modal.find('#id').val(recipient)
                modal.find('#nome').val(recipientnome)
                modal.find('#email').val(recipientemail)
                modal.find('#perfil').val(recipientperfil)


            })
        </script>

        <div class="copyrightText">
            <p>Copyright 2021 <a href="#">Senac</a>. Todos os Direitos Reservados</p>
        </div>

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
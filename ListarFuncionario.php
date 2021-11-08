    <?php
    $directory = 'C:/xampp/htdocs/Projeto-barbearia/cadastroFuncionario.php';

    ob_start();
    session_start();

    if ((!isset($_SESSION['emailc']) || !isset($_SESSION['nomec']))
        || !isset($_SESSION['nr']) ||
        ($_SESSION['nr'] != $_SESSION['conferenr'])
    ) {
        header("Location: sessionDestroy.php");
        exit;
    }

    include_once 'C:/xampp/htdocs/Projeto-barbearia/controller/funcionarioController.php';
   __DIR__ . "/./model/Usuario.php";
   __DIR__ . "/./Projeto-barbearia/model/mensagem.php";
   __DIR__ . "/./Projeto-barbearia/bd/banco.php";

    //usar isso--> require_once __DIR__ . "/../model/Usuario.php"
    $ce = new Usuario();
    $msg = new Mensagem();
    ?>
    <?php
    include_once 'C:/xampp/htdocs/Projeto-barbearia/bd/banco.php';
    //$result_funcionarios = "SELECT * FROM usuario";
    //$resultado_funcionarios = mysqli_query($conn, $result_funcionarios);
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

        ?>

        <header>
            <a href="#" class="logo">Barbearia Neves<span>.</span></a>
            <?php
            include_once 'C:/xampp/htdocs/Projeto-barbearia/nav.php';
            echo navBar();
            ?>

        </header>

        
        <section>
        
        <a href="cadastroFuncionario.php" class="btn btn-success p-6">
                                        Novo funcionario</a>               
            <table class="table table-striped" style="border-radius: 3px; overflow:hidden;">
                <thead class="table-dark">
                    <tr>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>Perfil</th>
                        <th>E-Mail</th>
                        <th>Sexo</th>
                        <th>Telefone</th>

                        <th colspan="2" class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $fcTable = new funcionarioController();
                    $listaClientes = $fcTable->listarFuncionario();
                    $a = 0;
                    if ($listaClientes != null) {
                        foreach ($listaClientes as $lc) {
                            $a++;
                    ?>
                            <tr>
                                <td><?php print_r($lc->getId()); ?></td>
                                <td><?php print_r($lc->getNome()); ?></td>
                                <td><?php print_r($lc->getPerfil()); ?></td>
                                <td><?php print_r($lc->getEmail()); ?></td>
                                <td><?php print_r($lc->getSexo()); ?></td>
                                <td><?php print_r($lc->getTelefone()); ?></td>

                                <td><a href="cadastroFuncionario.php?id=<?php echo $lc->getId(); ?>" class="btn btn-warning">
                                        Editar</a>
                                    </form>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $a; ?>">
                                        Excluir</button>
                                </td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal<?php echo $a; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="">
                                                <label><strong>Deseja excluir o funcionário?
                                                        <?php echo $lc->getNome(); ?>?</strong></label>
                                                <input type="hidden" name="ide" value="<?php echo $lc->getId(); ?>">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" name="excluir" class="btn btn-primary">Sim</button>
                                            <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
                                        </div>
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
        </section>





        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">Curso</h4>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="http://localhost/solucao/processa.php" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Nome:</label>
                                <input name="nome" type="text" class="form-control" id="recipient-name">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Detalhes:</label>
                                <textarea name="detalhes" class="form-control" id="detalhes"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label"></label>
                                <textarea name="detalhes" class="form-control" id="detalhes"></textarea>
                            </div>
                            <input name="id" type="hidden" class="form-control" id="id-curso" value="">

                            <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-danger">Alterar</button>

                        </form>
                    </div>

                </div>
            </div>
        </div>


        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
        <script type="text/javascript">
            $('#exampleModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var recipient = button.data('whatever') // Extract info from data-* attributes
                var recipientnome = button.data('whatevernome')
                var recipientdetalhes = button.data('whateverdetalhes')
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var modal = $(this)
                modal.find('.modal-title').text('ID ' + recipient)
                modal.find('#id-curso').val(recipient)
                modal.find('#recipient-name').val(recipientnome)
                modal.find('#detalhes').val(recipientdetalhes)

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

        <a class="whatsapp-link" href="https://web.whatsapp.com/send?phone=559891355162" target="_blank">
            <i class="fa fa-whatsapp"></i>
        </a>
    </body>
    </head>

    </html>

    <?php ob_end_flush(); ?>
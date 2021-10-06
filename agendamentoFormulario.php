<?php
ob_start();
session_start();

if((!isset($_SESSION['emailc']) || !isset($_SESSION['nomec'])) 
    || !isset($_SESSION['nr']) || 
    ($_SESSION['nr'] != $_SESSION['conferenr'])) { 
    header("Location: sessionDestroy.php");
    exit;
}

$data = $_SESSION['dataAgendamento'];

// Chamando o id da associativa de servicos para poder usar para inserir
$servico = null;
$servico2 = null;


include_once 'C:/xampp/htdocs/Calendario/controller/agendamentoController.php';
include_once 'C:/xampp/htdocs/Calendario/dao/daoAgendamento.php';
include_once 'C:/xampp/htdocs/Calendario/model/agendamento_model.php';

$dt = new Agendamento();
$dts = new AgendamentoController();

include_once 'C:/xampp/htdocs/Calendario/bd/banco.php';

include_once 'C:/xampp/htdocs/Calendario/model/servicos_has_funcionarios.php';
include_once 'C:/xampp/htdocs/Calendario/controller/servicos_has_funcionariosController.php';
$serv = new Servicos_has_funcionariosController();

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width. initial-scale=1.0">
    <title>💈 Barbearia Neves 💈</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/Estilo_Calend.css">
    <link rel="stylesheet" href="/css/Style-Agend.css">

    <!-- CSS only -->
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
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

<body style="border: 2px solid #000000; background-color: #333;">
    <header>
        <a href="./index.html" class="logo">Barbearia Neves<span>.</span></a>
        <div class="menuToggle" onclick=" toggleMenu();"></div>
        <ul class="navigation">
            <li><a href="#banner" onclick=" toggleMenu();">Home</a></li>
            <li><a href="#about" onclick=" toggleMenu();">Sobre</a></li>
            <li><a href="#menu" onclick=" toggleMenu();">Cortes</a></li>
            <li><a href="#salao" onclick=" toggleMenu();">Salão</a></li>
            <li><a href="#feedbacks" onclick=" toggleMenu();">Feedbacks</a></li>
            <li><a href="#contato" onclick=" toggleMenu();">Contato</a></li>
        </ul>
    </header>

    <?php

    if (isset($_POST['cancelar'])) {
        header("Location: index.php");
    }

    if (isset($_POST['enviar'])) {
        $dataA = $_POST['data_agendamento'];
            $horario = $_POST['dataInicio'];
            $dataA = $_POST['data_agendamento'];
            $funcionario = $_POST['id_funcionarios'];
            $funcionario2 = $_POST['id_funcionarios2'];

            $servico = $_SESSION['agendamentoServico'];
            $servico2 = $_SESSION['agendamentoServico2'];
                
                //$dts = new AgendamentoController();
                //unset($_POST['enviar']);
                //$msg = $dts->inserirDataAgendamento($dataA, $horario);

            echo " <p style='color: white;'>-: $dataA, $horario, servico 01: $servico, $funcionario -- servico 02:  $servico2, $funcionario2 </p>";
                //echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"0;
                        //URL='http://localhost/Calendario/agendamentoFormulario.php'\">";
            
        
    }

    ?>

    <form method="POST" action="" class="agendamento" id="agendamento" style="background-color: #333;">
        <div class="card-body" style="background-color: #333;">
            <div class="card-header tituloAgend">
                Escolha entre os serviços e preencha os campos disponíveis
            </div><br>
            <div id="myList">
                <li>
                    <div class="row" >
                        <div class="col-md-3"></div>
                        <div class="col-md-3 funcionario">
                            <label style="padding: 5px; font-size: 18px; color: white "><strong>Serviços</strong></label>
                            <select name="id_servicos" id="id_servicos" class="form-control">
                                
                                    <option value="">Escolher serviço</option>
                                <?php
                                $result_post = "select * from servicos_do_funcionario "
                                    . "left join servicos on servicos.id = servicos_do_funcionario.servicos_id "
                                    . "order by nome";
                                $resultado_post = mysqli_query($conn, $result_post);
                                while ($row_post = mysqli_fetch_assoc($resultado_post)) {
                                    echo '<option value="' . $row_post['id'] . '">' . $row_post['nome'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-md-3 funcionario">
                            <label style="padding: 5px; font-size: 18px; color: White"><strong>Funcionarios
                                    </strong></label>
                            <label class="cliqueAqui" style="color: White; position: relative; font-size: 14px; margin-left: 5px;">
                                    Clique aqui.&#9660;</label>
                            <select name="id_funcionarios" id="id_funcionarios" class="form-control">
                                <option value="">Escolher Funcionario</option>
                            </select>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="row" >
                        <div class="col-md-3"></div>
                        <div class="col-md-3 funcionario">
                            <label style="padding: 5px; font-size: 18px; color: white "><strong>Serviços</strong></label>
                            <select name="id_servicos2" id="id_servicos2" class="form-control">
                                
                                    <option value="">Escolher serviço</option>
                                <?php
                                $result_post = "select * from servicos_do_funcionario "
                                    . "left join servicos on servicos.id = servicos_do_funcionario.servicos_id "
                                    . "order by nome";
                                $resultado_post = mysqli_query($conn, $result_post);
                                while ($row_post = mysqli_fetch_assoc($resultado_post)) {
                                    echo '<option value="' . $row_post['id'] . '">' . $row_post['nome'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-md-3 funcionario">
                            <label style="padding: 5px; font-size: 18px; color: White"><strong>Funcionarios
                                    </strong></label>
                            <label class="cliqueAqui2" style="color: White; position: relative; font-size: 14px; margin-left: 5px;">
                                    Clique aqui.&#9660;</label>
                            <select name="id_funcionarios2" id="id_funcionarios2" class="form-control">
                                <option value="">Escolher Funcionario</option>
                            </select>
                        </div>
                    </div>
                </li>
            </div>

            <div class="row">
                <div class="col-md-2 offset-5" id="loadMore">&#8606; Adicionar serviço &#8608;</div>
                <div class="col-md-2 offset-5" id="showLess">mostrar menos</div>
            </div>
                <div id="modar3">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="row formulario">
                            <!-- Lado esquerdo do Formulário 2prt -->
                            <div class="col-md-6 p-4">
                                <div class="campoForm2">
                                    <label for="nome">Nome/Usuário: </label><br>
                                    <input type="text" id="nome" name="nome" value="<?php echo $_SESSION['nomec'];?>" disabled><br>
                                </div>
                                <div class="campoForm2">
                                    <label for="telefone">Telefone: </label><br>
                                    <input type="text" id="telefone" name="telefone" value="testTelefone" disabled><br>
                                </div>
                                <div class="campoForm2">
                                    <label for="email">E-mail: </label><br>
                                    <input type="text" id="email" name="email" value="<?php echo $_SESSION['emailc'];?>" disabled><br>
                                </div>
                            </div>

                            <!-- Lado direito do Formulário 2prt -->

                            <div class="col-md-6 p-4" style="margin-top: -35px;">
                                <div class="campoForm2">
                                    <div class="barreira"></div>
                                    <Label>Data de Agendamento:</Label><br>
                                    <input type="date" name="data_agendamento" value="<?php echo $data ?>">
                                </div>

                                <div class="campoForm2">
                                    <Label>Início do Serviço:</Label><br>
                                    <input type="time" name="dataInicio" value="<?php $timestamp = mktime(10,00); echo date('h:i', $timestamp);?>">
                                </div>

                                <div class="campoForm2">
                                    <Label>Fim do Serviço:</Label><br>
                                    <input type="time" name="dataFim" value="<?php $timestamp = mktime(10,30); echo date('h:i', $timestamp);?>" disabled>
                                </div>

                            </div>
                            <div class="footer" style="background-color: #fff;">
                                <button type="submit" class="btn efeito-btn" name="enviar" id="enviar">Fazer agendamento</button>
                                <button type="submit" class="btn btn-secondary" name="cancelar">Cancelar Agendamento</button>
                            </div>
                        </div>
                    </div>
                </div>
    </form>

    <link rel="stylesheet" href="./css/Style-Agend.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="Js/bootstrap.min.js"></script>
    <script type="text/javascript">

    //Essa função chamas as variáveis do HTML do Form e logo trabalha para poder juntar os selects
    //o script manda para o outro arquivo que retorna um valor desejado para o front-end
    //selects com interação.
    //Esolher Serviços --> Function --> id($result_post, $row_post) --> agendamentoFormularioSub.php -->
    // $funcionario_post[] = array --> nome(NomeFuncionario) --> select(Escolha Funcionario-->Nome do Funcionario);
		$(function(){
			$('#id_servicos').change(function(){
				if( $(this).val() ) {
					$('#id_funcionarios').hide(); 
					$('.cliqueAqui').show(); 

					$.getJSON('agendamentoFormularioSub.php?search=',{id_servicos: $(this).val(), ajax: 'true'}, function(j){
						var options = '<option value="">Escolher Funcionario</option>';	
						for (var i = 0; i < j.length; i++) {
							options += '<option value="' + j[i].id + '">' + j[i].nome + '</option>';
						}	
						$('#id_funcionarios').html(options).show();
						$('.cliqueAqui').hide();
                    
					});
				} else {
					$('#id_funcionarios').html('<option value="">– Escolher Funcionario –</option>');
				}
			});
        });

        $(function(){
            $('#id_servicos2').change(function(){
				if( $(this).val() ) {
                    $('#id_funcionarios2').hide();
                    $('.cliqueAqui2').show();

					$.getJSON('agendamentoFormularioSub2.php?search=',{id_servicos2: $(this).val(), ajax: 'true'}, function(j){
						var options = '<option value="">Escolher Funcionario</option>';	
						for (var i = 0; i < j.length; i++) {
							options += '<option value="' + j[i].id + '">' + j[i].nome + '</option>';
						}	
						$('#id_funcionarios2').html(options).show();
						$('.cliqueAqui2').hide();
                    
					});
				} else {
					$('#id_funcionarios2').html('<option value="">– Escolher Funcionario –</option>');
				}
			});
		});
	</script>

    <script>
        $(document).ready(function () {
            size_li = $("#myList li").size();
            x=1;
            $('#myList li:lt('+x+')').show();
            $('#loadMore').click(function () {
                x= (x+1 <= size_li) ? x+1 : size_li;
                $('#myList li:lt('+x+')').show();
                $('#showLess').show();
                if(x == size_li){
                    $('#loadMore').hide();
                }
            });
            $('#showLess').click(function () {
                x=(x-1<0) ? 1 : x-1;
                $('#myList li').not(':lt('+x+')').hide();
                $('#loadMore').show();
                $('#showLess').show();

                $('#id_funcionarios2').html('<option value="">– Escolher Funcionario –</option>');
                if(x == 2){
                    $('#showLess').hide();
                }
            });
        });
    </script>
    <script src="Js/Agendamento.js"></script>
    <script src="Js/Calendario.js"></script>
</body>
</head>

</html>
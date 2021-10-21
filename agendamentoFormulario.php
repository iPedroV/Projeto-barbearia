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
$dataForm = $_SESSION['dataAgendamentoFormatado'];

// Chamando o id da associativa de servicos para poder usar para inserir
$servico = null;
$servico2 = null;


include_once 'C:/xampp/htdocs/testProjeto/controller/agendamentoController.php';
include_once 'C:/xampp/htdocs/testProjeto/dao/daoAgendamento.php';
include_once 'C:/xampp/htdocs/testProjeto/model/agendamento_model.php';

$dt = new Agendamento();
$dts = new AgendamentoController();

include_once 'C:/xampp/htdocs/testProjeto/bd/banco.php';

?>
<!DOCTYPE html>
<html lang="pt-br">
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
        <a href="./agendamento.php" class="logo">&#8656; Voltar<span>.</span></a>
    </header>

    <?php

    if (isset($_POST['voltar'])) {
        header("Location: agendamento.php");
    }

    if (isset($_POST['enviar'])) {
        $servico = $_POST['id_servicos'];
        $funcionario = $_POST['id_funcionarios'];
        if($servico == null){
            ?>
                <script>
                    Swal.fire({
                        title: 'Por favor, escolha um serviço',
                        text: 'para continuar o agendamento é nescessário escolher um serviço primeiro',
                        icon: 'warning',
                        confirmButtonText: 'Ok'
                    })
                </script>
            <?php    
        } else if($funcionario == null){
            ?>
            <script>
                Swal.fire({
                    title: 'Por favor, escolha um funcionario',
                    text: 'para continuar o agendamento é nescessário escolher um funcionario',
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                })
            </script>
        <?php    
        } else {
            $data;
            $idUsuario = $_SESSION['idc']; 
            
            //$servico = $_SESSION['agendamentoServico'];
            $_SESSION['funcionario'] = $funcionario;
            $servico = $_SESSION['servico'];

            $valor1 = $_POST['valor01'];
            $funcionarioN = $_POST['nomeFuncionario'];
            $_SESSION['nomeFuncionarioFormulario'] = $_POST['nomeFuncionario'];
               
            echo " <p style='color: white;'>- idUsuário: $idUsuario, $funcionarioN </p>";
            echo " <p style='color: white;'>- Data Escolhida: $data <br><br>-: servico 01 :==> $servico, $funcionario valor: R$$valor1 </p>";
            

            $valorTotal = $valor1;
            echo " <p style='color: white;'>- valor Total a pagar: $valorTotal </p>";
            $_SESSION['agendamentoServicoValor'] = $valorTotal;

            $funcionarioN2 = $_POST['nomeFuncionario2'];
            if($funcionarioN2 != null){
                $_SESSION['nomeFuncionarioFormulario2'] = $_POST['nomeFuncionario2'];
                $funcionario2 = $_POST['id_funcionarios2'];
                $_SESSION['funcionario2'] = $_POST['id_funcionarios2'];
                $servico2 = $_SESSION['servico2'];
                $valor2 = $_POST['valor02'];
                echo " <p style='color: white;'>-: servico 02 :==>  $servico2, $funcionario2 valor: R$$valor2 </p>";

                $valorTotal = $valor1 + $valor2;
                echo " <p style='color: white;'>- valor Total a pagar: $valorTotal </p>";
                $_SESSION['agendamentoServicoValor'] = $valorTotal;
            }

            header("Location: agendamentoFormulario2.php");
            
        }
                  
    }

    ?>

    <form method="POST" action="" class="agendamento" id="agendamento" style="background-color: #333;">
        <div class="card-body" style="background-color: #333;">
            <div class="card-header tituloAgend">
                Escolha entre os serviços
            </div><br>
            <div id="myList">
                <li>
                    <div class="row" >
                    <label style="color: white; margin-bottom: 10px;">Obs: Pode ser selecionado apenas um serviço para realizar o agendamento.</label><br>
                    <div class="col-md-2"></div>
                        <div class="col-md-4 servico">
                            <label style="padding: 5px; font-size: 18px; color: white; "><strong>Serviços</strong></label>
                            <select name="id_servicos" id="id_servicos" class="form-control">
                                
                                    <option value="">Escolher serviço</option>
                                <?php
                                $result_post = "select DISTINCT nome, idServicos from servicos_do_funcionario "
                                    . "left join servicos on servicos.idServicos = servicos_do_funcionario.servicos_id "
                                    . "order by nome";
                                $resultado_post = mysqli_query($conn, $result_post);
                                while ($row_post = mysqli_fetch_assoc($resultado_post)) {
                                    echo '<option value="' . $row_post['idServicos'] . '">' . $row_post['nome'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-md-1"></div>

                        <div class="col-md-4 funcionario">
                            <label style="padding: 5px; font-size: 18px; color: White; text-align: end;"><strong>Funcionarios
                                    </strong></label>
                            <select name="id_funcionarios" id="id_funcionarios" class="form-control">
                                <option>Selecionar Serviço</option>
                            </select>
                        </div>

                        <div class="col-md-1"></div>
                    </div>
                </li>
                <li>
                    <div class="row" >
                    <div class="col-md-2"></div>
                        <div class="col-md-4 servico2">
                            <label style="padding: 5px; font-size: 18px; color: white "><strong>Serviços 2</strong></label>
                            <select name="id_servicos2" id="id_servicos2" class="form-control" >
                                <option value=""></option>
                            </select>
                        </div>

                        <div class="col-md-1"></div>

                        <div class="col-md-4 funcionario2">
                            <label style="padding: 5px; font-size: 18px; color: White"><strong>Funcionarios
                                    </strong></label>
                            <select name="id_funcionarios2" id="id_funcionarios2" class="form-control">
                                <option>Selecionar Serviço 2</option>
                            </select>
                        </div>
                        <div class="col-md-1"></div>
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
                            <div class="col-md-12 offset-2">
                                <div class="campoFormData">
                                    <div class="barreira"></div>
                                    <Label>Data de Agendamento:</Label><br>
                                    <!--<input type="date" name="data_agendamento" value="<?php echo $data ?>">-->
                                    <input type="text" name="data_agendamentoFormatado" value="<?php echo $dataForm ?>">
                                </div>
                            </div>

                            <div class="col-md-12 offset-12" style="border-bottom: 3px solid white; margin-bottom: -17px;"></div>

                            <div class="col-md-6 p-4">
                                <div class="campoForm2" style="text-align: center;">
                                    <input type="text" class="parte01" name="nome" value="Dados dos Serviços 01" style="color: white; font-size: 22px; width: 100%; 
                                        padding-bottom: 10px; padding-top: 10px; margin-top: -9px;" disabled>
                                    <select id="nomeServico" name="nomeServico" class="form-control" >
                                        <option></option>
                                    </select>
                                    <br>
                                
                                    <select name="valor01" id="valorServico" class="form-control" >
                                        <option style="text-align: center;">... Aguardando ...</option>
                                    </select>

                                    <select name="tempo01" id="tempoServicoForm" class="form-control" >
                                        <option></option>
                                    </select><br>
                                   
                                    <label class="nomeFunc">Funcionario: </label><br>
                                    <select name="nomeFuncionario" id="nomeFuncionario" class="form-control" >
                                        <option></option>
                                    </select><br>

                                    <div class="barreiraServico"></div>
                                </div>
                            </div>

                            <!-- DIVISÃO DE SERVIÇOS -->

                            <div class="col-md-6 p-4" style="margin-top: 0px;">
                                <div class="campoForm2" style="text-align: center;">
                                    <input type="text" class="parte01" name="nome" value="Dados dos Serviços 02" style="color: white; font-size: 22px; width: 100%; 
                                        padding-bottom: 10px; padding-top: 10px; margin-top: -9px;" disabled>
                                    <select id="nomeServico2" name="nomeServico2" class="form-control" >
                                        <option></option>
                                    </select><br>
                                
                                    <select name="valor02" id="valorServico2" class="form-control" >
                                        <option style="text-align: center;">...</option>
                                    </select>

                                    <select name="tempo02" id="tempoServicoForm2" class="form-control" >
                                        <option></option>
                                    </select><br>
                                    
                                    <label class="nomeFunc">Funcionario: </label><br>
                                    <select name="nomeFuncionario2" id="nomeFuncionario2" class="form-control" >
                                        <option></option>
                                    </select><br>

                                    <div class="barreiraServico2"></div>
                                </div>
                            </div>

                            <div class="col-md-12 offset-12" style="border-bottom: 3px solid white; margin-bottom: 15px; margin-top: 20px;"></div>

                            <div class="footer" style="background-color: #fff;">
                                
                                <button type="submit" class="btn btn-secondary" name="voltar">&#8666; Voltar</button>
                                <button type="submit" class="btn efeito-btn" name="enviar" id="enviar">Avançar &#8667;</button>
                            </div>
                        </div>
                    </div>
                </div>
    </form>

    <link rel="stylesheet" href="./css/Style-Agend.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="Js/bootstrap.min.js"></script>
    <script type="text/javascript" charset="utf-8">


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
						var options = "<option value=''>Escolher Funcionario</option>";	
						var optionsV = "";	
						for (var i = 0; i < j.length; i++) {
							options += '<option value="' + j[i].id + '">' + j[i].nome + '</option>';
							optionsV += '<option value="' + j[i].nome + '">' + j[i].nome + '</option>';
						}	

						$('#id_funcionarios').html(options).show();
						$('#id_funcionariosForm').html(optionsV).show();
						$('.cliqueAqui').hide();
                    
					});

                    $.getJSON('agendamentoFormularioValorServico.php?search=',{id_servicos: $(this).val(), ajax: 'true'}, function(j){
                        var optionsV = '';
                        var optionsV2 = '';
                        var optionsV3 = '';
						for (var i = 0; i < j.length; i++) {
							optionsV += '<option value="' + j[i].valor + '">R$ ' + j[i].valor + ',00</option>';
							optionsV2 += '<option value="' + j[i].nome + '">' + j[i].nome + '</option>';
							optionsV3 += '<option value="' + j[i].tempo_estimado + '">Tempo: ' + j[i].tempo_estimado + '</option>';
						}	
						$('#valorServico').html(optionsV).show();
						$('#tempoServicoForm').html(optionsV3);
                        $('#nomeServico').html(optionsV2).show();
					});

                    $.getJSON('agendamentoFormularioServico2.php?search=',{id_servicos: $(this).val(), ajax: 'true'}, function(j){
						var options = '<option value="">Escolher serviço</option>';	
						for (var i = 0; i < j.length; i++) {
							options += '<option value="' + j[i].idServicos + '">' + j[i].nome + '</option>';
                            
						}	
						$('#id_servicos2').html(options).show();
                    
					});
				} else {
					$('#id_funcionarios').html('<option value="">– Escolher Funcionario –</option>');
				}
			});
        });

        //https://desarrolloweb.com/articulos/codificar-decodificar-cadenas-utf8-javascript.html
        $(function(){
            $('#id_servicos2').change(function(){
				if( $(this).val() ) {
                    $('#id_funcionarios2').hide();
                    $('#valorServico2').hide();
                    $('.cliqueAqui2').show();

					$.getJSON('agendamentoFormularioSub2.php?search=',{id_servicos2: $(this).val(), ajax: 'true'}, function(j){
						var options = "<option value=''>Escolher Funcionario</option>";	
						for (var i = 0; i < j.length; i++) {
							options += '<option value="' + j[i].id + '">' + j[i].nome + '</option>';
						}	
						$('#id_funcionarios2').html(options).show();
						$('.cliqueAqui2').hide();
                    
					});

                    $.getJSON('agendamentoFormularioValorServico2.php?search=',{id_servicos2: $(this).val(), ajax: 'true'}, function(h){
                        var optionsV = '';
                        var optionsV2 = '';
                        var optionsV3 = '';
						for (var i = 0; i < h.length; i++) {
							optionsV += '<option value="' + h[i].valor + '">R$ ' + h[i].valor + ',00</option>';
							optionsV2 += '<option value="' + h[i].nome + '">' + h[i].nome + '</option>';
							optionsV3 += '<option value="' + h[i].tempo_estimado + '">Tempo: ' + h[i].tempo_estimado + '</option>';
						}	
						$('#valorServico2').html(optionsV).show();
						$('#tempoServicoForm2').html(optionsV3).show();
                        $('#nomeServico2').html(optionsV2).show();
                    
					});

				} else {
					$('#id_funcionarios2').html('<option value="">– Escolher Funcionario –</option>');
				}
			});
		});

        $(function(){
            $('#id_funcionarios').change(function(){
				if( $(this).val() ) {
                    $('#id_funcionarios').hide();

					$.getJSON('agendamentoFormularioFuncionario.php?search=',{id_funcionarios: $(this).val(), ajax: 'true'}, function(j){
						var options = "";	
						var optionsV = '<option value="">Escolher Serviço</option>';	
						for (var i = 0; i < j.length; i++) {
							options += '<option value="' + j[i].nome + '">' + j[i].nome + '</option>';
							optionsV += '<option value="' + j[i].id + '">' + j[i].nome + '</option>';
						}	

						$('#nomeFuncionario').html(options).show();
                        //$('#id_funcionarios').html(optionsV).show();
                        //location.reload();
					});

                    

				} else {
					$('#id_funcionarios').html('<option value="">– Escolher Funcionario –</option>');
				}
			});

            $('#id_funcionarios2').change(function(){
				if( $(this).val() ) {
                    $('#id_funcionarios2').hide();

					$.getJSON('agendamentoFormularioFuncionario.php?search=',{id_funcionarios: $(this).val(), ajax: 'true'}, function(j){
						var options = "";	
						for (var i = 0; i < j.length; i++) {
							options += '<option value="' + j[i].nome + '">' + j[i].nome + '</option>';
						}	

						$('#nomeFuncionario2').html(options);
						//$('#id_funcionarios2').html(options).show();
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
                $('#valorServico2').html('<option value="">0</option>');
                if(x == 2){
                    //$('#showLess').hide();
                }
            });
        });
    </script>
    <script src="Js/Agendamento.js"></script>
    <script src="Js/testProjeto.js"></script>
</body>
</head>

</html>
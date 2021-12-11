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

if ($data == "") {
    echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"0;
            URL='http://localhost/Projeto-barbearia/agendamento_ClienteDados.php'\">";
}
// Chamando o id da associativa de servicos para poder usar para inserir
$servico = null;
$servico2 = null;


include_once 'C:/xampp/htdocs/Projeto-barbearia/controller/agendamentoController.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/dao/daoAgendamento.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/agendamento_model.php';

$dt = new Agendamento();
$dts = new AgendamentoController();

require_once __DIR__ . "/bd/banco.php";

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

<body style="border-top: 2px solid #000000; background-color: #333;">
    <header>
        <a href="./agendamento.php" class="logo">&#8656; Voltar<span>.</span></a>
    </header>

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
                            <select name="id_servicos" id="id_servicos" class="form-control" >
                                
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
                            <select name="id_funcionarios" id="id_funcionarios" class="form-control" onclick="mascaraVal()">
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
                                <option value="">Escolher serviço</option>
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
                <div class="col-md-2 offset-5" id="showLess">Remover serviço 2</div>
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

                            <!-- DIVISÃO DE SERVIÇOS -->

                            <div class="col-md-12 offset-12" style="border-bottom: 2px solid white; margin-bottom: -15px;"></div>
                            <div class="col-md-12 offset-12">
                                <div class="campoFormHorario">
                                    <label>Escolha o Horário &nbsp;</label>
                                </div>
                            </div>
                            <div class="col-md-12 offset-12" style="border-bottom: 2px solid white; margin-bottom: -15px;"></div>

                            <div class="col-md-6 p-4" style="align-items: center; text-align: center;">
                                <button name="horarioAgend" id="btnHorario" onclick="horario()" type="button" class="btn btn-outline-secondary" style="margin-bottom: 10px; margin-top: 20px;"><span style="color: white;">08:00</span></button>
                                <button name="horarioAgend" id="btnHorario2" onclick="horario2()" type="button" class="btn btn-outline-secondary" style="margin-bottom: 10px;"><span style="color: white;">08:45</span></button>
                                <button name="horarioAgend" id="btnHorario3" onclick="horario3()" type="button" class="btn btn-outline-secondary" style="margin-bottom: 10px;"><span style="color: white;">09:30</span></button>
                                <button name="horarioAgend" id="btnHorario4" onclick="horario4()" type="button" class="btn btn-outline-secondary" style="margin-bottom: 10px;"><span style="color: white;">10:15</span></button>
                                <button name="horarioAgend" id="btnHorario5" onclick="horario5()" type="button" class="btn btn-outline-secondary" style="margin-bottom: 10px;"><span style="color: white;">11:00</span></button>
                                <label class="almoco">Agendamento Fechado das <br><span>12h ás 14h</span></label> 
                            </div>

                            <!-- DIVISÃO DE SERVIÇOS --> 
                            
                            <div class="col-md-6 p-4" style="align-items: center; text-align: center;">
                                <button name="horarioAgend" id="btnHorario6" onclick="horario6()" type="button" class="btn btn-outline-secondary" style="margin-bottom: 10px; margin-top: 20px;"><span style="color: white;">14:00</span></button>
                                <button name="horarioAgend" id="btnHorario7" onclick="horario7()" type="button" class="btn btn-outline-secondary" style="margin-bottom: 10px;"><span style="color: white;">14:45</span></button>
                                <button name="horarioAgend" id="btnHorario8" onclick="horario8()" type="button" class="btn btn-outline-secondary" style="margin-bottom: 10px;"><span style="color: white;">15:30</span></button>
                                <button name="horarioAgend" id="btnHorario9" onclick="horario9()" type="button" class="btn btn-outline-secondary" style="margin-bottom: 10px;"><span style="color: white;">16:15</span></button>
                                <button name="horarioAgend" id="btnHorario10" onclick="horario10()" type="button" class="btn btn-outline-secondary" style="margin-bottom: 10px;"><span style="color: white;">17:00</span></button>
                                <button name="horarioAgend" id="btnHorario11" onclick="horario11()" type="button" class="btn btn-outline-secondary" style="margin-bottom: 10px;"><span style="color: white;">17:45</span></button>
                            </div>

                            <div class="col-md-12 offset-12" style="border-bottom: 2px solid white; margin-bottom: 15px; margin-top: 10px;"></div>
                            <div class="col-md-12 offset-12">
                                <div class="campoFormHorario2">
                                    <label>Horário Escolhido &nbsp;&#8658;</label>
                                    <input type="time" name="horario_agendamento" id="horarioEscolhido" value="" >
                                </div>
                            </div>
                            <div class="col-md-12 offset-12" style="border-bottom: 2px solid white; margin-bottom: 30px; margin-top: -15px; position: relative;"></div>

                            <select name="valor01" id="valorServico" class="form-control" ></select>
                            <select name="tempoServico01" id="tempoServicoForm" class="form-control" ></select>
                            <select name="nomeServico01" id="nomeServico" class="form-control" ></select>

                            <select name="valor02" id="valorServico2" class="form-control" ></select>
                            <select name="tempoServico02" id="tempoServicoForm2" class="form-control" ></select>
                            <select name="nomeServico02" id="nomeServico2" class="form-control" style="color: transparent;"></select>

                            <div class="footer" style="background-color: #fff;">
                                
                                <button type="submit" class="btn btn-secondary" name="voltar">&#8666; Voltar</button>
                                <button type="submit" class="btn efeito-btn" name="enviar" id="enviar">Avançar &#8667;</button>
                            </div>
                        </div>
                    </div>
                </div>
    </form>

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
                        confirmButtonText: '<a>Ok</a>'
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
                    confirmButtonText: '<a>Ok</a>'
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
            $tempoServ1 = $_POST['tempoServico01'];
            
            $servicoN = $_POST['nomeServico01'];
            $_SESSION['nome_Servico'] = $servicoN;
            //$_SESSION['nomeFuncionarioFormulario'] = $_POST['nomeFuncionario'];
               
            //echo " <p style='color: white;'>- idUsuário: $idUsuario, </p>";
            //echo " <p style='color: white;'>- Data Escolhida: $data <br><br>-: servico 01 :==> $servico, $servicoN, $funcionario valor: R$$valor1 </p>";
            

            $valorTotal = $valor1;
            $tempoTotal = $tempoServ1;
            //echo " <p style='color: white;'>- valor Total a pagar: $valorTotal </p>";
            //echo " <p style='color: white;'>- tempo Total: $tempoTotal </p><br>";
            $_SESSION['agendamentoServicoValor'] = $valorTotal;
            $_SESSION['agendamentoServicoTempo'] = $tempoTotal;

            $valor2 = "";
            $tempoServ2 = "";
            $servicoN2 = "";
            $funcionario2 = $_POST['id_funcionarios2'];
            if($funcionario2 != "Selecionar Serviço 2"){
                //$_SESSION['nomeFuncionarioFormulario2'] = $_POST['id_funcionarios2'];
                $funcionario2 = $_POST['id_funcionarios2'];
                $_SESSION['funcionario2'] = $_POST['id_funcionarios2'];
                $servico2 = $_SESSION['servico2'];
                $valor2 = $_POST['valor02'];
                $tempoServ2 = $_POST['tempoServico02'];

                $servicoN2 = $_POST['nomeServico02'];
                $_SESSION['nome_Servico2'] = $servicoN2;

                //echo " <p style='color: white;'>-: servico 02 :==>  $servico2, $servicoN2, $funcionario2 valor: R$$valor2 </p>";
                //echo " <p style='color: white;'>- valor Total a pagar: $valorTotal </p>";
                //echo " <p style='color: white;'>- tempo Total: $tempoServ2 </p>";
                $_SESSION['agendamentoServicoValor2'] = $valor2;
                $_SESSION['agendamentoServicoTempo2'] = $tempoServ2;
            } else {
                $_SESSION['agendamentoServicoValor2'] = 0;
                $_SESSION['funcionario2'] = "";
                $_SESSION['servico2'] = "";
                $_SESSION['nome_Servico2'] = "";
                $_SESSION['agendamentoServicoTempo2'] = "";
            }

            if ($servicoN2 == "Escolher serviço" && $funcionario2 != "Selecionar Serviço 2") {
                $_POST['valor02'] = 0;
                $_SESSION['agendamentoServicoValor2'] = 0;
            }
            

            $horario = $_POST['horario_agendamento'];
            date_default_timezone_set('America/Sao_Paulo');
            $data_atual = date('d/m/y');
            $hora_atual = date('H:i:s');
            if ($horario == null) {
                ?>
                        <script>
                            Swal.fire({
                                title: 'Escolha um horário para continuar',
                                text: 'O horário não foi selecionado. $hora_atual',
                                icon: 'warning',
                                confirmButtonText: '<a>Ok</a>'
                            })
                        </script>
                    <?php    
            } else if($horario < $hora_atual){
                    echo "<script>
                            Swal.fire({
                                title: 'Horário antecipado ao atual!',
                                text: 'Agende em um horário subsequente as $hora_atual',
                                icon: 'warning',
                                confirmButtonText: '<a>Ok</a>'
                            })
                        </script>";
            }
            else {
                $_SESSION['horarioAgendamento'] = $horario;

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

                // Metodo apra verfificar a Data e horário que estão sendo escolhidas pelo usuário
                //$result_usuario = "SELECT * FROM agendamentos WHERE data = '$data' AND horario = '$horario'";
                $result_usuario = "SELECT * FROM `agendamentos_dos_servicos` INNER JOIN agendamentos on agendamentos.idAgendamento = agendamentos_dos_servicos.agendamentos_id WHERE agendamentos.data = '$data' and agendamentos.horario = '$horario' and agendamentos_dos_servicos.sf_funcionario = '$funcionario'";
                $resultado_usuario = mysqli_query($conn, $result_usuario);
                while($row_usuario = mysqli_fetch_assoc($resultado_usuario)){
                    $row_usuario['idAgendamento'];
                    $row_usuario['data'];
                    $row_usuario['horario'];
                    $row_usuario['sf_funcionario'];

                    $dataBC = $row_usuario['data'];
                    $horarioBC = $row_usuario['horario'];

                    
                    if ($row_usuario['horario'] != null) {
                        
                        echo "<script>
                            Swal.fire({
                                title: 'Vaga Indisponível neste horário.',
                                text: 'Por favor escolha outro horário diferente de ".horaMin($horarioBC)." ou mude a data do agendamento. $dataForm.',
                                icon: 'error',
                                confirmButtonText: '<a>Ok</a>'
                            })
                        </script>";
                       
                    }   
                }

                $funcionario = $_POST['id_funcionarios'];
                $funcionarioN2 = $_POST['id_funcionarios2'];

                if ($dataBC == null && $horarioBC == null) {
                    if ($funcionario != "")  {
                        header("Location: agendamentoFormulario2.php");
                    } else if ($funcionario != "" && $funcionarioN2 != "") {
                        header("Location: agendamentoFormulario2.php");
                    } 
                } else {

                }
            }
        }     
    }

    ?>


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
						var options = '<option value="">Escolher Funcionario</option>';	
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
							optionsV3 += '<option value="' + j[i].tempo_estimado + '">' + j[i].tempo_estimado + '</option>';
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
						var options = '<option value="">Escolher Funcionario</option>';	
						for (var i = 0; i < j.length; i++) {
							options += '<option value="' + j[i].id + '">' + j[i].nome + '</option>';
						}	
						$('#id_funcionarios2').html(options).show();
						$('.cliqueAqui2').hide();
                    
					});

                    $.getJSON('agendamentoFormularioValorServico2.php?search=',{id_servicos2: $(this).val(), ajax: 'true'}, function(h){
                        var optionsV = '0';
                        var optionsV2 = '0';
                        var optionsV3 = '0';
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
                    optionsV = '0';
					$('#id_funcionarios2').html('<option value="">Selecionar Serviço 2</option>');
					$('#valorServico2').html(optionsV);
					$('#tempoServicoForm2').html(optionsV);
                    $('#nomeServico2').html(optionsV);
				}
			});
		});

	</script>

<script>
        function horario(){
            var horario = '08:00';
            document.getElementById('horarioEscolhido').value = horario;
        }
        function horario2(){
            var horario = '08:45';
            document.getElementById('horarioEscolhido').value = horario;
        }
        function horario3(){
            var horario = '09:30';
            document.getElementById('horarioEscolhido').value = horario;
        }
        function horario4(){
            var horario = '10:15';
            document.getElementById('horarioEscolhido').value = horario;
        }
        function horario5(){
            var horario = '11:00';
            document.getElementById('horarioEscolhido').value = horario;
        }
        function horario6(){
            var horario = '14:00';
            document.getElementById('horarioEscolhido').value = horario;
        }
        function horario7(){
            var horario = '14:45';
            document.getElementById('horarioEscolhido').value = horario;
        }
        function horario8(){
            var horario = '15:30';
            document.getElementById('horarioEscolhido').value = horario;
        }
        function horario9(){
            var horario = '16:15';
            document.getElementById('horarioEscolhido').value = horario;
        }
        function horario10(){
            var horario = '17:00';
            document.getElementById('horarioEscolhido').value = horario;
        }
        function horario11(){
            var horario = '17:45';
            document.getElementById('horarioEscolhido').value = horario;
        }
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

                $('#id_funcionarios2').html('<option value="">Selecionar Serviço 2</option>');
                $.getJSON('agendamentoFormularioServico2.php?search=',{id_servicos: $(this).val(), ajax: 'true'}, function(j){
						var options = '<option value="">Escolher serviço</option>';	
						for (var i = 0; i < j.length; i++) {
							options += '<option value="' + j[i].idServicos + '">' + j[i].nome + '</option>';
                            
						}	
						$('#id_servicos2').html(options).show();
                    
					});
                if(x == 1){
                    $('#showLess').hide();
                }
            });
        });
    </script>
    <script src="Js/Agendamento.js"></script>
    <script src="Js/Projeto-barbearia.js"></script>
</body>
</head>

</html>
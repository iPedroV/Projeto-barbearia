<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['msg'])) {
    $_SESSION['msg'] = "";
}
include_once 'C:/xampp/htdocs/Projeto-barbearia/controller/servicosController.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/controller/funcionarioController.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/mensagem.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/bd/banco.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/dao/DaoClientes.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/dao/daoIndex.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/Usuario.php';
include_once "C:/xampp/htdocs/Projeto-barbearia/model/servicos_model.php";
include_once 'C:/xampp/htdocs/Projeto-barbearia/enviar.php';
$ce = new Usuario();
$msg = new Mensagem();
$sm = new Servicos_model();
?>


<!DOCTYPE html>

<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cadastro Salão & Barbearia Neves</title>
    <link rel="stylesheet" href="./css/style-Funcionario.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font/awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">


    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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

    <div class="container">
        <div class="title"><span><b>C</b></span>adastro Funcionario</div>

        <?php

        //Fução do Token*
        //substr((time()), 0, 20 )

        $conn = new Conecta();
        $msg = new Mensagem();
        $conecta = $conn->conectadb();
        if (isset($_POST['cadastrar'])) {

            $telefone = str_replace("(", "", $_POST['telefone']);
            $telefone = str_replace(")", "", $telefone);
            $telefone = str_replace(" ", "", $telefone);
            $telefone = str_replace("-", "", $telefone);
            $senha = $telefone;
            if ($senha != "") {

                $nome = $_POST['nome'];
                $perfil = $_POST['cargo'];
                $email = $_POST['email'];
                $sexo = $_POST['sexo'];
                $token = $_POST['token'];
            }

            $cc = new FuncionarioController();
            unset($_POST['cadastrar']);
            /*precisa ta na MESMA ORDEM DO BANCO*/
            $resp = $cc->inserirFuncionario(
                $nome,
                $perfil,
                $telefone,
                $email,
                $senha,
                $sexo,
                $token
            );
            if($perfil == "Funcionario"){
                $resp3 = $cc->ultimoIdInserido();
                $s = $resp3->getId();
                $test[] = $_POST['check'];
                
                    
                    $resp2 = $cc->inserirFuncionarioAssociativa($test, $s);
                    print_r($resp2);
                
            }
            //print_r($s);
            if (getType($resp) == 'object') {
                $ce = $resp;
                echo "<p style='color: red;'>Email já cadastrado!</p>";
            } else {

                $msg = new Mensagem();
                $EmailEnviado = new FuncionarioController();
                $msg = $EmailEnviado->EnviarSenhaController();

                //echo $resp2;
                echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"2;
			    URL='../Projeto-Barbearia/ListarFuncionario.php'\">";
            }
        }

        ?>

        <form method="post" action="">
            <div class="detalhes-usuario">
                <div class="input-box">
                    <?php
                    if ($ce != null) {
                        echo $ce->getId();
                    ?>

                        <input type="hidden" name="idclientes" value="<?php echo $ce->getId() ?>">
                    <?php
                    }
                    ?>
                    <span>Nome Completo:</span>
                    <input type="text" placeholder="Digite seu nome" name="nome" required value="<?php echo $ce->getNome(); ?>">
                </div>

                <div class="input-box">
                    <span class="detalhes">Telefone Celular:</span>
                    <input id="tel" type="tel" placeholder="(xx)9xxxx-xxxx" name="telefone" maxlength="11" required value="<?php echo $ce->getTelefone(); ?>">
                </div>

                <div class="input-box">
                    <span class="detalhes">Cargo:</span>
                    <select name="cargo" id="cargo" class="select" required>
                    <option <?php
                                if ($ce->getPerfil() == "Funcionario") {
                                    echo "selected = 'selected'";
                                } ?>>Funcionario</option>
                        <option <?php
                                if ($ce->getPerfil() == "Administrador") {
                                    echo "selected = 'selected'";
                                } ?>>Administrador</option>

                        
                        <option <?php
                                if ($ce->getPerfil() == "Secretaria") {
                                    echo "selected = 'selected'";
                                } ?>>Secretaria</option>
                    </select>
                </div>



                <div class="input-box">
                    <span class="detalhes">Email:</span>
                    <input type="email" placeholder="Digite seu email" name="email" required value="<?php echo $ce->getEmail(); ?>">
                </div>
                
                <span class="detalhes">Serviços:</span><br>
                <?php  
                $scTable = new servicosController();
                $listaServicos = $scTable->listarServicos();
                $a = 0;
                if ($listaServicos != null) {
                    foreach ($listaServicos as $ls) {
                        $a++;
                ?>
                <div style="display: block;">
                    <input type="checkbox" name="check[]" checked value="<?php echo $ls->getIdServicos(); ?>">
                    <label ><?php echo $ls->getNomeServico(); ?><br></label>
                
                </div>
                <br>
                <?php
                    }
                }
                ?>

                <div class="input-box">
                    <input type="hidden" name="token" required value="<?php echo substr((time()), 0, 20) ?> <?php echo $ce->getToken(); ?>">
                </div>
                


            </div>
            <div class="genero">

                <input type="radio" name="sexo" id="ponto-1" value="Masculino" value="<?php echo $ce->getSexo(); ?>" <?php if ($ce->getSexo() != null) {
                                                                                                                            if ($ce->getSexo() == "Masculino") echo "checked = checked";
                                                                                                                        } ?> checked='checked' required>
                <input type="radio" name="sexo" id="ponto-2" value="Feminino" value="<?php echo $ce->getSexo(); ?>" <?php if ($ce->getSexo() != null) {
                                                                                                                        if ($ce->getSexo() == "Feminino") echo "checked = checked";
                                                                                                                    } ?>required>
                <span class="seu-genero">Gênero</span>
                <div class="categoria">
                    <label for="ponto-1">
                        <span class="ponto um"></span>
                        <span class="generoMas">Masculino</span>
                    </label>
                    <label for="ponto-2" name="sexo" value="Feminino">
                        <span class="ponto dois"></span>
                        <span class="generoMas" value="Feminino">Feminino</span>
                    </label>
                </div>
            </div>
            <div>
                <button type="submit" class="btn efeito-btn" name="cadastrar">Cadastrar</button>
            </div>
        </form>
    </div>


    <script>
        var telefone = document.querySelector('#tel');

        telefone.addEventListener('blur', (evento) => {
            verificaTelefone(evento.target);
        })

        var expTel = /(^\(?[0]?[1-9]{2}\)?)[.-\s]?([9]?[\s]?[1-9]\d{4})[.-\s]?(\d{4})$/g;

        function verificaTelefone(elemento) {
            var telValido = expTel.exec(elemento.value);
            var msgTel = '';

            if (!telValido) {
                msgTel = 'Insira um número de telefone válido com DDD e o 9';
            }

            elemento.setCustomValidity(msgTel);
            elemento.value = unificaTel(elemento.value);
        }

        function unificaTel(numero) {
            var telNum = numero.replace(/[().-\s]/g, ''); //limpa
            var telFormatado = telNum.replace(expTel,
                function(valorTel, ddd, prefixo, numero) {
                    var numeroFinal = '(' + ddd + ') ' + prefixo + '-' + numero;
                    return numeroFinal;
                })
            return telFormatado;
        }
    </script>
    <script>
        function toggle() {
            var x = document.getElementById("senha");
            if (x.type === "password") {
                x.type = "text";
                document.getElementById("risco").style.display = "inline-block";
                document.getElementById("olho").style.display = 'none';
                document.getElementById("risco").style.color = '#000000';
                document.getElementById("olho").style.color = '#000000';
            } else {
                x.type = "password";
                document.getElementById("risco").style.display = 'none';
                document.getElementById("olho").style.display = 'inline-block';
                document.getElementById("risco").style.color = '#000000';
                document.getElementById("olho").style.color = '#000000';
            }
        }
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

</html>
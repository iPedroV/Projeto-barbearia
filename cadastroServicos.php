<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['msg'])) {
    $_SESSION['msg'] = "";
}
include_once 'C:/xampp/htdocs/Projeto-barbearia/controller/servicosController.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/mensagem.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/bd/banco.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/dao/daoServicos.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/servicos_model.php';

$se = new Servicos_model();
$msg = new Mensagem();
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
    

    <meta name="viewport" content="width=devise-width, initial-scale=1.0">

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
        <div class="title"><span><b>C</b></span>adastro de Serviços</div>

        <?php
        $conn = new Conecta();
        $msg = new Mensagem();
        $conecta = $conn->conectadb();
        if (isset($_POST['cadastrar'])) {
    
                    $nome = $_POST['nome'];
                    $valor = $_POST['valor'];
                    $tempo = $_POST['tempo'];
                    
                

            $sc = new servicosController();
            unset($_POST['cadastrar']);
            $resp = $sc->inserirServicos(
                /*precisa ta na MESMA ORDEM DO BANCO*/
                $nome,
                $valor,
                $tempo
             

            );
            if (getType($resp) == 'object') {
                $se = $resp;
                echo "<p style='color: red;'>Serviço já cadastrado!</p>";
            } else {
                
                $msg = new Mensagem();
                
                
                echo $resp;
                echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"2;
			    URL='../Projeto-Barbearia/ListarServicos.php'\">";
                
            }
        }

        ?>

        <form method="post" action="">
            <div class="detalhes-usuario">
                <div class="input-box">
                    <?php
                    if ($se != null) {
                        echo $se->getIdServicos();
                    ?>

                        <input type="hidden" name="idclientes" value="<?php echo $se->getIdServicos() ?>">
                    <?php
                    }
                    ?>
                    <span>Nome do Serviço:</span>
                    <input type="text" placeholder="Digite o nome" name="nome" required value="<?php echo $se->getNomeServico(); ?>">
                </div>

                <div class="input-box">
                    <span class="detalhes">Tempo:</span>
                    <input id="tempo" type="time" name="tempo" required value="<?php echo $se->getTempoServico(); ?>">
                </div>



                <div class="input-box">
                    <span class="detalhes">Valor:</span>
                    <input type="number" step="0.01" placeholder="Digite o valor (apenas números)" name="valor" required value="<?php echo $se->getValorServico(); ?>">
                </div>
                

                
            </div>
            
            <div>
                <button type="submit" class="btn efeito-btn" name="cadastrar">Cadastrar</button>
            </div>
        </form>
    </div>
   

    
    
    

</body>

</html>
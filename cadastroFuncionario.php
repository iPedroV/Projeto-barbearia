<?php
if (!isset($_SESSION)) {
    session_start();
}
if(!isset($_SESSION['msg'])){
    $_SESSION['msg'] = "";
}
include_once 'C:/xampp/htdocs/Projeto-barbearia/controller/funcionarioController.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/mensagem.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/bd/banco.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/dao/DaoClientes.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/dao/daoIndex.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/Usuario.php';
$ce = new Usuario();
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


    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>
    <div class="container">
        <div class="title"><span><b>C</b></span>adastro Funcionario</div>

        <?php
        $conn = new Conecta();
        $msg = new Mensagem();
        $conecta = $conn->conectadb();
        if (isset($_POST['cadastrar'])) {
            $senha = trim($_POST['senha']);
            if ($senha != "") {

                $nome = $_POST['nome'];
                $perfil = $_POST['cargo'];
                $telefone = $_POST['telefone']; 
                $email = $_POST['email'];
                $sexo = $_POST['sexo'];
               
                
                
            }

            $cc = new FuncionarioController();
            unset($_POST['cadastrar']);
            $resp = $cc->inserirFuncionario(
                /*precisa ta na MESMA ORDEM DO BANCO*/
                $nome,
                $perfil,
                $telefone,
                $email,
                $senha,
                $sexo
                
            );
            if(getType($resp) == 'object'){
                $ce = $resp;
                echo "<p style='color: red;'>Email já cadastrado!</p>"; 
            }else{
            echo $resp;
            echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"2;
                                URL='cadastroFuncionario.php'\">";
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
                    <input type="text" placeholder="Digite o telefone celular" name="telefone" required value="<?php echo $ce->getTelefone(); ?>">
                </div>

                <div class="input-box">
                    <span class="detalhes">Cargo:</span>
                    <select name="cargo" class="select">
                        <option hidden>Selecione</option>
                        <option
                        <?php
                        if($ce->getPerfil() == "Administrador"){
                            echo "selected = 'selected'";
                        }?>>Administrador</option>

                        <option
                        <?php
                        if($ce->getPerfil() == "Funcionario"){
                            echo "selected = 'selected'";
                        }?>>Funcionário</option>
                    </select>
                </div>



                <div class="input-box">
                    <span class="detalhes">Email:</span>
                    <input type="email" placeholder="Digite seu email" name="email" required value="<?php echo $ce->getEmail(); ?>">
                </div>
                
                <div class="input-box">
                    <span class="detalhes">Senha:</span>
                    <input type="password" placeholder="Digite a senha" name="senha" id="senha" required value="<?php echo $ce->getSenha(); ?>">
                    <span class="p-viewer2">
                        <i class="fa fa-eye" aria-hidden="true" id="olho" style="color: #000000;" onclick="toggle()"></i>
                        <i class="fas fa-eye-slash" id="risco" onclick="toggle()"></i>
                    </span>
                </div>
            </div>
            <div class="genero">
                
                <input type="radio" name="sexo" id="ponto-1" value="Masculino" value="<?php echo $ce->getSexo(); ?>"
                    <?php if($ce->getSexo()!=null) { 
                        if($ce->getSexo() == "Masculino") echo "checked = checked";
                    }?> checked = 'checked' required>
                <input type="radio" name="sexo" id="ponto-2" value="Feminino" value="<?php echo $ce->getSexo(); ?>" 
                    <?php if($ce->getSexo()!=null) { 
                        if($ce->getSexo() == "Feminino") echo "checked = checked";
                    }?>required>
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
       function toggle() {
            var x = document.getElementById("senha");
            if (x.type === "password") {
                x.type = "text";
                document.getElementById("risco").style.display = "inline-block";
                document.getElementById("olho").style.display = 'none';
                document.getElementById("risco").style.color ='#000000';
                document.getElementById("olho").style.color ='#000000';
            } else {
                x.type = "password";
                document.getElementById("risco").style.display = 'none';
                document.getElementById("olho").style.display = 'inline-block';
                document.getElementById("risco").style.color ='#000000';
                document.getElementById("olho").style.color ='#000000';
            }
        }
    </script>
    <a class="whatsapp-link" href="https://web.whatsapp.com/send?phone=559891355162" target="_blank">
        <i class="fa fa-whatsapp"></i>
    </a>

</body>

</html>

<!DOCTYPE html>
<html lang="pt-bt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinição de Senha</title>
    <link rel="sorcut icon" href="img/barber-shop.png" type="image/png" style="width: 16px; height: 16px;">
    <Link rel="stylesheet" href="css/style-novasenha.css">
</head>

<body>
    <div id="login">

        <?php
            //Valdiação de senha
            if(isset($_POST['esenha'])){
                if(($_POST['nsenha']) == ($_POST['csenha'])){
                    echo "Senhas iguais";
                }else{
                    echo "senhas diferentes";
                }
            }
              
        ?>

        <img src="img/barbearianeves.png" class="imagem">
        <form method="post">
            <label for="n_senha">Nova senha:</label>
            <input type="password" id="nsenha" name="nsenha" required>

            <label for="c_senha">Confirmar senha:</label>
            <input type="password" id="csenha" name="csenha" required>

            <button type="submit" class="btn efeito-btn" name="esenha">Confirmar</button>
        </form>
    </div>
</body>

</html>
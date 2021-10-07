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

<script>
    function validarSenha(name1, name2)
{
    var n_senha = document.getElementById(n_senha).value;
    var c_senha = document.getElementById(c_senha).value;
		
    if (senha1 != "" && senha2 != "" && senha1 === senha2)
    {
    	alert('senha iguais');
    }
    else
    {
      	alert('senhas diferentes');
    }
}
</script>

    <div id="login">
        <img src="img/barbearianeves.png" class="imagem">
        <form method="post">
            <label for="n_senha">Nova senha:</label>
            <input type="password" id="n_senha" name="nsenha" required>

            <label for="c_senha">Confirmar senha:</label>
            <input type="password" id="c_senha" name="csenha" required>

            <button type="submit" onclick="validarSenha('n_senha','c_senha')" class="btn efeito-btn" name="e-senha">Confirmar</button>
        </form>
    </div>
</body>

</html>
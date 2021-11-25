<?php
ob_start();
if (!isset($_SESSION)) {
    session_start();
}

if ((!isset($_SESSION['emailc']) || !isset($_SESSION['nomec']))
    || !isset($_SESSION['nr']) || !isset($_SESSION['perfilc']) ||
    ($_SESSION['nr'] != $_SESSION['conferenr'])
) {
    header("Location: sessionDestroy.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="sorcut icon" href="img/barber-shop.png" type="image/png" style="width: 16px; height: 16px;">

    <link href="css/secretaria-agenda.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <title>Agendamentos</title>
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

    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Primeiro</th>
                <th scope="col">Último</th>
                <th scope="col">Nickname</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td>Larry</td>
                <td>the Bird</td>
                <td>@twitter</td>
            </tr>
        </tbody>
    </table>
</body>
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

</html>
<?php ob_end_flush(); ?>
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
function navBar()
{
    $nav = "
            ";
    if ($_SESSION['perfilc'] == "adm") {
        $nav .= "  <ul class=\"navigation\">
                            <li><a href=\"dashboard.html\"  onclick=\" toggleMenu();\">Dashboard</a></li>
                            <li><a href=\"./sessionDestroy.php\" onclick=\" toggleMenu();\">sair</a></li>
                            </ul> 
                            
                        ";
    }elseif($_SESSION['perfilc'] == "cliente"){
        $nav .= "<ul class=\"navigation\">
            <li><a href=\"#banner\"  onclick=\" toggleMenu();\">Home</a></li>
            <li><a href=\"#about\" onclick=\" toggleMenu();\">Sobre</a></li>
            <li><a href=\"#menu\" onclick=\" toggleMenu();\">Cortes</a></li>
            <li><a href=\"#salao\" onclick=\" toggleMenu();\">Salão</a></li>
            <li><a href=\"#feedbacks\" onclick=\" toggleMenu();\">Feedbacks</a></li>
            <li><a href=\"#contato\" onclick=\" toggleMenu();\">Contato</a></li>
            <li><a href=\"./sessionDestroy.php\" onclick=\" toggleMenu();\">sair</a></li>
            </ul>"; 
    }

    
    return $nav;
}
?>
<?php ob_end_flush(); ?>
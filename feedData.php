<?php

//feedData.php: daqui sera criado a estrutura e absorvido os dados do banco

$connect = new PDO("mysql:host=localhost;dbname=dbbarbearia", "root", "root");

$query = "SELECT * FROM noticias ORDER BY id DESC";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

header("Content-Type: text/xml;charset=iso-8859-1");

$base_url = "http://localhost/Projeto-barbearia/feedData.php";

echo "<?xml version='1.0' encoding='UTF-8' ?>" . PHP_EOL;
echo "<rss version='2.0'>".PHP_EOL;
echo "<channel>".PHP_EOL;
echo "<title>Feed Title | RSS</title>".PHP_EOL;
echo "<link>".$base_url."index.php</link>".PHP_EOL;
echo "<description>Cloud RSS</description>".PHP_EOL;
echo "<language>pt-br</language>".PHP_EOL;

foreach($result as $row)
{
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
$publish_Date = strftime('%A, %d de %B de %Y, %r', strtotime($row["horario"]));
 //$publish_Date = date("D, d M Y H:i:s", strtotime($row["data"]));

 
 echo "<item xmlns:dc='ns:1'>".PHP_EOL;
 echo "<title>".$row["titulo"]."</title>".PHP_EOL;

 echo "<guid>".md5($row["id"])."</guid>".PHP_EOL;
 echo "<pubDate>".$publish_Date."</pubDate>".PHP_EOL;
 echo "<dc:creator>".$row["autor"]."</dc:creator>".PHP_EOL;
 echo "<description><![CDATA[".substr($row["descricao"], 0, 400) ."]]></description>".PHP_EOL;

 echo "<category>Administrador</category>".PHP_EOL;
 echo "</item>".PHP_EOL;
}

echo '</channel>'.PHP_EOL;
echo '</rss>'.PHP_EOL;

?>
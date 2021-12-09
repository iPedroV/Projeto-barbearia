<?php

//feedData.php: daqui sera criado a estrutura e absorvido os dados do banco

$connect = new PDO("mysql:host=localhost;dbname=dbbarbearia", "root", "root");

$query = "SELECT * FROM noticias ORDER BY id DESC";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();
if ($result != null) {
    # code...

header("Content-Type: text/xml;charset=iso-8859-1");

utf8_decode($base_url = "http://localhost/Projeto-barbearia/feedData.php");

echo "<?xml version='1.0' ?>";
echo "<locale xmlns='http://purl.org/net/xbiblio/csl' version='1.0' xml:lang='pt-BR'>";
echo "<rss version='2.0'>";
echo "<channel>";
echo "<title>Feed Title | RSS</title>";
echo "<link>".$base_url."</link>";
echo "<description>Cloud RSS</description>";
echo "<language>pt-br</language>";

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
echo '</locale>'.PHP_EOL;
} else {

header("Content-Type: text/xml;charset=iso-8859-1");

utf8_decode($base_url = "http://localhost/Projeto-barbearia/feedData.php");

echo "<?xml version='1.0' ?>";
echo "<locale xmlns='http://purl.org/net/xbiblio/csl' version='1.0' xml:lang='pt-BR'>";
echo "<rss version='2.0'>";
echo "<channel>";
echo "<title>Feed Title | RSS</title>";
echo "<link>".$base_url."</link>";
echo "<description>Cloud RSS</description>";
echo "<language>pt-br</language>";
echo "<item xmlns:dc='ns:1'>";
echo "<title>Não possui nenhuma notícia publicada.</title>";
echo "<guid>6512bd43d9caa6e02c990b0a82652dca</guid>";
echo "<pubDate></pubDate>";
echo "<dc:creator>ADM</dc:creator>";
echo "<description>";
echo "<![CDATA[ ]]>";
echo "</description>";
echo "<category>Administrador</category>";
echo "</item>";
echo '</channel>'.PHP_EOL;
echo '</rss>'.PHP_EOL;
echo '</locale>'.PHP_EOL;
}
?>
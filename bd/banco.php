<?php

//Banco Utilizado para poder chamar de forma estruturada a chamada dos Selects com interação
$servidor = "localhost";
$usuario = "root";
<<<<<<< HEAD
$senha = "senac";
=======
$senha = "root";
>>>>>>> 91f199936259bf83a33982c3fe870a85473bdfa6
$dbname = "dbbarbearia";

//Criar a conexão
$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);

class Conecta {
    
    public function conectadb(){
        $pdo = null;
        try{
            $pdo = new PDO("mysql:host=localhost;dbname=dbbarbearia", 
<<<<<<< HEAD
            "root", "senac");
=======
            "root", "root");
>>>>>>> 91f199936259bf83a33982c3fe870a85473bdfa6
        }catch(Exception $ex){
            echo "<script>alert('Erro na conexão com o "
                . "banco de dados.')</script>";
        }
        return $pdo;
    }
}


// __Tabela feita para testes dos Dia Escolhido no calendário e o horário, juntamente
// com a data de registro que é inserida automaticamente para o banco.

/* 
table testedate

id int(11) primary key auto_increment,
data DATE not null,
horario time not null,
data_registro dateTime not null;

https://www.php.net/manual/pt_BR/function.date.php

Visualizar o Site Versão mobile.
https://www.responsinator.com/

MD5
https://www.md5hashgenerator.com/
*/
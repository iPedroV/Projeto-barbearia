<?php


include_once 'C:/xampp/htdocs/Projeto-barbearia/bd/banco.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/Usuario.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/Noticia.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/Mensagem.php';

class daoIndex
{

    public function inserirNoticiaDAO(Noticia $noticias)
    {

        $conn = new Conecta();
        $msg = new Mensagem();
        $conecta = $conn->conectadb();

        if ($conecta) {

            $resp = null;
            $titulo = $noticias->getTitulo();
            $descricao = $noticias->getDescricao();
            $autor = $noticias->getAutor();
            

            try {
                
                    $stmt = $conecta->prepare("insert into noticias values "
                        . "(null,?,?,?,NOW(),0)");

                    $stmt->bindParam(1, $titulo);
                    $stmt->bindParam(2, $descricao);
                    $stmt->bindParam(3, $autor);
                    

                    $stmt->execute();
                    $resp = "<p style='color: green;'>"
                        . "Notícias publicada com sucesso!</p>";
                
            } catch (Exception $ex) {
                $resp = $ex;
            }
        } else {
            $resp = "<p style='color: red;'>"
                . "Erro na conexão com o banco de dados.</p>";
        }
        $conn = null;
        return $resp;
    }
}

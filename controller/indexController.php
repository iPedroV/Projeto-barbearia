<?php
include_once 'C:/xampp/htdocs/Projeto-barbearia/dao/daoIndex.php';
include_once 'C:/xampp/htdocs/Projeto-barbearia/model/Noticia.php';

class indexController {
    

    public function inserirNoticia($titulo, $descricao, $autor){
        $noticias = new Noticia();
        $noticias->setTitulo($titulo);
        $noticias->setDescricao($descricao);
        $noticias->setAutor($autor);
        
        
        $daoindex = new daoIndex();
        return $daoindex->inserirNoticiaDAO($noticias);
    }



}
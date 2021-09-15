<?php

class Clientes {
    
    private $id;
 
    private $senha;
    private $nome;
    private $sexo;
    private $email;
    private $telefone;

    public function getId()
    {
        return $this->id;
    }

     
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    

    
    public function getSenha()
    {
        return $this->senha;
    }

    
    public function setSenha($senha)
    {
        $this->senha = $senha;

        return $this;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    public function getSexo()
    {
        return $this->sexo;
    }

    public function setSexo($sexo)
    {
        $this->sexo = $sexo;

        return $this;
    }


    public function getEmail()
    {
        return $this->email;
    }


    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;

        return $this;
    }
}

<?php

class Usuario
{
    private $idUSuario;
    private $nome;
    private $perfil;
    private $telefone;
    private $email;
    private $senha;
    private $sexo;
  
    public function getIdUSuario()
    {
        return $this->idUSuario;
    }

    public function setIdUSuario($idUSuario)
    {
        $this->idUSuario = $idUSuario;

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

    public function getPerfil()
    {
        return $this->perfil;
    }


    public function setPerfil($perfil)
    {
        $this->perfil = $perfil;

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


    public function getEmail()
    {
        return $this->email;
    }


    public function setEmail($email)
    {
        $this->email = $email;

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


    public function getSexo()
    {
        return $this->sexo;
    }

    public function setSexo($sexo)
    {
        $this->sexo = $sexo;

        return $this;
    }


}

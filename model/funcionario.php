<?php

class Funcionario
{
    #Para não haver confusões com os metodos futuramente deixei como "idFuncionario", no banco é só "id"
    private $idFuncionario;
    private $nome;
    private $cargo;
    private $telefone;
    private $email;
    private $senha;


    /**
     * Get the value of idFuncionario
     */
    public function getIdFuncionario()
    {
        return $this->idFuncionario;
    }

    /**
     * Set the value of idFuncionario
     */
    public function setIdFuncionario($idFuncionario): self
    {
        $this->idFuncionario = $idFuncionario;

        return $this;
    }

    /**
     * Get the value of nome
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     */
    public function setNome($nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get the value of cargo
     */
    public function getCargo()
    {
        return $this->cargo;
    }

    /**
     * Set the value of cargo
     */
    public function setCargo($cargo): self
    {
        $this->cargo = $cargo;

        return $this;
    }

    /**
     * Get the value of telefone
     */
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * Set the value of telefone
     */
    public function setTelefone($telefone): self
    {
        $this->telefone = $telefone;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     */
    public function setEmail($email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of senha
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * Set the value of senha
     */
    public function setSenha($senha): self
    {
        $this->senha = $senha;

        return $this;
    }
}

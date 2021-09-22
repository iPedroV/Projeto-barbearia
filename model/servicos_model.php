<?php

class Servicos_model {
    private $idServicos;
    private $nomeServico;
    private $valorServico;
    private $tempoServico;


    /**
     * Get the value of idServicos
     */ 
    public function getIdServicos()
    {
        return $this->idServicos;
    }

    /**
     * Set the value of idServicos
     *
     * @return  self
     */ 
    public function setIdServicos($idServicos)
    {
        $this->idServicos = $idServicos;

        return $this;
    }

    /**
     * Get the value of nomeServico
     */ 
    public function getNomeServico()
    {
        return $this->nomeServico;
    }

    /**
     * Set the value of nomeServico
     *
     * @return  self
     */ 
    public function setNomeServico($nomeServico)
    {
        $this->nomeServico = $nomeServico;

        return $this;
    }

    /**
     * Get the value of valorServico
     */ 
    public function getValorServico()
    {
        return $this->valorServico;
    }

    /**
     * Set the value of valorServico
     *
     * @return  self
     */ 
    public function setValorServico($valorServico)
    {
        $this->valorServico = $valorServico;

        return $this;
    }

    /**
     * Get the value of tempoServico
     */ 
    public function getTempoServico()
    {
        return $this->tempoServico;
    }

    /**
     * Set the value of tempoServico
     *
     * @return  self
     */ 
    public function setTempoServico($tempoServico)
    {
        $this->tempoServico = $tempoServico;

        return $this;
    }
}
<?php

class Despesa
{
    private $idDespesa;
    private $tipo;
    private $dataRegistroDespesa;
    private $status;
    private $valor;
    

    public function getIdDespesa()
    {
        return $this->idDespesa;
    }


    public function setIdDespesa($idDespesa)
    {
        $this->idDespesa = $idDespesa;

        return $this;
    }
    

    public function getTipo()
    {
        return $this->tipo;
    }

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }


    public function getDataRegistroDespesa()
    {
        return $this->dataRegistroDespesa;
    }


    public function setDataRegistroDespesa($dataRegistroDespesa)
    {
        $this->dataRegistroDespesa = $dataRegistroDespesa;

        return $this;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    public function getValor()
    {
        return $this->valor;
    }

    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }
}

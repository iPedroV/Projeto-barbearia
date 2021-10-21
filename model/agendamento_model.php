<?php

class Agendamento {
    private $id;
    private $horario;
    private $dataAgenda;
    private $forma_Pagamento;
    private $statusAgendamento;
    private $dateTime;
    private $dataPagemento;
    private $confirma;
    private $valor;
    private $usuarioID;

    /**
     * Get the value of idFornecedor
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of idFornecedor
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nomeFornecedor
     */ 
    public function getDataAgenda()
    {
        return $this->dataAgenda;
    }

    /**
     * Set the value of nomeFornecedor
     *
     * @return  self
     */ 
    public function setDataAgenda($dataAgenda)
    {
        $this->dataAgenda = $dataAgenda;

        return $this;
    }

    /**
     * Get the value of horario
     */ 
    public function getHorario()
    {
        return $this->horario;
    }

    /**
     * Set the value of horario
     *
     * @return  self
     */ 
    public function setHorario($horario)
    {
        $this->horario = $horario;

        return $this;
    }

    /**
     * Get the value of dateTime
     */ 
    public function getDateTime()
    {
        return $this->dateTime;
    }

    /**
     * Set the value of dateTime
     *
     * @return  self
     */ 
    public function setDateTime($dateTime)
    {
        $this->dateTime = $dateTime;

        return $this;
    }

    /**
     * Get the value of forma_Pagamento
     */ 
    public function getForma_Pagamento()
    {
        return $this->forma_Pagamento;
    }

    /**
     * Set the value of forma_Pagamento
     *
     * @return  self
     */ 
    public function setForma_Pagamento($forma_Pagamento)
    {
        $this->forma_Pagamento = $forma_Pagamento;

        return $this;
    }

    /**
     * Get the value of statusAgendamento
     */ 
    public function getStatusAgendamento()
    {
        return $this->statusAgendamento;
    }

    /**
     * Set the value of statusAgendamento
     *
     * @return  self
     */ 
    public function setStatusAgendamento($statusAgendamento)
    {
        $this->statusAgendamento = $statusAgendamento;

        return $this;
    }

    /**
     * Get the value of dataPagemento
     */ 
    public function getDataPagemento()
    {
        return $this->dataPagemento;
    }

    /**
     * Set the value of dataPagemento
     *
     * @return  self
     */ 
    public function setDataPagemento($dataPagemento)
    {
        $this->dataPagemento = $dataPagemento;

        return $this;
    }

    /**
     * Get the value of confirma
     */ 
    public function getConfirma()
    {
        return $this->confirma;
    }

    /**
     * Set the value of confirma
     *
     * @return  self
     */ 
    public function setConfirma($confirma)
    {
        $this->confirma = $confirma;

        return $this;
    }

    /**
     * Get the value of valor
     */ 
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set the value of valor
     *
     * @return  self
     */ 
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get the value of usuarioID
     */ 
    public function getUsuarioID()
    {
        return $this->usuarioID;
    }

    /**
     * Set the value of usuarioID
     *
     * @return  self
     */ 
    public function setUsuarioID($usuarioID)
    {
        $this->usuarioID = $usuarioID;

        return $this;
    }
}

?>
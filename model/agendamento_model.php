<?php

class Agendamento {
    private $id;
    private $dataAgenda;
    private $horario;
    private $dateTime;

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
}

?>
<?php

class Agendamentos_dos_servicos {

    private $idAgendamento;
    private $idFuncionario;
    private $idServicos;


    public function getIdAgendamento()
    {
        return $this->idAgendamento;
    }

    public function setIdAgendamento($idAgendamento)
    {
        $this->idAgendamento = $idAgendamento;

        return $this;
    }

    public function getIdFuncionario()
    {
        return $this->idFuncionario;
    }

    public function setIdFuncionario($idFuncionario)
    {
        $this->idFuncionario = $idFuncionario;

        return $this;
    }

    public function getIdServicos()
    {
        return $this->idServicos;
    }

    public function setIdServicos($idServicos)
    {
        $this->idServicos = $idServicos;

        return $this;
    }
}

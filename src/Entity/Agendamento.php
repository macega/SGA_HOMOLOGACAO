<?php

/*
 * This file is part of the Novo SGA project.
 *
 * (c) Rogerio Lino <rogeriolino@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Entity;

use DateTime;
use Novosga\Entity\AgendamentoInterface;
use DateTimeInterface;
use Novosga\Entity\ClienteInterface;
use Novosga\Entity\UnidadeInterface;
use Novosga\Entity\ServicoInterface;

/**
 * Agendamento.
 *
 * @author rogerio
 */
class Agendamento implements AgendamentoInterface, \JsonSerializable
{
    /**
     * @var mixed
     */
    protected $id;
    
    /**
     * @var DateTimeInterface
     */
    private $data;
    
    /**
     * @var DateTimeInterface
     */
    private $hora;
    
    /**
     * @var ClienteInterface
     */
    private $cliente;
    
    /**
     * @var UnidadeInterface
     */
    private $unidade;
    
    /**
     * @var ServicoInterface
     */
    private $servico;
    
    /**
     * @var DateTimeInterface
     */
    private $dataConfirmacao;

    public function __construct()
    {
    }

    public function getId()
    {
        return $this->id;
    }

    public function getData(): ?DateTimeInterface
    {
        return $this->data;
    }

    public function getHora(): ?DateTimeInterface
    {
        return $this->hora;
    }

    public function getCliente(): ?ClienteInterface
    {
        return $this->cliente;
    }

    public function getUnidade(): ?UnidadeInterface
    {
        return $this->unidade;
    }

    public function getServico(): ?ServicoInterface
    {
        return $this->servico;
    }
    
    public function getDataConfirmacao(): ?DateTimeInterface
    {
        return $this->dataConfirmacao;
    }

    public function setData(?DateTimeInterface $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function setHora(?DateTimeInterface $hora): self
    {
        $this->hora = $hora;

        return $this;
    }

    public function setCliente(?ClienteInterface $cliente): self
    {
        $this->cliente = $cliente;

        return $this;
    }

    public function setUnidade(?UnidadeInterface $unidade): self
    {
        $this->unidade = $unidade;

        return $this;
    }

    public function setServico(?ServicoInterface $servico): self
    {
        $this->servico = $servico;

        return $this;
    }
    
    public function setDataConfirmacao(?DateTimeInterface $dataConfirmacao): self
    {
        $this->dataConfirmacao = $dataConfirmacao;

        return $this;
    }
        
    public function __toString()
    {
        return $this->getId();
    }
    
    public function jsonSerialize()
    {
        return [
            'id'               => $this->getId(),
            'cliente'          => $this->getCliente(),
            'servico'          => $this->getServico(),
            'unidade'          => $this->getUnidade(),
            'data'             => $this->getData() ? $this->getData()->format('Y-m-d') : null,
            'hora'             => $this->getHora() ? $this->getHora()->format('H:i') : null,
            'dataConfirmacao'  => $this->getDataConfirmacao(),
        ];
    }
}

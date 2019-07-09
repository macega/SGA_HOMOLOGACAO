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
use DateTimeInterface;
use Novosga\Entity\ServicoInterface;
use Doctrine\Common\Collections\Collection;
use \Doctrine\Common\Collections\ArrayCollection;

/**
 * Servico
 *
 * @author Rogerio Lino <rogeriolino@gmail.com>
 */
class Servico implements ServicoInterface, \JsonSerializable
{
    /**
     * @var mixed
     */
    protected $id;
    
    /**
     * @var string
     */
    private $nome = '';

    /**
     * @var string
     */
    private $descricao;

    /**
     * @var bool
     */
    private $ativo;

    /**
     * @var int
     */
    private $peso = 1;

    /**
     * @var Servico
     */
    private $mestre;

    /**
     * @var Servico[]
     */
    private $subServicos;

    /**
     * @var ServicoUnidade[]
     */
    private $servicosUnidade;

    /**
     * @var DateTimeInterface
     */
    private $createdAt;

    /**
     * @var DateTimeInterface
     */
    private $updatedAt;

    /**
     * @var DateTimeInterface
     */
    private $deletedAt;

    public function __construct()
    {
        $this->ativo           = true;
        $this->subServicos     = new ArrayCollection();
        $this->servicosUnidade = new ArrayCollection();
        $this->createdAt       = new DateTime();
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function setId($id): self
    {
        $this->id = $id;
        
        return $this;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setDescricao(?string $descricao): self
    {
        $this->descricao = $descricao;

        return $this;
    }

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setMestre(?Servico $servico): self
    {
        $this->mestre = $servico;

        return $this;
    }

    public function getMestre(): ?ServicoInterface
    {
        return $this->mestre;
    }

    public function isMestre(): bool
    {
        return ($this->getId() && !$this->getMestre());
    }

    public function setAtivo(bool $ativo): self
    {
        $this->ativo = $ativo;

        return $this;
    }

    public function isAtivo(): bool
    {
        return $this->ativo;
    }

    public function getPeso(): int
    {
        return $this->peso;
    }

    public function setPeso(int $peso): self
    {
        $this->peso = $peso;

        return $this;
    }

    public function getSubServicos(): Collection
    {
        return $this->subServicos;
    }

    public function setSubServicos(Collection $subServicos): self
    {
        $this->subServicos = $subServicos;

        return $this;
    }

    public function getServicosUnidade()
    {
        return $this->servicosUnidade;
    }

    public function setServicosUnidade(array $servicosUnidade): self
    {
        $this->servicosUnidade = $servicosUnidade;

        return $this;
    }
    
    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function getDeletedAt(): ?DateTimeInterface
    {
        return $this->deletedAt;
    }

    public function setCreatedAt(DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function setUpdatedAt(?DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function setDeletedAt(?DateTimeInterface $deletedAt): self
    {
        $this->deletedAt = $deletedAt;
        
        return $this;
    }
    
    public function __toString()
    {
        return $this->nome;
    }

    public function jsonSerialize()
    {
        return [
            'id'        => $this->getId(),
            'nome'      => $this->getNome(),
            'descricao' => $this->getDescricao(),
            'peso'      => $this->getPeso(),
            'ativo'     => $this->isAtivo(),
            'macro'     => $this->getMestre(),
            'createdAt' => $this->getCreatedAt()->format('Y-m-d\TH:i:s'),
            'updatedAt' => $this->getUpdatedAt() ? $this->getUpdatedAt()->format('Y-m-d\TH:i:s') : null,
            'deletedAt' => $this->getDeletedAt() ? $this->getDeletedAt()->format('Y-m-d\TH:i:s') : null,
        ];
    }
}

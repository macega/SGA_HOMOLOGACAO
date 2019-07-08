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
use Novosga\Entity\PerfilInterface;

/**
 * Classe Perfil
 * O perfil define permissões de acesso a módulos do sistema.
 *
 * @author Rogerio Lino <rogeriolino@gmail.com>
 */
class Perfil implements PerfilInterface, \JsonSerializable
{
    /**
     * @var mixed
     */
    protected $id;
    
    /**
     * @var string
     */
    private $nome;

    /**
     * @var string
     */
    private $descricao;

    /**
     * @var Modulo[]
     */
    private $modulos;

    /**
     * @var DateTimeInterface
     */
    private $createdAt;

    /**
     * @var DateTimeInterface
     */
    private $updatedAt;
    
    public function __construct()
    {
        $this->nome      = '';
        $this->modulos   = [];
        $this->createdAt = new DateTime();
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
    
    /**
     * Define o nome do perfil.
     *
     * @param string $nome
     */
    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Retorna a descrição do perfil.
     *
     * @return int
     */
    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    /**
     * Define a descrição do perfil.
     *
     * @param string $descricao
     */
    public function setDescricao(?string $descricao): self
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Retorna o nome do perfil.
     *
     * @return string
     */
    public function getNome(): string
    {
        return $this->nome;
    }

    public function getModulos(): array
    {
        return $this->modulos;
    }

    public function setModulos($modulos): self
    {
        $this->modulos = $modulos;

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
            'modulos'   => $this->getModulos(),
            'createdAt' => $this->getCreatedAt()->format('Y-m-d\TH:i:s'),
            'updatedAt' => $this->getUpdatedAt() ? $this->getUpdatedAt()->format('Y-m-d\TH:i:s') : null,
        ];
    }
}

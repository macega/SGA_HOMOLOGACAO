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

use Novosga\Entity\PainelInterface;
use Novosga\Entity\UnidadeInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
  * Painel
  *
  * @author Rogerio Lino <rogeriolino@gmail.com>
  */
class Painel implements PainelInterface, \JsonSerializable
{
    /**
     * @var int
     */
    private $host;

    /**
     * @var string
     */
    private $senha;

    /**
     * @var UnidadeInterface
     */
    private $unidade;

    /**
     * @var Collection|PainelServico[]
     */
    private $servicos;

    public function __construct()
    {
        $this->servicos = new ArrayCollection();
    }

    public function getHost(): int
    {
        return $this->host;
    }

    public function setHost(int $host): self
    {
        $this->host = $host;

        return $this;
    }

    public function getUnidade(): UnidadeInterface
    {
        return $this->unidade;
    }

    public function setUnidade(UnidadeInterface $unidade): self
    {
        $this->unidade = $unidade;

        return $this;
    }

    /**
     * @return Collection|PainelServico[]
     */
    public function getServicos(): Collection
    {
        return $this->servicos;
    }

    public function setServicos(array  $servicos): self
    {
        $this->servicos = $servicos;
        
        return $this;
    }

    public function getIp(): string
    {
        return long2ip($this->getHost());
    }

    public function __toString()
    {
        return $this->getIp();
    }

    public function jsonSerialize()
    {
        return [
           'host'     => $this->getHost(),
           'ip'       => $this->getIp(),
           'servicos' => $this->getServicos(),
        ];
    }
}

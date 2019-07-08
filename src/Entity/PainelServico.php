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

use Novosga\Entity\PainelServicoInterface;
use Novosga\Entity\PainelInterface;
use Novosga\Entity\ServicoInterface;
use Novosga\Entity\UnidadeInterface;

/**
  * PainelServico
  *
  * @author Rogerio Lino <rogeriolino@gmail.com>
  */
class PainelServico implements PainelServicoInterface, \JsonSerializable
{
    /**
     * @var PainelInterface
     */
    private $painel;

    /**
     * @var ServicoInterface
     */
    private $servico;

    /**
     * @var UnidadeInterface
     */
    private $unidade;

    public function getPainel(): PainelInterface
    {
        return $this->painel;
    }

    public function setPainel(PainelInterface $painel): self
    {
        $this->painel = $painel;

        return $this;
    }

    public function getServico(): ServicoInterface
    {
        return $this->servico;
    }

    public function setServico(ServicoInterface $servico): self
    {
        $this->servico = $servico;

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

    public function jsonSerialize()
    {
        return [
           'painel'  => $this->getPainel(),
           'servico' => $this->getServico(),
           'unidade' => $this->getUnidade(),
        ];
    }
}

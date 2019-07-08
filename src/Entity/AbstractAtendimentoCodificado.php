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

use Novosga\Entity\AtendimentoInterface;
use Novosga\Entity\ServicoInterface;

/**
 * AbstractAtendimentoCodificado
 * atendimento codificado (servico realizado).
 *
 * @author Rogerio Lino <rogeriolino@gmail.com>
 */
abstract class AbstractAtendimentoCodificado
{
    /**
     * @var ServicoInterface
     */
    protected $servico;

    /**
     * @var int
     */
    protected $peso;

    public function getServico(): ServicoInterface
    {
        return $this->servico;
    }

    public function setServico(ServicoInterface $servico): self
    {
        $this->servico = $servico;

        return $this;
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
}

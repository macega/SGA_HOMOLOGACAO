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

use Novosga\Entity\ContadorInterface;
use Novosga\Entity\UnidadeInterface;
use Novosga\Entity\ServicoInterface;

/**
 * Ticket counter.
 *
 * @author Rogerio Lino <rogeriolino@gmail.com>
 */
class Contador implements ContadorInterface, \JsonSerializable
{
    /**
     * @var UnidadeInterface
     */
    private $unidade;

    /**
     * @var ServicoInterface
     */
    private $servico;

    /**
     * @var int
     */
    private $numero;


    /**
     * Get the value of Unidade
     *
     * @return UnidadeInterface
     */
    public function getUnidade(): UnidadeInterface
    {
        return $this->unidade;
    }

    /**
     * Set the value of Unidade
     *
     * @param UnidadeInterface $unidade
     *
     * @return self
     */
    public function setUnidade(Unidade $unidade): self
    {
        $this->unidade = $unidade;

        return $this;
    }

    /**
     * Get the value of Servico
     *
     * @return ServicoInterface
     */
    public function getServico(): ServicoInterface
    {
        return $this->servico;
    }

    /**
     * Set the value of Servico
     *
     * @param ServicoInterface $servico
     *
     * @return self
     */
    public function setServico(ServicoInterface $servico): self
    {
        $this->servico = $servico;

        return $this;
    }

    /**
     * @return int
     */
    public function getNumero(): int
    {
        return $this->numero;
    }

    /**
     * @param int $numero
     * @return self
     */
    public function setNumero(int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'numero'  => $this->getNumero(),
            'servico' => $this->getServico()
        ];
    }
}

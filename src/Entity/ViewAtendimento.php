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

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Novosga\Entity\ViewAtendimentoInterface;

/**
 * View Atendimento
 * União dos atendimentos atuais e do histórico
 *
 * @author Rogerio Lino <rogeriolino@gmail.com>
 */
class ViewAtendimento extends AbstractAtendimento implements ViewAtendimentoInterface
{
    /**
     * @var AtendimentoCodificadoHistorico[]
     */
    private $codificados;

    public function __construct()
    {
        $this->codificados = new ArrayCollection();
    }

    public function getCodificados(): Collection
    {
        return $this->codificados;
    }

    public function setCodificados(Collection $codificados): self
    {
        $this->codificados = $codificados;

        return $this;
    }
}

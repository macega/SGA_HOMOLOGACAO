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

use Novosga\Entity\AtendimentoCodificadoInterface;
use Novosga\Entity\AtendimentoInterface;

/**
 * Classe Atendimento Codificado (Historico)
 * representa o atendimento codificado (servico realizado).
 *
 * @author Rogerio Lino <rogeriolino@gmail.com>
 */
class AtendimentoCodificadoHistorico extends AbstractAtendimentoCodificado implements AtendimentoCodificadoInterface
{
    /**
     * @var AtendimentoHistorico
     */
    private $atendimento;

    public function getAtendimento(): AtendimentoInterface
    {
        return $this->atendimento;
    }

    public function setAtendimento(AbstractAtendimento $atendimento): AbstractAtendimentoCodificado
    {
        $this->atendimento = $atendimento;

        return $this;
    }
}

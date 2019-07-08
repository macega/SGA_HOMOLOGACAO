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

use Novosga\Entity\AtendimentoMetadataInterface;
use Novosga\Entity\AtendimentoInterface;

/**
 * AtendimentoMeta.
 *
 * @author Rogerio Lino <rogeriolino@gmail.com>
 */
class AtendimentoMeta extends EntityMetadata implements AtendimentoMetadataInterface
{
    public function getAtendimento(): AtendimentoInterface
    {
        return $this->getEntity();
    }

    public function setAtendimento(Atendimento $atendimento): self
    {
        return $this->setEntity($atendimento);
    }
}

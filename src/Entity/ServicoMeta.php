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

use Novosga\Entity\ServicoMetadataInterface;
use Novosga\Entity\ServicoInterface;

/**
 * Servico metadata.
 *
 * @author Rogerio Lino <rogeriolino@gmail.com>
 */
class ServicoMeta extends EntityMetadata implements ServicoMetadataInterface
{
    public function getServico(): ServicoInterface
    {
        return $this->getEntity();
    }

    public function setServico(Servico $servico): self
    {
        return $this->setEntity($servico);
    }
}

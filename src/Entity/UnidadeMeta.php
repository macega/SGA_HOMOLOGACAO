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

use Novosga\Entity\UnidadeMetadataInterface;
use Novosga\Entity\UnidadeInterface;

/**
 * Unidade metadata.
 *
 * @author Rogerio Lino <rogeriolino@gmail.com>
 */
class UnidadeMeta extends EntityMetadata implements UnidadeMetadataInterface
{
    public function getUnidade(): UnidadeInterface
    {
        return $this->getEntity();
    }

    public function setUnidade(Unidade $unidade): self
    {
        return $this->setEntity($unidade);
    }
}

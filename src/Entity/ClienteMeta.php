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

use Novosga\Entity\ClienteMetadataInterface;
use Novosga\Entity\ClienteInterface;

/**
 * ClienteMeta
 *
 * @author Rogerio Lino <rogeriolino@gmail.com>
 */
class ClienteMeta extends EntityMetadata implements ClienteMetadataInterface
{
    public function getCliente(): ClienteInterface
    {
        return $this->getEntity();
    }

    public function setCliente(Cliente $cliente): self
    {
        return $this->setEntity($cliente);
    }
}

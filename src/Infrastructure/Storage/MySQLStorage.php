<?php

/*
 * This file is part of the Novo SGA project.
 *
 * (c) Rogerio Lino <rogeriolino@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Infrastructure\Storage;

use Doctrine\DBAL\Connection;
use Novosga\Entity\UnidadeInterface;
use Novosga\Entity\ServicoInterface;
use Novosga\Entity\ContadorInterface;

/**
 * MySQL Storage
 *
 * @author Rogerio Lino <rogeriolino@gmail.com>
 */
class MySQLStorage extends RelationalStorage
{
    /**
     * {@inheritdoc}
     */
    protected function numeroAtual(Connection $conn, UnidadeInterface $unidade, ServicoInterface $servico): int
    {
        $contadorTable = $this->om->getClassMetadata(ContadorInterface::class)->getTableName();
     
        $stmt = $conn->prepare("
            SELECT numero 
            FROM {$contadorTable} 
            WHERE
                unidade_id = :unidade AND
                servico_id = :servico
            FOR UPDATE
        ");

        $stmt->bindValue('unidade', $unidade->getId());
        $stmt->bindValue('servico', $servico->getId());
        $stmt->execute();
        $numeroAtual = (int) $stmt->fetchColumn();
        
        return $numeroAtual;
    }
    
    /**
     * {@inheritdoc}
     */
    protected function preAcumularAtendimentos(Connection $conn, UnidadeInterface $unidade = null)
    {
        $conn->exec('SET foreign_key_checks = 0');
    }
    
    /**
     * {@inheritdoc}
     */
    protected function preApagarDadosAtendimento(Connection $conn, UnidadeInterface $unidade = null)
    {
        $conn->exec('SET foreign_key_checks = 0');
    }
}

<?php

/*
 * This file is part of the Novo SGA project.
 *
 * (c) Rogerio Lino <rogeriolino@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Repository\ORM;

use Doctrine\ORM\EntityRepository;
use App\Entity\Atendimento;
use Novosga\Repository\AtendimentoRepositoryInterface;
use Novosga\Entity\UnidadeInterface;
use Novosga\Entity\ServicoInterface;

/**
 * AtendimentoRepository
 *
 * @author Rogério Lino <rogeriolino@gmail.com>
 */
class AtendimentoRepository extends EntityRepository implements AtendimentoRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function countByServicos(UnidadeInterface $unidade, array $servicos, $status = null)
    {
        $qb = $this
            ->getEntityManager()
            ->createQueryBuilder()
            ->select('s.id, COUNT(e) as total')
            ->from(Atendimento::class, 'e')
            ->join('e.servico', 's')
            ->where('e.unidade = :unidade')
            ->groupBy('s.id')
            ->setParameter('unidade', $unidade);
        
        if (count($servicos)) {
            $qb
                ->andWhere('e.servico IN (:servicos)')
                ->setParameter('servicos', $servicos);
        }
        
        if ($status) {
            $qb
                ->andWhere('e.status = :status')
                ->setParameter('status', $status);
        }
        
        $rs = $qb
            ->getQuery()
            ->getArrayResult();
        
        return $rs;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getUltimo(UnidadeInterface $unidade, ServicoInterface $servico = null)
    {
        $qb = $this
            ->getEntityManager()
            ->createQueryBuilder()
            ->select('e')
            ->from(Atendimento::class, 'e')
            ->where('e.unidade = :unidade')
            ->orderBy('e.id', 'DESC')
            ->setParameter('unidade', $unidade);
        
        if ($servico) {
            $qb
                ->andWhere('e.servico = :servico')
                ->setParameter('servico', $servico);
        }
        
        $atendimento = $qb
            ->getQuery()
            ->setMaxResults(1)
            ->getOneOrNullResult();
        
        return $atendimento;
    }
}

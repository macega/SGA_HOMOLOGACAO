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
use App\Entity\Lotacao;
use App\Entity\Unidade;
use App\Entity\Usuario;
use Novosga\Repository\LotacaoRepositoryInterface;
use Novosga\Entity\UsuarioInterface;
use Novosga\Entity\UnidadeInterface;

/**
 * LotacaoRepository
 *
 * @author Rogério Lino <rogeriolino@gmail.com>
 */
class LotacaoRepository extends EntityRepository implements LotacaoRepositoryInterface
{
    
    /**
     * Retorna as lotações do usuário
     *
     * @param Usuario $usuario
     * @return Lotacao[]
     */
    public function getLotacoes(UsuarioInterface $usuario)
    {
        return $this->getEntityManager()
                ->createQueryBuilder()
                ->select([
                    'e', 'c', 'u'
                ])
                ->from($this->getEntityName(), 'e')
                ->join('e.perfil', 'c')
                ->join('e.unidade', 'u')
                ->where("e.usuario = :usuario")
                ->setParameter('usuario', $usuario)
                ->getQuery()
                ->getResult()
        ;
    }
    
    /**
     * Retorna as lotações do usuário
     *
     * @param Unidade $unidade
     * @return Lotacao[]
     */
    public function getLotacoesUnidade(Unidade $unidade)
    {
        return $this->getEntityManager()
                ->createQueryBuilder()
                ->select([
                    'e', 'c', 'u'
                ])
                ->from($this->getEntityName(), 'e')
                ->join('e.perfil', 'c')
                ->join('e.usuario', 'u')
                ->where("e.unidade = :unidade")
                ->setParameter('unidade', $unidade)
                ->getQuery()
                ->getResult()
        ;
    }
    
    /**
     * Retorna a lotação do usuário na unidade
     *
     * @param UsuarioInterface $usuario
     * @param UnidadeInterface $unidade
     * @return Lotacao
     */
    public function getLotacao(UsuarioInterface $usuario, UnidadeInterface $unidade)
    {
        return $this->getEntityManager()
                ->createQueryBuilder()
                ->select([
                    'e', 'c', 'u'
                ])
                ->from($this->getEntityName(), 'e')
                ->join('e.perfil', 'c')
                ->join('e.unidade', 'u')
                ->where("e.usuario = :usuario")
                ->andWhere("e.unidade = :unidade")
                ->setParameter('usuario', $usuario)
                ->setParameter('unidade', $unidade)
                ->getQuery()
                ->getOneOrNullResult()
        ;
    }
}

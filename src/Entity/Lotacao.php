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

use Novosga\Entity\LotacaoInterface;
use Novosga\Entity\UsuarioInterface;
use Novosga\Entity\UnidadeInterface;
use Novosga\Entity\PerfilInterface;

/**
 * Definição de onde o usuário está lotado
 *
 * @author Rogerio Lino <rogeriolino@gmail.com>
 */
class Lotacao implements LotacaoInterface, \JsonSerializable
{
    /**
     * @var int
     */
    private $id;
    
    /**
     * @var UsuarioInterface
     */
    private $usuario;

    /**
     * @var UnidadeInterface
     */
    private $unidade;

    /**
     * @var PerfilInterface
     */
    private $perfil;

    public function __construct()
    {
    }
    
    public function getId()
    {
        return $this->id;
    }

    /**
     * Modifica usuario.
     *
     * @param $usuario
     *
     * @return self
     */
    public function setUsuario(UsuarioInterface $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Retorna objeto usuario.
     *
     * @return UsuarioInterface
     */
    public function getUsuario(): UsuarioInterface
    {
        return $this->usuario;
    }

    /**
     * Modifica unidade.
     *
     * @param UnidadeInterface $unidade
     *
     * @return self
     */
    public function setUnidade(UnidadeInterface $unidade): self
    {
        $this->unidade = $unidade;

        return $this;
    }

    /**
     * Retorna objeto Unidade.
     *
     * @return UnidadeInterface
     */
    public function getUnidade(): UnidadeInterface
    {
        return $this->unidade;
    }

    /**
     * Modifica perfil.
     *
     * @param PerfilInterface $perfil
     *
     * @return self
     */
    public function setPerfil(PerfilInterface $perfil): self
    {
        $this->perfil = $perfil;

        return $this;
    }

    /**
     * Retorna objeto Perfil.
     *
     * @return PerfilInterface
     */
    public function getPerfil(): PerfilInterface
    {
        return $this->perfil;
    }

    public function jsonSerialize()
    {
        return [
            'id'      => $this->getId(),
            'perfil'  => $this->getPerfil(),
            'unidade' => $this->getUnidade(),
            'usuario' => $this->getUsuario(),
        ];
    }
}

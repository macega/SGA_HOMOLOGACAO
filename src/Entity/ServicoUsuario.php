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

use Novosga\Entity\ServicoUsuarioInterface;
use Novosga\Entity\ServicoInterface;
use Novosga\Entity\UnidadeInterface;
use Novosga\Entity\UsuarioInterface;

/**
 * Servico Usuario
 * Configuração do serviço que o usuário atende
 *
 * @author Rogerio Lino <rogeriolino@gmail.com>
 */
class ServicoUsuario implements ServicoUsuarioInterface, \JsonSerializable
{
    /**
     * @var ServicoInterface
     */
    private $servico;

    /**
     * @var UnidadeInterface
     */
    private $unidade;

    /**
     * @var UsuarioInterface
     */
    private $usuario;

    /**
     * @var int
     */
    private $peso;

    public function __construct()
    {
    }
    
    public function getServico(): ServicoInterface
    {
        return $this->servico;
    }

    public function setServico(ServicoInterface $servico): self
    {
        $this->servico = $servico;

        return $this;
    }

    public function getUnidade(): UnidadeInterface
    {
        return $this->unidade;
    }

    public function setUnidade(UnidadeInterface $unidade): self
    {
        $this->unidade = $unidade;

        return $this;
    }

    /**
     * @return Usuario
     */
    public function getUsuario(): UsuarioInterface
    {
        return $this->usuario;
    }

    public function setUsuario(UsuarioInterface $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }
    
    public function getPeso(): int
    {
        return $this->peso;
    }

    public function setPeso(int $peso): self
    {
        $this->peso = $peso;
        
        return $this;
    }
    
    public function jsonSerialize()
    {
        return [
            'peso'    => $this->getPeso(),
            'servico' => $this->getServico(),
        ];
    }
}

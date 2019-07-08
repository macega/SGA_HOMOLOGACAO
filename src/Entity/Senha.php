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

use Novosga\Entity\SenhaInterface;

/**
 * Classe Senha
 * Responsavel pelas informacoes do Senha.
 *
 * @author Rogério Lino <rogeriolino@gmail.com>
 */
class Senha implements SenhaInterface, \JsonSerializable
{
    /**
     * @var string
     */
    private $sigla;

    /**
     * @var int
     */
    private $numero;

    public function __construct()
    {
    }

    /**
     * Define a sigla da senha.
     *
     * @param string $sigla
     */
    public function setSigla(string $sigla): self
    {
        $this->sigla = $sigla;

        return $this;
    }

    /**
     * Retorna a sigla da senha.
     *
     * @return string
     */
    public function getSigla(): string
    {
        return $this->sigla;
    }

    /**
     * Define o numero da senha.
     *
     * @param int $numero
     */
    public function setNumero(int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Retorna o numero da senha.
     *
     * @return int
     */
    public function getNumero(): int
    {
        return $this->numero;
    }

    /**
     * Retorna o numero da senha preenchendo com zero (esquerda).
     *
     * @return string
     */
    public function getNumeroZeros(): string
    {
        return str_pad($this->getNumero(), self::LENGTH, '0', STR_PAD_LEFT);
    }

    /**
     * Retorna a senha formatada para exibicao.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getSigla() . $this->getNumeroZeros();
    }
    
    public function jsonSerialize()
    {
        return [
            'sigla'  => $this->getSigla(),
            'numero' => $this->getNumero(),
            'format' => $this->__toString(),
        ];
    }
}

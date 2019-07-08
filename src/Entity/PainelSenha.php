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

use Novosga\Entity\PainelSenhaInterface;
use Novosga\Entity\ServicoInterface;
use Novosga\Entity\UnidadeInterface;
use Novosga\Entity\LocalInterface;
use Novosga\Entity\PrioridadeInterface;

/**
  * Senha enviada ao painel
  *
  * @author Rogerio Lino <rogeriolino@gmail.com>
  */
class PainelSenha implements PainelSenhaInterface, \JsonSerializable
{
    /**
     * @var mixed
     */
    protected $id;
    
    /**
     * @var Servico
     */
    private $servico;

    /**
     * @var Unidade
     */
    private $unidade;

    /**
     * @var int
     */
    private $numeroSenha;

    /**
     * @var string
     */
    private $siglaSenha;

    /**
     * @var string
     */
    private $mensagem;

    /**
     * @var string
     */
    private $local;

    /**
     * @var int
     */
    private $numeroLocal;

    /**
     * @var int
     */
    private $peso;

    /**
     * @var string
     */
    private $prioridade;

    /**
     * @var string
     */
    private $nomeCliente;

    /**
     * @var string
     */
    private $documentoCliente;

    public function getId()
    {
        return $this->id;
    }

    public function getServico(): ServicoInterface
    {
        return $this->servico;
    }

    public function setServico($servico): self
    {
        $this->servico = $servico;

        return $this;
    }

    public function getUnidade(): UnidadeInterface
    {
        return $this->unidade;
    }

    public function setUnidade($unidade): self
    {
        $this->unidade = $unidade;

        return $this;
    }

    public function getNumeroSenha(): int
    {
        return $this->numeroSenha;
    }

    public function setNumeroSenha($numeroSenha): self
    {
        $this->numeroSenha = $numeroSenha;

        return $this;
    }

    public function getSiglaSenha(): string
    {
        return $this->siglaSenha;
    }

    public function setSiglaSenha($siglaSenha): self
    {
        $this->siglaSenha = $siglaSenha;

        return $this;
    }

    public function getMensagem(): string
    {
        return $this->mensagem;
    }

    public function setMensagem($mensagem): self
    {
        $this->mensagem = $mensagem;

        return $this;
    }

    public function getLocal(): string
    {
        return $this->local;
    }

    public function setLocal($local): self
    {
        $this->local = $local;

        return $this;
    }

    public function getNumeroLocal(): int
    {
        return $this->numeroLocal;
    }

    public function setNumeroLocal($numeroLocal): self
    {
        $this->numeroLocal = $numeroLocal;

        return $this;
    }

    public function getPeso(): int
    {
        return $this->peso;
    }

    public function setPeso($peso): self
    {
        $this->peso = $peso;

        return $this;
    }

    public function getPrioridade(): string
    {
        return $this->prioridade;
    }

    public function getNomeCliente(): string
    {
        return $this->nomeCliente;
    }

    public function getDocumentoCliente(): string
    {
        return $this->documentoCliente;
    }

    public function setPrioridade($prioridade): self
    {
        $this->prioridade = $prioridade;

        return $this;
    }

    public function setNomeCliente($nomeCliente): self
    {
        $this->nomeCliente = $nomeCliente;

        return $this;
    }

    public function setDocumentoCliente($documentoCliente): self
    {
        $this->documentoCliente = $documentoCliente;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
           'id'               => $this->getId(),
           'senha'            => $this->getSiglaSenha().str_pad($this->getNumeroSenha(), 3, '0', STR_PAD_LEFT),
           'local'            => $this->getLocal(),
           'numeroLocal'      => $this->getNumeroLocal(),
           'peso'             => $this->getPeso(),
           'prioridade'       => $this->getPrioridade(),
           'nomeCliente'      => $this->getNomeCliente(),
           'documentoCliente' => $this->getDocumentoCliente(),
        ];
    }
}

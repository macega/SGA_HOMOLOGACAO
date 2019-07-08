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

use Novosga\Entity\ConfiguracaoImpressaoInterface;
use Novosga\Entity\UnidadeInterface;

class ConfiguracaoImpressao implements ConfiguracaoImpressaoInterface, \JsonSerializable
{
    /**
     * @var UnidadeInterface
     */
    private $unidade;
    
    /**
     * @var string
     */
    private $cabecalho;
    
    /**
     * @var string
     */
    private $rodape;
    
    /**
     * @var bool
     */
    private $exibirNomeServico;
    
    /**
     * @var bool
     */
    private $exibirNomeUnidade;
    
    /**
     * @var bool
     */
    private $exibirMensagemServico;
    
    /**
     * @var bool
     */
    private $exibirData;
    
    /**
     * @var bool
     */
    private $exibirPrioridade;
    
    public function __construct(Unidade $unidade)
    {
        $this->unidade    = $unidade;
        $this->cabecalho  = 'Novo SGA';
        $this->rodape     = 'Novo SGA';
        $this->exibirData = true;
        $this->exibirMensagemServico = true;
        $this->exibirNomeServico     = true;
        $this->exibirNomeUnidade     = true;
        $this->exibirPrioridade      = true;
    }
    
    public function getUnidade(): UnidadeInterface
    {
        return $this->unidade;
    }

    public function getCabecalho(): string
    {
        return $this->cabecalho;
    }

    public function getRodape(): string
    {
        return $this->rodape;
    }

    public function getExibirNomeServico(): bool
    {
        return $this->exibirNomeServico;
    }

    public function getExibirNomeUnidade(): bool
    {
        return $this->exibirNomeUnidade;
    }

    public function getExibirMensagemServico(): bool
    {
        return $this->exibirMensagemServico;
    }

    public function getExibirData(): bool
    {
        return $this->exibirData;
    }

    public function getExibirPrioridade(): bool
    {
        return $this->exibirPrioridade;
    }

    public function setUnidade(UnidadeInterface $unidade): self
    {
        $this->unidade = $unidade;

        return $this;
    }

    public function setCabecalho(string $cabecalho): self
    {
        $this->cabecalho = $cabecalho;

        return $this;
    }

    public function setRodape(string $rodape): self
    {
        $this->rodape = $rodape;

        return $this;
    }

    public function setExibirNomeServico(bool $exibirNomeServico): self
    {
        $this->exibirNomeServico = $exibirNomeServico;

        return $this;
    }

    public function setExibirNomeUnidade(bool $exibirNomeUnidade): self
    {
        $this->exibirNomeUnidade = $exibirNomeUnidade;

        return $this;
    }

    public function setExibirMensagemServico(bool $exibirMensagemServico): self
    {
        $this->exibirMensagemServico = $exibirMensagemServico;

        return $this;
    }

    public function setExibirData(bool $exibirData): self
    {
        $this->exibirData = $exibirData;

        return $this;
    }

    public function setExibirPrioridade(bool $exibirPrioridade): self
    {
        $this->exibirPrioridade = $exibirPrioridade;
        
        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'cabecalho'             => $this->getCabecalho(),
            'rodape'                => $this->getRodape(),
            'exibirData'            => $this->getExibirData(),
            'exibirPrioridade'      => $this->getExibirPrioridade(),
            'exibirNomeUnidade'     => $this->getExibirNomeUnidade(),
            'exibirNomeServico'     => $this->getExibirNomeServico(),
            'exibirMensagemServico' => $this->getExibirMensagemServico(),
        ];
    }
}

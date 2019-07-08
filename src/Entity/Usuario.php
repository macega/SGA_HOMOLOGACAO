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

use DateTime;
use DateTimeInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\Encoder\EncoderAwareInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Novosga\Entity\UsuarioInterface;
use Novosga\Entity\LotacaoInterface;

/**
 * Usuario
 *
 * @author Rogerio Lino <rogeriolino@gmail.com>
 */
class Usuario implements
    UsuarioInterface,
    \Serializable,
    \JsonSerializable,
    UserInterface,
    EquatableInterface,
    EncoderAwareInterface
{
    /**
     * @var mixed
     */
    protected $id;

    /**
     * @var string
     */
    private $login;

    /**
     * @var string
     */
    private $nome;

    /**
     * @var string
     */
    private $sobrenome;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $senha;

    /**
     * @var bool
     */
    private $ativo;

    /**
     * @var DateTimeInterface
     */
    private $ultimoAcesso;

    /**
     * @var string
     */
    private $ip;

    /**
     * @var string
     */
    private $sessionId;

    /**
     * @var Lotacao[]
     */
    private $lotacoes;

    /**
     * @var Lotacao
     */
    private $lotacao;

    /**
     * @var bool
     */
    private $admin;

    /**
     * @var string
     */
    private $algorithm;

    /**
     * @var string
     */
    private $salt;

    /**
     * @var array
     */
    private $roles = [];

    /**
     * @var DateTimeInterface
     */
    private $createdAt;

    /**
     * @var DateTimeInterface
     */
    private $updatedAt;

    /**
     * @var DateTimeInterface
     */
    private $deletedAt;

    public function __construct()
    {
        $this->ativo = true;
        $this->createdAt = new DateTime();
        $this->lotacoes = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    public function setLogin($login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function setNome($nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setSobrenome(?string $sobrenome): self
    {
        $this->sobrenome = $sobrenome;

        return $this;
    }

    public function getSobrenome(): ?string
    {
        return $this->sobrenome;
    }

    /**
     * Retorna o nome completo do usuario (nome + sobrenome).
     *
     * @return string
     */
    public function getNomeCompleto(): string
    {
        return $this->nome . ' ' . $this->sobrenome;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;
        
        return $this;
    }

    public function getSenha(): string
    {
        return $this->senha;
    }

    public function setSenha(string $senha): self
    {
        $this->senha = $senha;

        return $this;
    }

    public function setAtivo(bool $ativo): self
    {
        $this->ativo = $ativo;

        return $this;
    }

    public function getLotacao(): ?LotacaoInterface
    {
        return $this->lotacao;
    }

    public function setLotacao(?LotacaoInterface $lotacao): self
    {
        $this->lotacao = $lotacao;

        return $this;
    }

    public function getLotacoes(): Collection
    {
        return $this->lotacoes;
    }

    public function setSalt($salt): self
    {
        $this->salt = $salt;

        return $this;
    }

    public function setLotacoes($lotacoes): self
    {
        $this->lotacoes = $lotacoes;

        return $this;
    }

    public function addLotacoe(Lotacao $lotacao): self
    {
        $lotacao->setUsuario($this);
        $this->getLotacoes()->add($lotacao);

        return $this;
    }

    public function removeLotacoe(Lotacao $lotacao): self
    {
        $this->getLotacoes()->removeElement($lotacao);

        return $this;
    }

    public function isAtivo(): bool
    {
        return (bool) $this->ativo;
    }

    public function getUltimoAcesso(): ?DateTimeInterface
    {
        return $this->ultimoAcesso;
    }

    public function setUltimoAcesso(?DateTimeInterface $ultimoAcesso): self
    {
        $this->ultimoAcesso = $ultimoAcesso;

        return $this;
    }

    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function setIp(?string $ip): self
    {
        $this->ip = $ip;

        return $this;
    }

    public function getSessionId(): ?string
    {
        return $this->sessionId;
    }

    public function setSessionId(?string $sessionId): self
    {
        $this->sessionId = $sessionId;

        return $this;
    }

    public function getAlgorithm()
    {
        return $this->algorithm;
    }

    public function setAlgorithm($algorithm): self
    {
        $this->algorithm = $algorithm;

        return $this;
    }

    public function isAdmin(): bool
    {
        return $this->admin;
    }

    public function setAdmin($admin): self
    {
        $this->admin = $admin;

        return $this;
    }

    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function getDeletedAt(): ?DateTimeInterface
    {
        return $this->deletedAt;
    }

    public function setCreatedAt(DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function setUpdatedAt(?DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function setDeletedAt(?DateTimeInterface $deletedAt): self
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    public function eraseCredentials()
    {
    }

    public function getPassword()
    {
        return $this->getSenha();
    }

    public function getRoles()
    {
        return $this->roles;
    }

    public function addRole($role): self
    {
        $this->roles[] = $role;

        return $this;
    }

    public function isEnabled(): bool
    {
        return !$this->getDeletedAt() && $this->isAtivo();
    }

    public function getSalt()
    {
        return $this->salt;
    }

    public function getUsername()
    {
        return $this->getLogin();
    }

    public function getEncoderName()
    {
        return $this->algorithm;
    }
    
    public function isEqualTo(UserInterface $user)
    {
        if (!$user instanceof Usuario) {
            return false;
        }

        if ($this->getPassword() !== $user->getPassword()) {
            return false;
        }

        if ($this->getSalt() !== $user->getSalt()) {
            return false;
        }

        if ($this->getUsername() !== $user->getUsername()) {
            return false;
        }

        if ($this->isEnabled() !== $user->isEnabled()) {
            return false;
        }

        if ($this->getSessionId() !== $user->getSessionId()) {
            return false;
        }
        
        return true;
    }

    public function serialize()
    {
        return serialize([
            $this->id,
            $this->login,
            $this->nome,
            $this->sessionId,
            $this->senha,
            $this->salt,
            $this->ativo,
        ]);
    }

    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->login,
            $this->nome,
            $this->sessionId,
            $this->senha,
            $this->salt,
            $this->ativo,
        ) = unserialize($serialized);
    }

    public function jsonSerialize()
    {
        return [
            'id'        => $this->getId(),
            'login'     => $this->getLogin(),
            'nome'      => $this->getNome(),
            'sobrenome' => $this->getSobrenome(),
            'ativo'     => $this->isAtivo(),
            'createdAt' => $this->getCreatedAt() ? $this->getCreatedAt()->format('Y-m-d\TH:i:s') : null,
            'updatedAt' => $this->getUpdatedAt() ? $this->getUpdatedAt()->format('Y-m-d\TH:i:s') : null,
            'deletedAt' => $this->getDeletedAt() ? $this->getDeletedAt()->format('Y-m-d\TH:i:s') : null,
        ];
    }

    public function __tostring()
    {
        return (string) $this->getLogin();
    }
}

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
use App\Entity\Usuario;

/**
 * AccessToken
 *
 * @author Rogerio Lino <rogeriolino@gmail.com>
 */
class AccessToken
{
    const API_READ   = 4;
    const API_WRITE  = 8;
    const API_CREATE = 16;
    const API_DELETE = 32;

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $token = '';

    /**
     * @var DateTimeInterface
     */
    private $createdAt;

    /**
     * @var DateTimeInterface
     */
    private $expiresAt;

    /**
     * @var DateTimeInterface
     */
    private $deletedAt;

    /**
     * @var DateTimeInterface
     */
    private $usedAt;

    /**
     * @var string
     */
    private $name = '';

    /**
     * @var int
     */
    private $permission = 0;

    public function __construct()
    {
        $this->createdAt = new DateTime;
    }

    /**
     * @var Usuario
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }
    

    /**
     * Get the value of name
     *
     * @return  string
     */ 
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param  string  $name
     *
     * @return  self
     */ 
    public function setName(?string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of deletedAt
     *
     * @return  DateTimeInterface
     */ 
    public function getDeletedAt(): ?DateTimeInterface
    {
        return $this->deletedAt;
    }

    /**
     * Set the value of deletedAt
     *
     * @param  DateTimeInterface  $deletedAt
     *
     * @return  self
     */ 
    public function setDeletedAt(?DateTimeInterface $deletedAt)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * Get the value of expiresAt
     *
     * @return  DateTimeInterface
     */ 
    public function getExpiresAt(): ?DateTimeInterface
    {
        return $this->expiresAt;
    }

    /**
     * Set the value of expiresAt
     *
     * @param  DateTimeInterface  $expiresAt
     *
     * @return  self
     */ 
    public function setExpiresAt(?DateTimeInterface $expiresAt)
    {
        $this->expiresAt = $expiresAt;

        return $this;
    }

    /**
     * Get the value of createdAt
     *
     * @return  DateTimeInterface
     */ 
    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * Set the value of createdAt
     *
     * @param  DateTimeInterface  $createdAt
     *
     * @return  self
     */ 
    public function setCreatedAt(DateTimeInterface $createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get the value of usedAt
     *
     * @return  DateTimeInterface
     */ 
    public function getUsedAt(): ?DateTimeInterface
    {
        return $this->usedAt;
    }

    /**
     * Set the value of usedAt
     *
     * @param  DateTimeInterface  $usedAt
     *
     * @return  self
     */ 
    public function setUsedAt(?DateTimeInterface $usedAt)
    {
        $this->usedAt = $usedAt;

        return $this;
    }

    /**
     * Get the value of token
     *
     * @return  string
     */ 
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * Set the value of token
     *
     * @param  string  $token
     *
     * @return  self
     */ 
    public function setToken(string $token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get the bitwise permission
     *
     * @return int
     */
    public function getPermission(): int
    {
        return $this->permission;
    }

    /**
     * Set the bitwise permission
     *
     * @param  int $permission
     *
     * @return  self
     */ 
    public function setPermission(int $permission)
    {
        $this->permission = $permission;

        return $this;
    }

    /**
     * @return Usuario
     */
    public function getUser(): ?Usuario
    {
        return $this->user;
    }

    /**
     * @param  Usuario $user
     *
     * @return  self
     */ 
    public function setUser(Usuario $user)
    {
        $this->user = $user;

        return $this;
    }
}

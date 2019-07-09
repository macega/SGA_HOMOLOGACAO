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

use DateTimeInterface;
use App\Entity\Usuario;

/**
 * UserMessage
 *
 * @author Rogerio Lino <rogeriolino@gmail.com>
 */
class UserMessage
{
    /**
     * @var Usuario
     */
    private $user;

    /**
     * @var Message
     */
    private $message;

    /**
     * @var DateTimeInterface
     */
    private $readAt;

    /**
     * @var DateTimeInterface
     */
    private $deletedAt;

    public function getUser(): ?Usuario
    {
        return $this->user;
    }

    public function getMessage(): ?Message
    {
        return $this->message;
    }

    public function getReadAt(): ?DateTimeInterface
    {
        return $this->readAt;
    }

    public function getDeletedAt(): ?DateTimeInterface
    {
        return $this->deletedAt;
    }

    public function setUser(?Usuario $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function setMessage(?Message $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function setReadAt(?string $readAt): self
    {
        $this->readAt = $readAt;

        return $this;
    }

    public function setDeletedAt(?string $deletedAt): self
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }
}

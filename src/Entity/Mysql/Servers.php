<?php

namespace App\Entity\Mysql;

use Doctrine\ORM\Mapping as ORM;

/**
 * Servers
 *
 * @ORM\Table(name="servers")
 * @ORM\Entity
 */
class Servers
{
    /**
     * @var string
     *
     * @ORM\Column(name="Server_name", type="string", length=64, nullable=false, options={"fixed"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $serverName = '';

    /**
     * @var string
     *
     * @ORM\Column(name="Host", type="string", length=64, nullable=false, options={"fixed"=true})
     */
    private $host = '';

    /**
     * @var string
     *
     * @ORM\Column(name="Db", type="string", length=64, nullable=false, options={"fixed"=true})
     */
    private $db = '';

    /**
     * @var string
     *
     * @ORM\Column(name="Username", type="string", length=80, nullable=false, options={"fixed"=true})
     */
    private $username = '';

    /**
     * @var string
     *
     * @ORM\Column(name="Password", type="string", length=64, nullable=false, options={"fixed"=true})
     */
    private $password = '';

    /**
     * @var int
     *
     * @ORM\Column(name="Port", type="integer", nullable=false)
     */
    private $port = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="Socket", type="string", length=64, nullable=false, options={"fixed"=true})
     */
    private $socket = '';

    /**
     * @var string
     *
     * @ORM\Column(name="Wrapper", type="string", length=64, nullable=false, options={"fixed"=true})
     */
    private $wrapper = '';

    /**
     * @var string
     *
     * @ORM\Column(name="Owner", type="string", length=64, nullable=false, options={"fixed"=true})
     */
    private $owner = '';

    public function getServerName(): ?string
    {
        return $this->serverName;
    }

    public function getHost(): ?string
    {
        return $this->host;
    }

    public function setHost(string $host): self
    {
        $this->host = $host;

        return $this;
    }

    public function getDb(): ?string
    {
        return $this->db;
    }

    public function setDb(string $db): self
    {
        $this->db = $db;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getPort(): ?int
    {
        return $this->port;
    }

    public function setPort(int $port): self
    {
        $this->port = $port;

        return $this;
    }

    public function getSocket(): ?string
    {
        return $this->socket;
    }

    public function setSocket(string $socket): self
    {
        $this->socket = $socket;

        return $this;
    }

    public function getWrapper(): ?string
    {
        return $this->wrapper;
    }

    public function setWrapper(string $wrapper): self
    {
        $this->wrapper = $wrapper;

        return $this;
    }

    public function getOwner(): ?string
    {
        return $this->owner;
    }

    public function setOwner(string $owner): self
    {
        $this->owner = $owner;

        return $this;
    }


}

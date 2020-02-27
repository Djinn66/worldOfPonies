<?php

namespace App\Entity\Mysql;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProxiesPriv
 *
 * @ORM\Table(name="proxies_priv", indexes={@ORM\Index(name="Grantor", columns={"Grantor"})})
 * @ORM\Entity
 */
class ProxiesPriv
{
    /**
     * @var string
     *
     * @ORM\Column(name="Host", type="string", length=60, nullable=false, options={"fixed"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $host = '';

    /**
     * @var string
     *
     * @ORM\Column(name="User", type="string", length=80, nullable=false, options={"fixed"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $user = '';

    /**
     * @var string
     *
     * @ORM\Column(name="Proxied_host", type="string", length=60, nullable=false, options={"fixed"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $proxiedHost = '';

    /**
     * @var string
     *
     * @ORM\Column(name="Proxied_user", type="string", length=80, nullable=false, options={"fixed"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $proxiedUser = '';

    /**
     * @var bool
     *
     * @ORM\Column(name="With_grant", type="boolean", nullable=false)
     */
    private $withGrant = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="Grantor", type="string", length=141, nullable=false, options={"fixed"=true})
     */
    private $grantor = '';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Timestamp", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $timestamp = 'CURRENT_TIMESTAMP';

    public function getHost(): ?string
    {
        return $this->host;
    }

    public function getUser(): ?string
    {
        return $this->user;
    }

    public function getProxiedHost(): ?string
    {
        return $this->proxiedHost;
    }

    public function getProxiedUser(): ?string
    {
        return $this->proxiedUser;
    }

    public function getWithGrant(): ?bool
    {
        return $this->withGrant;
    }

    public function setWithGrant(bool $withGrant): self
    {
        $this->withGrant = $withGrant;

        return $this;
    }

    public function getGrantor(): ?string
    {
        return $this->grantor;
    }

    public function setGrantor(string $grantor): self
    {
        $this->grantor = $grantor;

        return $this;
    }

    public function getTimestamp(): ?\DateTimeInterface
    {
        return $this->timestamp;
    }

    public function setTimestamp(\DateTimeInterface $timestamp): self
    {
        $this->timestamp = $timestamp;

        return $this;
    }


}

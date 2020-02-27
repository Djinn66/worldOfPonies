<?php

namespace App\Entity\Mysql;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProcsPriv
 *
 * @ORM\Table(name="procs_priv", indexes={@ORM\Index(name="Grantor", columns={"Grantor"})})
 * @ORM\Entity
 */
class ProcsPriv
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
     * @ORM\Column(name="Db", type="string", length=64, nullable=false, options={"fixed"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $db = '';

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
     * @ORM\Column(name="Routine_name", type="string", length=64, nullable=false, options={"fixed"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $routineName = '';

    /**
     * @var string
     *
     * @ORM\Column(name="Routine_type", type="string", length=0, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $routineType;

    /**
     * @var string
     *
     * @ORM\Column(name="Grantor", type="string", length=141, nullable=false, options={"fixed"=true})
     */
    private $grantor = '';

    /**
     * @var string
     *
     * @ORM\Column(name="Proc_priv", type="string", length=0, nullable=false)
     */
    private $procPriv = '';

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

    public function getDb(): ?string
    {
        return $this->db;
    }

    public function getUser(): ?string
    {
        return $this->user;
    }

    public function getRoutineName(): ?string
    {
        return $this->routineName;
    }

    public function getRoutineType(): ?string
    {
        return $this->routineType;
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

    public function getProcPriv(): ?string
    {
        return $this->procPriv;
    }

    public function setProcPriv(string $procPriv): self
    {
        $this->procPriv = $procPriv;

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

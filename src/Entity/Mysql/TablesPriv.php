<?php

namespace App\Entity\Mysql;

use Doctrine\ORM\Mapping as ORM;

/**
 * TablesPriv
 *
 * @ORM\Table(name="tables_priv", indexes={@ORM\Index(name="Grantor", columns={"Grantor"})})
 * @ORM\Entity
 */
class TablesPriv
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
     * @ORM\Column(name="Table_name", type="string", length=64, nullable=false, options={"fixed"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $tableName = '';

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

    /**
     * @var string
     *
     * @ORM\Column(name="Table_priv", type="string", length=0, nullable=false)
     */
    private $tablePriv = '';

    /**
     * @var string
     *
     * @ORM\Column(name="Column_priv", type="string", length=0, nullable=false)
     */
    private $columnPriv = '';

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

    public function getTableName(): ?string
    {
        return $this->tableName;
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

    public function getTablePriv(): ?string
    {
        return $this->tablePriv;
    }

    public function setTablePriv(string $tablePriv): self
    {
        $this->tablePriv = $tablePriv;

        return $this;
    }

    public function getColumnPriv(): ?string
    {
        return $this->columnPriv;
    }

    public function setColumnPriv(string $columnPriv): self
    {
        $this->columnPriv = $columnPriv;

        return $this;
    }


}

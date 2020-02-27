<?php

namespace App\Entity\Mysql;

use Doctrine\ORM\Mapping as ORM;

/**
 * ColumnsPriv
 *
 * @ORM\Table(name="columns_priv")
 * @ORM\Entity
 */
class ColumnsPriv
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
     * @ORM\Column(name="Column_name", type="string", length=64, nullable=false, options={"fixed"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $columnName = '';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Timestamp", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $timestamp = 'CURRENT_TIMESTAMP';

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

    public function getColumnName(): ?string
    {
        return $this->columnName;
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

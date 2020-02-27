<?php

namespace App\Entity\Mysql;

use Doctrine\ORM\Mapping as ORM;

/**
 * InnodbIndexStats
 *
 * @ORM\Table(name="innodb_index_stats")
 * @ORM\Entity
 */
class InnodbIndexStats
{
    /**
     * @var string
     *
     * @ORM\Column(name="database_name", type="string", length=64, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $databaseName;

    /**
     * @var string
     *
     * @ORM\Column(name="table_name", type="string", length=64, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $tableName;

    /**
     * @var string
     *
     * @ORM\Column(name="index_name", type="string", length=64, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $indexName;

    /**
     * @var string
     *
     * @ORM\Column(name="stat_name", type="string", length=64, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $statName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_update", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $lastUpdate = 'CURRENT_TIMESTAMP';

    /**
     * @var int
     *
     * @ORM\Column(name="stat_value", type="bigint", nullable=false, options={"unsigned"=true})
     */
    private $statValue;

    /**
     * @var int|null
     *
     * @ORM\Column(name="sample_size", type="bigint", nullable=true, options={"unsigned"=true})
     */
    private $sampleSize;

    /**
     * @var string
     *
     * @ORM\Column(name="stat_description", type="string", length=1024, nullable=false)
     */
    private $statDescription;

    public function getDatabaseName(): ?string
    {
        return $this->databaseName;
    }

    public function getTableName(): ?string
    {
        return $this->tableName;
    }

    public function getIndexName(): ?string
    {
        return $this->indexName;
    }

    public function getStatName(): ?string
    {
        return $this->statName;
    }

    public function getLastUpdate(): ?\DateTimeInterface
    {
        return $this->lastUpdate;
    }

    public function setLastUpdate(\DateTimeInterface $lastUpdate): self
    {
        $this->lastUpdate = $lastUpdate;

        return $this;
    }

    public function getStatValue(): ?string
    {
        return $this->statValue;
    }

    public function setStatValue(string $statValue): self
    {
        $this->statValue = $statValue;

        return $this;
    }

    public function getSampleSize(): ?string
    {
        return $this->sampleSize;
    }

    public function setSampleSize(?string $sampleSize): self
    {
        $this->sampleSize = $sampleSize;

        return $this;
    }

    public function getStatDescription(): ?string
    {
        return $this->statDescription;
    }

    public function setStatDescription(string $statDescription): self
    {
        $this->statDescription = $statDescription;

        return $this;
    }


}

<?php

namespace App\Entity\Mysql;

use Doctrine\ORM\Mapping as ORM;

/**
 * TableStats
 *
 * @ORM\Table(name="table_stats")
 * @ORM\Entity
 */
class TableStats
{
    /**
     * @var string
     *
     * @ORM\Column(name="db_name", type="string", length=64, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $dbName;

    /**
     * @var string
     *
     * @ORM\Column(name="table_name", type="string", length=64, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $tableName;

    /**
     * @var int|null
     *
     * @ORM\Column(name="cardinality", type="bigint", nullable=true, options={"unsigned"=true})
     */
    private $cardinality;

    public function getDbName(): ?string
    {
        return $this->dbName;
    }

    public function getTableName(): ?string
    {
        return $this->tableName;
    }

    public function getCardinality(): ?string
    {
        return $this->cardinality;
    }

    public function setCardinality(?string $cardinality): self
    {
        $this->cardinality = $cardinality;

        return $this;
    }


}

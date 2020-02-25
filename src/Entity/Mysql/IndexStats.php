<?php

namespace App\Entity\Mysql;

use Doctrine\ORM\Mapping as ORM;

/**
 * IndexStats
 *
 * @ORM\Table(name="index_stats")
 * @ORM\Entity
 */
class IndexStats
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
     * @var string
     *
     * @ORM\Column(name="index_name", type="string", length=64, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $indexName;

    /**
     * @var int
     *
     * @ORM\Column(name="prefix_arity", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $prefixArity;

    /**
     * @var string|null
     *
     * @ORM\Column(name="avg_frequency", type="decimal", precision=12, scale=4, nullable=true)
     */
    private $avgFrequency;


}

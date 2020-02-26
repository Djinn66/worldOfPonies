<?php

namespace App\Entity\Mysql;

use Doctrine\ORM\Mapping as ORM;

/**
 * InnodbTableStats
 *
 * @ORM\Table(name="innodb_table_stats")
 * @ORM\Entity
 */
class InnodbTableStats
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
     * @var \DateTime
     *
     * @ORM\Column(name="last_update", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $lastUpdate = 'CURRENT_TIMESTAMP';

    /**
     * @var int
     *
     * @ORM\Column(name="n_rows", type="bigint", nullable=false, options={"unsigned"=true})
     */
    private $nRows;

    /**
     * @var int
     *
     * @ORM\Column(name="clustered_index_size", type="bigint", nullable=false, options={"unsigned"=true})
     */
    private $clusteredIndexSize;

    /**
     * @var int
     *
     * @ORM\Column(name="sum_of_other_index_sizes", type="bigint", nullable=false, options={"unsigned"=true})
     */
    private $sumOfOtherIndexSizes;


}
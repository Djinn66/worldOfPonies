<?php

namespace App\Entity\Mysql;

use Doctrine\ORM\Mapping as ORM;

/**
 * GtidSlavePos
 *
 * @ORM\Table(name="gtid_slave_pos")
 * @ORM\Entity
 */
class GtidSlavePos
{
    /**
     * @var int
     *
     * @ORM\Column(name="domain_id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $domainId;

    /**
     * @var int
     *
     * @ORM\Column(name="sub_id", type="bigint", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $subId;

    /**
     * @var int
     *
     * @ORM\Column(name="server_id", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $serverId;

    /**
     * @var int
     *
     * @ORM\Column(name="seq_no", type="bigint", nullable=false, options={"unsigned"=true})
     */
    private $seqNo;


}

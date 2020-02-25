<?php

namespace App\Entity\Mysql;

use Doctrine\ORM\Mapping as ORM;

/**
 * TimeZoneName
 *
 * @ORM\Table(name="time_zone_name")
 * @ORM\Entity
 */
class TimeZoneName
{
    /**
     * @var string
     *
     * @ORM\Column(name="Name", type="string", length=64, nullable=false, options={"fixed"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="Time_zone_id", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $timeZoneId;


}

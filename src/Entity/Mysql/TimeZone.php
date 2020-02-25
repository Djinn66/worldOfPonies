<?php

namespace App\Entity\Mysql;

use Doctrine\ORM\Mapping as ORM;

/**
 * TimeZone
 *
 * @ORM\Table(name="time_zone")
 * @ORM\Entity
 */
class TimeZone
{
    /**
     * @var int
     *
     * @ORM\Column(name="Time_zone_id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $timeZoneId;

    /**
     * @var string
     *
     * @ORM\Column(name="Use_leap_seconds", type="string", length=0, nullable=false, options={"default"="N"})
     */
    private $useLeapSeconds = 'N';


}

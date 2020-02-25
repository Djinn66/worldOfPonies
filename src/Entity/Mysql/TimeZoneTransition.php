<?php

namespace App\Entity\Mysql;

use Doctrine\ORM\Mapping as ORM;

/**
 * TimeZoneTransition
 *
 * @ORM\Table(name="time_zone_transition")
 * @ORM\Entity
 */
class TimeZoneTransition
{
    /**
     * @var int
     *
     * @ORM\Column(name="Time_zone_id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $timeZoneId;

    /**
     * @var int
     *
     * @ORM\Column(name="Transition_time", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $transitionTime;

    /**
     * @var int
     *
     * @ORM\Column(name="Transition_type_id", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $transitionTypeId;


}

<?php

namespace App\Entity\Mysql;

use Doctrine\ORM\Mapping as ORM;

/**
 * TimeZoneTransitionType
 *
 * @ORM\Table(name="time_zone_transition_type")
 * @ORM\Entity
 */
class TimeZoneTransitionType
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
     * @ORM\Column(name="Transition_type_id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $transitionTypeId;

    /**
     * @var int
     *
     * @ORM\Column(name="Offset", type="integer", nullable=false)
     */
    private $offset = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="Is_DST", type="boolean", nullable=false)
     */
    private $isDst = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="Abbreviation", type="string", length=8, nullable=false, options={"fixed"=true})
     */
    private $abbreviation = '';


}

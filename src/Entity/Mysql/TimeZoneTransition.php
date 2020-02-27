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

    public function getTimeZoneId(): ?int
    {
        return $this->timeZoneId;
    }

    public function getTransitionTime(): ?string
    {
        return $this->transitionTime;
    }

    public function getTransitionTypeId(): ?int
    {
        return $this->transitionTypeId;
    }

    public function setTransitionTypeId(int $transitionTypeId): self
    {
        $this->transitionTypeId = $transitionTypeId;

        return $this;
    }


}

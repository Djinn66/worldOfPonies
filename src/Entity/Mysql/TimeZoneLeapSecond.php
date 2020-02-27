<?php

namespace App\Entity\Mysql;

use Doctrine\ORM\Mapping as ORM;

/**
 * TimeZoneLeapSecond
 *
 * @ORM\Table(name="time_zone_leap_second")
 * @ORM\Entity
 */
class TimeZoneLeapSecond
{
    /**
     * @var int
     *
     * @ORM\Column(name="Transition_time", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $transitionTime;

    /**
     * @var int
     *
     * @ORM\Column(name="Correction", type="integer", nullable=false)
     */
    private $correction;

    public function getTransitionTime(): ?string
    {
        return $this->transitionTime;
    }

    public function getCorrection(): ?int
    {
        return $this->correction;
    }

    public function setCorrection(int $correction): self
    {
        $this->correction = $correction;

        return $this;
    }


}

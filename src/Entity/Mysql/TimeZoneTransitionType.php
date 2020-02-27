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

    public function getTimeZoneId(): ?int
    {
        return $this->timeZoneId;
    }

    public function getTransitionTypeId(): ?int
    {
        return $this->transitionTypeId;
    }

    public function getOffset(): ?int
    {
        return $this->offset;
    }

    public function setOffset(int $offset): self
    {
        $this->offset = $offset;

        return $this;
    }

    public function getIsDst(): ?bool
    {
        return $this->isDst;
    }

    public function setIsDst(bool $isDst): self
    {
        $this->isDst = $isDst;

        return $this;
    }

    public function getAbbreviation(): ?string
    {
        return $this->abbreviation;
    }

    public function setAbbreviation(string $abbreviation): self
    {
        $this->abbreviation = $abbreviation;

        return $this;
    }


}

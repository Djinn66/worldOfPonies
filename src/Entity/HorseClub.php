<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HorseClub
 *
 * @ORM\Table(name="horse_club")
 * @ORM\Entity
 */
class HorseClub
{
    /**
     * @var int
     *
     * @ORM\Column(name="horse_club_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $horseClubId;

    /**
     * @var int
     *
     * @ORM\Column(name="horse_club_capacity", type="integer", nullable=false)
     */
    private $horseClubCapacity;

    public function getHorseClubId(): ?int
    {
        return $this->horseClubId;
    }

    public function getHorseClubCapacity(): ?int
    {
        return $this->horseClubCapacity;
    }

    public function setHorseClubCapacity(int $horseClubCapacity): self
    {
        $this->horseClubCapacity = $horseClubCapacity;

        return $this;
    }


}

<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * HorseClub
 *
 * @ORM\Table(name="horse_club", indexes={@ORM\Index(name="IDX_EA451F41FA2425B9", columns={"manager"})})
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

    /**
     * @var \Player
     *
     * @ORM\ManyToOne(targetEntity="Player")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="manager", referencedColumnName="player_id")
     * })
     */
    private $manager;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Player", mappedBy="horseclubs")
     */
    private $members;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->members = new \Doctrine\Common\Collections\ArrayCollection();
    }

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

    public function getManager(): ?Player
    {
        return $this->manager;
    }

    public function setManager(?Player $manager): self
    {
        $this->manager = $manager;

        return $this;
    }

    /**
     * @return Collection|Player[]
     */
    public function getMembers(): Collection
    {
        return $this->members;
    }

    public function addMember(Player $member): self
    {
        if (!$this->members->contains($member)) {
            $this->members[] = $member;
            $member->addHorseclub($this);
        }

        return $this;
    }

    public function removeMember(Player $member): self
    {
        if ($this->members->contains($member)) {
            $this->members->removeElement($member);
            $member->removeHorseclub($this);
        }

        return $this;
    }

}

<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Player", mappedBy="horseclubs")
     */
    private $members;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Infrastructure", mappedBy="horseclub")
     */
    private $infrastructures;

    /**
     * @var \Player
     *
     * @ORM\ManyToOne(targetEntity="Player", inversedBy="horseClubsToManage")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="manager", referencedColumnName="player_id", nullable=false)
     * })
     */
    private $manager;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Contest", mappedBy="horseclub", orphanRemoval=true)
     */
    private $contests;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->members = new \Doctrine\Common\Collections\ArrayCollection();
        $this->infrastructures = new ArrayCollection();
        $this->contests = new ArrayCollection();
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

    /**
     * @return Collection|Infrastructure[]
     */
    public function getInfrastructures(): Collection
    {
        return $this->infrastructures;
    }

    public function addInfrastructure(Infrastructure $infrastructure): self
    {
        if (!$this->infrastructures->contains($infrastructure)) {
            $this->infrastructures[] = $infrastructure;
            $infrastructure->setHorseclub($this);
        }

        return $this;
    }

    public function removeInfrastructure(Infrastructure $infrastructure): self
    {
        if ($this->infrastructures->contains($infrastructure)) {
            $this->infrastructures->removeElement($infrastructure);
            // set the owning side to null (unless already changed)
            if ($infrastructure->getHorseclub() === $this) {
                $infrastructure->setHorseclub(null);
            }
        }

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
     * @return Collection|Contest[]
     */
    public function getContests(): Collection
    {
        return $this->contests;
    }

    public function addContest(Contest $contest): self
    {
        if (!$this->contests->contains($contest)) {
            $this->contests[] = $contest;
            $contest->setHorseclub($this);
        }

        return $this;
    }

    public function removeContest(Contest $contest): self
    {
        if ($this->contests->contains($contest)) {
            $this->contests->removeElement($contest);
            // set the owning side to null (unless already changed)
            if ($contest->getHorseclub() === $this) {
                $contest->setHorseclub(null);
            }
        }

        return $this;
    }

}

<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Contest
 *
 * @ORM\Table(name="contest")
 * @ORM\Entity
 */
class Contest
{
    /**
     * @var int
     *
     * @ORM\Column(name="contest_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $contestId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_date", type="date", nullable=false)
     */
    private $startDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_date", type="date", nullable=false)
     */
    private $endDate;

    /**
     * @var int
     *
     * @ORM\Column(name="price", type="integer", nullable=false)
     */
    private $price;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Player", mappedBy="contests")
     */
    private $players;

    /**
     * @var \HorseClub
     *
     * @ORM\ManyToOne(targetEntity="HorseClub", inversedBy="contests")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="horseclub", referencedColumnName="horse_club_id", nullable=false)
     * })
     */
    private $horseclub;

    /**
     * @var \Infrastructure
     *
     * @ORM\ManyToOne(targetEntity="Infrastructure", inversedBy="contests")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="infrastructure", referencedColumnName="infrastructure_id", nullable=false)
     * })
     */
    private $infrastructure;

    /**
     * @var \Newspaper
     *
     * @ORM\ManyToOne(targetEntity="Newspaper", inversedBy="contests")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="newspaper", referencedColumnName="newspaper_id", nullable=false)
     * })
     */
    private $newspaper;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->players = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getContestId(): ?int
    {
        return $this->contestId;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection|Player[]
     */
    public function getPlayers(): Collection
    {
        return $this->players;
    }

    public function addPlayer(Player $player): self
    {
        if (!$this->players->contains($player)) {
            $this->players[] = $player;
            $player->addContest($this);
        }

        return $this;
    }

    public function removePlayer(Player $player): self
    {
        if ($this->players->contains($player)) {
            $this->players->removeElement($player);
            $player->removeContest($this);
        }

        return $this;
    }

    public function getHorseclub(): ?HorseClub
    {
        return $this->horseclub;
    }

    public function setHorseclub(?HorseClub $horseclub): self
    {
        $this->horseclub = $horseclub;

        return $this;
    }

    public function getInfrastructure(): ?Infrastructure
    {
        return $this->infrastructure;
    }

    public function setInfrastructure(?Infrastructure $infrastructure): self
    {
        $this->infrastructure = $infrastructure;

        return $this;
    }

    public function getNewspaper(): ?Newspaper
    {
        return $this->newspaper;
    }

    public function setNewspaper(?Newspaper $newspaper): self
    {
        $this->newspaper = $newspaper;

        return $this;
    }

}

<?php

namespace App\Entity\WorldOfPonies;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Newspaper
 *
 * @ORM\Table(name="newspaper", indexes={@ORM\Index(name="IDX_C6E2E68698197A65", columns={"player"})})
 * @ORM\Entity
 */
class Newspaper
{
    /**
     * @var int
     *
     * @ORM\Column(name="newspaper_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $newspaperId;

    /**
     * @var int
     *
     * @ORM\Column(name="weatherforecast", type="integer", nullable=false)
     */
    private $weatherforecast;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="release_date", type="date", nullable=false)
     */
    private $releaseDate;

    /**
     * @var \Player
     *
     * @ORM\ManyToOne(targetEntity="Player")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="player", referencedColumnName="player_id")
     * })
     */
    private $player;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Advertisement", inversedBy="newspapers")
     * @ORM\JoinTable(name="newspaper_advertisement_list",
     *   joinColumns={
     *     @ORM\JoinColumn(name="newspapers", referencedColumnName="newspaper_id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="advertisements", referencedColumnName="advertisement_id")
     *   }
     * )
     */
    private $advertisements;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->advertisements = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getNewspaperId(): ?int
    {
        return $this->newspaperId;
    }

    public function getWeatherforecast(): ?int
    {
        return $this->weatherforecast;
    }

    public function setWeatherforecast(int $weatherforecast): self
    {
        $this->weatherforecast = $weatherforecast;

        return $this;
    }

    public function getReleaseDate(): ?\DateTimeInterface
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(\DateTimeInterface $releaseDate): self
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    public function getPlayer(): ?Player
    {
        return $this->player;
    }

    public function setPlayer(?Player $player): self
    {
        $this->player = $player;

        return $this;
    }

    /**
     * @return Collection|Advertisement[]
     */
    public function getAdvertisements(): Collection
    {
        return $this->advertisements;
    }

    public function addAdvertisement(Advertisement $advertisement): self
    {
        if (!$this->advertisements->contains($advertisement)) {
            $this->advertisements[] = $advertisement;
        }

        return $this;
    }

    public function removeAdvertisement(Advertisement $advertisement): self
    {
        if ($this->advertisements->contains($advertisement)) {
            $this->advertisements->removeElement($advertisement);
        }

        return $this;
    }

}

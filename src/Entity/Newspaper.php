<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Newspaper
 *
 * @ORM\Table(name="newspaper")
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

    public function __construct()
    {
        $this->advertisements = new ArrayCollection();
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

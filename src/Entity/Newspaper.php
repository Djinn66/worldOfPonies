<?php

namespace App\Entity;

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


}

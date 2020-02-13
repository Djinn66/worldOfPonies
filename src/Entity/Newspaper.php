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

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Contest", mappedBy="newspaper")
     */
    private $contests;

    /**
     * @var \Player
     *
     * @ORM\ManyToOne(targetEntity="Player", inversedBy="newspapers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="player", referencedColumnName="player_id", nullable=false)
     * })
     */
    private $player;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Article", mappedBy="newspaper", orphanRemoval=true)
     */
    private $articles;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->advertisements = new \Doctrine\Common\Collections\ArrayCollection();
        $this->contests = new ArrayCollection();
        $this->articles = new ArrayCollection();
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
            $contest->setNewspaper($this);
        }

        return $this;
    }

    public function removeContest(Contest $contest): self
    {
        if ($this->contests->contains($contest)) {
            $this->contests->removeElement($contest);
            // set the owning side to null (unless already changed)
            if ($contest->getNewspaper() === $this) {
                $contest->setNewspaper(null);
            }
        }

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
     * @return Collection|Article[]
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Article $article): self
    {
        if (!$this->articles->contains($article)) {
            $this->articles[] = $article;
            $article->setNewspaper($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): self
    {
        if ($this->articles->contains($article)) {
            $this->articles->removeElement($article);
            // set the owning side to null (unless already changed)
            if ($article->getNewspaper() === $this) {
                $article->setNewspaper(null);
            }
        }

        return $this;
    }

}

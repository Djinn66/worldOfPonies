<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Advertisement
 *
 * @ORM\Table(name="advertisement")
 * @ORM\Entity
 */
class Advertisement
{
    /**
     * @var int
     *
     * @ORM\Column(name="advertisement_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $advertisementId;

    /**
     * @var string
     *
     * @ORM\Column(name="advertisement_content", type="string", length=63, nullable=false)
     */
    private $advertisementContent;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Newspaper", mappedBy="advertisements")
     */
    private $newspapers;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->newspapers = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getAdvertisementId(): ?int
    {
        return $this->advertisementId;
    }

    public function getAdvertisementContent(): ?string
    {
        return $this->advertisementContent;
    }

    public function setAdvertisementContent(string $advertisementContent): self
    {
        $this->advertisementContent = $advertisementContent;

        return $this;
    }

    /**
     * @return Collection|Newspaper[]
     */
    public function getNewspapers(): Collection
    {
        return $this->newspapers;
    }

    public function addNewspaper(Newspaper $newspaper): self
    {
        if (!$this->newspapers->contains($newspaper)) {
            $this->newspapers[] = $newspaper;
            $newspaper->addAdvertisement($this);
        }

        return $this;
    }

    public function removeNewspaper(Newspaper $newspaper): self
    {
        if ($this->newspapers->contains($newspaper)) {
            $this->newspapers->removeElement($newspaper);
            $newspaper->removeAdvertisement($this);
        }

        return $this;
    }

}

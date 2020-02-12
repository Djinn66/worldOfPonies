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
     * @ORM\ManyToMany(targetEntity="App\Entity\Newspaper", mappedBy="advertisements")
     * @ORM\JoinTable(name="newspaper_advertisement_list",
     * joinColumns={@ORM\JoinColumn(name="Advertisement", referencedColumnName="advertisement_id")},
     * inverseJoinColumns={@ORM\JoinColumn(name="Newspapers", referencedColumnName="newspaper_id")}
     * )
     */
    private $newspapers;

    public function __construct()
    {
        $this->newspapers = new ArrayCollection();
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

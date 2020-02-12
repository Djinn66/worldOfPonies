<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Breed
 *
 * @ORM\Table(name="breed", uniqueConstraints={@ORM\UniqueConstraint(name="breed_name", columns={"breed_name"})})
 * @ORM\Entity
 */
class Breed
{
    /**
     * @var int
     *
     * @ORM\Column(name="breed_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $breedId;

    /**
     * @var string
     *
     * @ORM\Column(name="breed_name", type="string", length=35, nullable=false)
     */
    private $breedName;

    /**
     * @var string
     *
     * @ORM\Column(name="breed_description", type="string", length=255, nullable=false)
     */
    private $breedDescription;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Horse", mappedBy="breed", orphanRemoval=true)
     * @ORM\JoinColumn(name="horses", referencedColumnName="horse_id")
     */
    private $horses;

    public function __construct()
    {
        $this->horses = new ArrayCollection();
    }

    public function getBreedId(): ?int
    {
        return $this->breedId;
    }

    public function getBreedName(): ?string
    {
        return $this->breedName;
    }

    public function setBreedName(string $breedName): self
    {
        $this->breedName = $breedName;

        return $this;
    }

    public function getBreedDescription(): ?string
    {
        return $this->breedDescription;
    }

    public function setBreedDescription(string $breedDescription): self
    {
        $this->breedDescription = $breedDescription;

        return $this;
    }

    /**
     * @return Collection|Horse[]
     */
    public function getHorses(): Collection
    {
        return $this->horses;
    }

    public function addHorse(Horse $horse): self
    {
        if (!$this->horses->contains($horse)) {
            $this->horses[] = $horse;
            $horse->setBreed($this);
        }

        return $this;
    }

    public function removeHorse(Horse $horse): self
    {
        if ($this->horses->contains($horse)) {
            $this->horses->removeElement($horse);
            // set the owning side to null (unless already changed)
            if ($horse->getBreed() === $this) {
                $horse->setBreed(null);
            }
        }

        return $this;
    }


}

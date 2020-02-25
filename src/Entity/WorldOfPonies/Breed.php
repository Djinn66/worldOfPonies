<?php

namespace App\Entity\WorldOfPonies;

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


}

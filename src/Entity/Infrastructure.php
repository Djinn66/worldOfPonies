<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Infrastructure
 *
 * @ORM\Table(name="infrastructure")
 * @ORM\Entity
 */
class Infrastructure
{
    /**
     * @var int
     *
     * @ORM\Column(name="infrastructure_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $infrastructureId;

    /**
     * @var string
     *
     * @ORM\Column(name="infrastructure_type", type="string", length=24, nullable=false)
     */
    private $infrastructureType;

    /**
     * @var int
     *
     * @ORM\Column(name="infrastructure_lvl", type="integer", nullable=false)
     */
    private $infrastructureLvl;

    /**
     * @var string
     *
     * @ORM\Column(name="infrastructure_description", type="string", length=254, nullable=false)
     */
    private $infrastructureDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="infrastructure_family", type="string", length=48, nullable=false)
     */
    private $infrastructureFamily;

    /**
     * @var int
     *
     * @ORM\Column(name="infrastructure_price", type="integer", nullable=false)
     */
    private $infrastructurePrice;

    /**
     * @var string
     *
     * @ORM\Column(name="infrastructure_ressource", type="string", length=48, nullable=false)
     */
    private $infrastructureRessource;

    /**
     * @var int
     *
     * @ORM\Column(name="infrastructure_item_capacity", type="integer", nullable=false)
     */
    private $infrastructureItemCapacity;

    /**
     * @var int
     *
     * @ORM\Column(name="infrastructure_horse_capacity", type="integer", nullable=false)
     */
    private $infrastructureHorseCapacity;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Item", mappedBy="infrastructure")
     */
    private $items;

    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

    public function getInfrastructureId(): ?int
    {
        return $this->infrastructureId;
    }

    public function getInfrastructureType(): ?string
    {
        return $this->infrastructureType;
    }

    public function setInfrastructureType(string $infrastructureType): self
    {
        $this->infrastructureType = $infrastructureType;

        return $this;
    }

    public function getInfrastructureLvl(): ?int
    {
        return $this->infrastructureLvl;
    }

    public function setInfrastructureLvl(int $infrastructureLvl): self
    {
        $this->infrastructureLvl = $infrastructureLvl;

        return $this;
    }

    public function getInfrastructureDescription(): ?string
    {
        return $this->infrastructureDescription;
    }

    public function setInfrastructureDescription(string $infrastructureDescription): self
    {
        $this->infrastructureDescription = $infrastructureDescription;

        return $this;
    }

    public function getInfrastructureFamily(): ?string
    {
        return $this->infrastructureFamily;
    }

    public function setInfrastructureFamily(string $infrastructureFamily): self
    {
        $this->infrastructureFamily = $infrastructureFamily;

        return $this;
    }

    public function getInfrastructurePrice(): ?int
    {
        return $this->infrastructurePrice;
    }

    public function setInfrastructurePrice(int $infrastructurePrice): self
    {
        $this->infrastructurePrice = $infrastructurePrice;

        return $this;
    }

    public function getInfrastructureRessource(): ?string
    {
        return $this->infrastructureRessource;
    }

    public function setInfrastructureRessource(string $infrastructureRessource): self
    {
        $this->infrastructureRessource = $infrastructureRessource;

        return $this;
    }

    public function getInfrastructureItemCapacity(): ?int
    {
        return $this->infrastructureItemCapacity;
    }

    public function setInfrastructureItemCapacity(int $infrastructureItemCapacity): self
    {
        $this->infrastructureItemCapacity = $infrastructureItemCapacity;

        return $this;
    }

    public function getInfrastructureHorseCapacity(): ?int
    {
        return $this->infrastructureHorseCapacity;
    }

    public function setInfrastructureHorseCapacity(int $infrastructureHorseCapacity): self
    {
        $this->infrastructureHorseCapacity = $infrastructureHorseCapacity;

        return $this;
    }

    /**
     * @return Collection|Item[]
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    public function addItem(Item $item): self
    {
        if (!$this->items->contains($item)) {
            $this->items[] = $item;
            $item->setInfrastructure($this);
        }

        return $this;
    }

    public function removeItem(Item $item): self
    {
        if ($this->items->contains($item)) {
            $this->items->removeElement($item);
            // set the owning side to null (unless already changed)
            if ($item->getInfrastructure() === $this) {
                $item->setInfrastructure(null);
            }
        }

        return $this;
    }


}

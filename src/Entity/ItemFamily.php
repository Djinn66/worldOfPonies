<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * ItemFamily
 *
 * @ORM\Table(name="item_family")
 * @ORM\Entity
 */
class ItemFamily
{
    /**
     * @var int
     *
     * @ORM\Column(name="item_family_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $itemFamilyId;

    /**
     * @var string
     *
     * @ORM\Column(name="item_family_label", type="string", length=255, nullable=false)
     */
    private $itemFamilyLabel;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Item", mappedBy="itemFamily", orphanRemoval=true)
     */
    private $items;

    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

    public function getItemFamilyId(): ?int
    {
        return $this->itemFamilyId;
    }

    public function getItemFamilyLabel(): ?string
    {
        return $this->itemFamilyLabel;
    }

    public function setItemFamilyLabel(string $itemFamilyLabel): self
    {
        $this->itemFamilyLabel = $itemFamilyLabel;

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
            $item->setItemFamily($this);
        }

        return $this;
    }

    public function removeItem(Item $item): self
    {
        if ($this->items->contains($item)) {
            $this->items->removeElement($item);
            // set the owning side to null (unless already changed)
            if ($item->getItemFamily() === $this) {
                $item->setItemFamily(null);
            }
        }

        return $this;
    }


}

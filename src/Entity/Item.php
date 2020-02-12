<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Item
 *
 * @ORM\Table(name="item")
 * @ORM\Entity
 */
class Item
{
    /**
     * @var int
     *
     * @ORM\Column(name="item_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $itemId;

    /**
     * @var int
     *
     * @ORM\Column(name="item_lvl", type="integer", nullable=false)
     */
    private $itemLvl;

    /**
     * @var string
     *
     * @ORM\Column(name="item_description", type="string", length=254, nullable=false)
     */
    private $itemDescription;

    /**
     * @var int
     *
     * @ORM\Column(name="item_price", type="integer", nullable=false)
     */
    private $itemPrice;

    public function getItemId(): ?int
    {
        return $this->itemId;
    }

    public function getItemLvl(): ?int
    {
        return $this->itemLvl;
    }

    public function setItemLvl(int $itemLvl): self
    {
        $this->itemLvl = $itemLvl;

        return $this;
    }

    public function getItemDescription(): ?string
    {
        return $this->itemDescription;
    }

    public function setItemDescription(string $itemDescription): self
    {
        $this->itemDescription = $itemDescription;

        return $this;
    }

    public function getItemPrice(): ?int
    {
        return $this->itemPrice;
    }

    public function setItemPrice(int $itemPrice): self
    {
        $this->itemPrice = $itemPrice;

        return $this;
    }


}

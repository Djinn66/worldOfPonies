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

    /**
     * @var \Infrastructure
     *
     * @ORM\ManyToOne(targetEntity="Infrastructure", inversedBy="items")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="infrastruture", referencedColumnName="infrastructure_id")
     * })
     */
    private $infrastructure;

    /**
     * @var \ItemFamily
     *
     * @ORM\ManyToOne(targetEntity="ItemFamily", inversedBy="items")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="itemFamily", referencedColumnName="item_family_id", nullable=false)
     * })
     */
    private $itemFamily;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Contest", inversedBy="items")
     */
    /**
     * @var \Contest
     *
     * @ORM\ManyToOne(targetEntity="Contest", inversedBy="items")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="contest", referencedColumnName="contest_id")
     * })
     */
    private $contest;

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

    public function getInfrastructure(): ?Infrastructure
    {
        return $this->infrastructure;
    }

    public function setInfrastructure(?Infrastructure $infrastructure): self
    {
        $this->infrastructure = $infrastructure;

        return $this;
    }

    public function getItemFamily(): ?ItemFamily
    {
        return $this->itemFamily;
    }

    public function setItemFamily(?ItemFamily $itemFamily): self
    {
        $this->itemFamily = $itemFamily;

        return $this;
    }

    public function getContest(): ?Contest
    {
        return $this->contest;
    }

    public function setContest(?Contest $contest): self
    {
        $this->contest = $contest;

        return $this;
    }


}

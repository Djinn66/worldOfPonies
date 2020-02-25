<?php

namespace App\Entity\WorldOfPonies;

use Doctrine\ORM\Mapping as ORM;

/**
 * Item
 *
 * @ORM\Table(name="item", indexes={@ORM\Index(name="IDX_1F1B251E2D5D321", columns={"itemFamily"}), @ORM\Index(name="IDX_1F1B251E1A95CB5", columns={"contest"}), @ORM\Index(name="IDX_1F1B251E9D2207F6", columns={"infrastruture"})})
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
     * @var \Contest
     *
     * @ORM\ManyToOne(targetEntity="Contest")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="contest", referencedColumnName="contest_id")
     * })
     */
    private $contest;

    /**
     * @var \ItemFamily
     *
     * @ORM\ManyToOne(targetEntity="ItemFamily")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="itemFamily", referencedColumnName="item_family_id")
     * })
     */
    private $itemfamily;

    /**
     * @var \Infrastructure
     *
     * @ORM\ManyToOne(targetEntity="Infrastructure")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="infrastruture", referencedColumnName="infrastructure_id")
     * })
     */
    private $infrastruture;

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

    public function getContest(): ?Contest
    {
        return $this->contest;
    }

    public function setContest(?Contest $contest): self
    {
        $this->contest = $contest;

        return $this;
    }

    public function getItemfamily(): ?ItemFamily
    {
        return $this->itemfamily;
    }

    public function setItemfamily(?ItemFamily $itemfamily): self
    {
        $this->itemfamily = $itemfamily;

        return $this;
    }

    public function getInfrastruture(): ?Infrastructure
    {
        return $this->infrastruture;
    }

    public function setInfrastruture(?Infrastructure $infrastruture): self
    {
        $this->infrastruture = $infrastruture;

        return $this;
    }


}

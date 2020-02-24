<?php

namespace App\Entity;

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


}

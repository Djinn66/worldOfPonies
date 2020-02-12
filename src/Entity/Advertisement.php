<?php

namespace App\Entity;

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


}

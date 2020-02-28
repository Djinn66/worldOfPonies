<?php

namespace App\Entity\WorldOfPonies;

use Doctrine\ORM\Mapping as ORM;

/**
 * EquestrianCenter
 *
 * @ORM\Table(name="equestrian_center", indexes={@ORM\Index(name="IDX_317772ACF60E67C", columns={"owner"})})
 * @ORM\Entity
 */
class EquestrianCenter
{
    /**
     * @var int
     *
     * @ORM\Column(name="equestrian_center_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $equestrianCenterId;

    /**
     * @var int
     *
     * @ORM\Column(name="equestrian_center_capacity", type="integer", nullable=false)
     */
    private $equestrianCenterCapacity;

    /**
     * @var \Player
     *
     * @ORM\ManyToOne(targetEntity="Player")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="owner", referencedColumnName="player_id")
     * })
     */
    private $owner;

    public function getEquestrianCenterId(): ?int
    {
        return $this->equestrianCenterId;
    }

    public function getEquestrianCenterCapacity(): ?int
    {
        return $this->equestrianCenterCapacity;
    }

    public function setEquestrianCenterCapacity(int $equestrianCenterCapacity): self
    {
        $this->equestrianCenterCapacity = $equestrianCenterCapacity;

        return $this;
    }

    public function getOwner(): ?Player
    {
        return $this->owner;
    }

    public function setOwner(?Player $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getOwner()->getPlayerUsername() . '('. $this->getEquestrianCenterId() .')';
    }

}

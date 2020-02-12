<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EquestrianCenter
 *
 * @ORM\Table(name="equestrian_center")
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


}

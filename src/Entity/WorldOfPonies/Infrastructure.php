<?php

namespace App\Entity\WorldOfPonies;

use Doctrine\ORM\Mapping as ORM;

/**
 * Infrastructure
 *
 * @ORM\Table(name="infrastructure", indexes={@ORM\Index(name="IDX_D129B1903640243B", columns={"horseclub"}), @ORM\Index(name="IDX_D129B19044BD63D0", columns={"equestriancenter"})})
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
     * @var int
     *
     * @ORM\Column(name="infrastructure_cleaniness_degree", type="integer", nullable=false)
     */
    private $infrastructureCleaninessDegree;

    /**
     * @var \HorseClub
     *
     * @ORM\ManyToOne(targetEntity="HorseClub")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="horseclub", referencedColumnName="horse_club_id")
     * })
     */
    private $horseclub;

    /**
     * @var \EquestrianCenter
     *
     * @ORM\ManyToOne(targetEntity="EquestrianCenter")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="equestriancenter", referencedColumnName="equestrian_center_id")
     * })
     */
    private $equestriancenter;

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

    public function getInfrastructureCleaninessDegree(): ?int
    {
        return $this->infrastructureCleaninessDegree;
    }

    public function setInfrastructureCleaninessDegree(int $infrastructureCleaninessDegree): self
    {
        $this->infrastructureCleaninessDegree = $infrastructureCleaninessDegree;

        return $this;
    }

    public function getHorseclub(): ?HorseClub
    {
        return $this->horseclub;
    }

    public function setHorseclub(?HorseClub $horseclub): self
    {
        $this->horseclub = $horseclub;

        return $this;
    }

    public function getEquestriancenter(): ?EquestrianCenter
    {
        return $this->equestriancenter;
    }

    public function setEquestriancenter(?EquestrianCenter $equestriancenter): self
    {
        $this->equestriancenter = $equestriancenter;

        return $this;
    }


}

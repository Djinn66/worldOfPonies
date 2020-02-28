<?php

namespace App\Entity\WorldOfPonies;

use Doctrine\ORM\Mapping as ORM;

/**
 * Horse
 *
 * @ORM\Table(name="horse", indexes={@ORM\Index(name="IDX_629A2F18D129B190", columns={"infrastructure"}), @ORM\Index(name="IDX_629A2F18F8AF884F", columns={"breed"}), @ORM\Index(name="IDX_629A2F1898197A65", columns={"player"})})
 * @ORM\Entity
 */
class Horse
{
    /**
     * @var int
     *
     * @ORM\Column(name="horse_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $horseId;

    /**
     * @var string
     *
     * @ORM\Column(name="horse_name", type="string", length=63, nullable=false)
     */
    private $horseName;

    /**
     * @var int
     *
     * @ORM\Column(name="horse_disease_resistance", type="integer", nullable=false)
     */
    private $horseDiseaseResistance;

    /**
     * @var int
     *
     * @ORM\Column(name="horse_hygiene_resistance", type="integer", nullable=false)
     */
    private $horseHygieneResistance;

    /**
     * @var int
     *
     * @ORM\Column(name="horse_recovery", type="integer", nullable=false)
     */
    private $horseRecovery;

    /**
     * @var int
     *
     * @ORM\Column(name="horse_stamina", type="integer", nullable=false)
     */
    private $horseStamina;

    /**
     * @var int
     *
     * @ORM\Column(name="horse_jumpheight", type="integer", nullable=false)
     */
    private $horseJumpheight;

    /**
     * @var int
     *
     * @ORM\Column(name="horse_speed", type="integer", nullable=false)
     */
    private $horseSpeed;

    /**
     * @var int
     *
     * @ORM\Column(name="horse_sociability", type="integer", nullable=false)
     */
    private $horseSociability;

    /**
     * @var int
     *
     * @ORM\Column(name="horse_intelligence", type="integer", nullable=false)
     */
    private $horseIntelligence;

    /**
     * @var int
     *
     * @ORM\Column(name="horse_temper", type="integer", nullable=false)
     */
    private $horseTemper;

    /**
     * @var int
     *
     * @ORM\Column(name="horse_health_state", type="integer", nullable=false)
     */
    private $horseHealthState;

    /**
     * @var int
     *
     * @ORM\Column(name="horse_moral_state", type="integer", nullable=false)
     */
    private $horseMoralState;

    /**
     * @var int
     *
     * @ORM\Column(name="horse_stress_state", type="integer", nullable=false)
     */
    private $horseStressState;

    /**
     * @var int
     *
     * @ORM\Column(name="horse_tiredness_state", type="integer", nullable=false)
     */
    private $horseTirednessState;

    /**
     * @var int
     *
     * @ORM\Column(name="horse_hunger_state", type="integer", nullable=false)
     */
    private $horseHungerState;

    /**
     * @var int
     *
     * @ORM\Column(name="horse_cleaniness_state", type="integer", nullable=false)
     */
    private $horseCleaninessState;

    /**
     * @var \Player
     *
     * @ORM\ManyToOne(targetEntity="Player")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="player", referencedColumnName="player_id")
     * })
     */
    private $player;

    /**
     * @var \Infrastructure
     *
     * @ORM\ManyToOne(targetEntity="Infrastructure")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="infrastructure", referencedColumnName="infrastructure_id")
     * })
     */
    private $infrastructure;

    /**
     * @var \Breed
     *
     * @ORM\ManyToOne(targetEntity="Breed")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="breed", referencedColumnName="breed_id")
     * })
     */
    private $breed;

    public function getHorseId(): ?int
    {
        return $this->horseId;
    }

    public function getHorseName(): ?string
    {
        return $this->horseName;
    }

    public function setHorseName(string $horseName): self
    {
        $this->horseName = $horseName;

        return $this;
    }

    public function getHorseDiseaseResistance(): ?int
    {
        return $this->horseDiseaseResistance;
    }

    public function setHorseDiseaseResistance(int $horseDiseaseResistance): self
    {
        $this->horseDiseaseResistance = $horseDiseaseResistance;

        return $this;
    }

    public function getHorseHygieneResistance(): ?int
    {
        return $this->horseHygieneResistance;
    }

    public function setHorseHygieneResistance(int $horseHygieneResistance): self
    {
        $this->horseHygieneResistance = $horseHygieneResistance;

        return $this;
    }

    public function getHorseRecovery(): ?int
    {
        return $this->horseRecovery;
    }

    public function setHorseRecovery(int $horseRecovery): self
    {
        $this->horseRecovery = $horseRecovery;

        return $this;
    }

    public function getHorseStamina(): ?int
    {
        return $this->horseStamina;
    }

    public function setHorseStamina(int $horseStamina): self
    {
        $this->horseStamina = $horseStamina;

        return $this;
    }

    public function getHorseJumpheight(): ?int
    {
        return $this->horseJumpheight;
    }

    public function setHorseJumpheight(int $horseJumpheight): self
    {
        $this->horseJumpheight = $horseJumpheight;

        return $this;
    }

    public function getHorseSpeed(): ?int
    {
        return $this->horseSpeed;
    }

    public function setHorseSpeed(int $horseSpeed): self
    {
        $this->horseSpeed = $horseSpeed;

        return $this;
    }

    public function getHorseSociability(): ?int
    {
        return $this->horseSociability;
    }

    public function setHorseSociability(int $horseSociability): self
    {
        $this->horseSociability = $horseSociability;

        return $this;
    }

    public function getHorseIntelligence(): ?int
    {
        return $this->horseIntelligence;
    }

    public function setHorseIntelligence(int $horseIntelligence): self
    {
        $this->horseIntelligence = $horseIntelligence;

        return $this;
    }

    public function getHorseTemper(): ?int
    {
        return $this->horseTemper;
    }

    public function setHorseTemper(int $horseTemper): self
    {
        $this->horseTemper = $horseTemper;

        return $this;
    }

    public function getHorseHealthState(): ?int
    {
        return $this->horseHealthState;
    }

    public function setHorseHealthState(int $horseHealthState): self
    {
        $this->horseHealthState = $horseHealthState;

        return $this;
    }

    public function getHorseMoralState(): ?int
    {
        return $this->horseMoralState;
    }

    public function setHorseMoralState(int $horseMoralState): self
    {
        $this->horseMoralState = $horseMoralState;

        return $this;
    }

    public function getHorseStressState(): ?int
    {
        return $this->horseStressState;
    }

    public function setHorseStressState(int $horseStressState): self
    {
        $this->horseStressState = $horseStressState;

        return $this;
    }

    public function getHorseTirednessState(): ?int
    {
        return $this->horseTirednessState;
    }

    public function setHorseTirednessState(int $horseTirednessState): self
    {
        $this->horseTirednessState = $horseTirednessState;

        return $this;
    }

    public function getHorseHungerState(): ?int
    {
        return $this->horseHungerState;
    }

    public function setHorseHungerState(int $horseHungerState): self
    {
        $this->horseHungerState = $horseHungerState;

        return $this;
    }

    public function getHorseCleaninessState(): ?int
    {
        return $this->horseCleaninessState;
    }

    public function setHorseCleaninessState(int $horseCleaninessState): self
    {
        $this->horseCleaninessState = $horseCleaninessState;

        return $this;
    }

    public function getPlayer(): ?Player
    {
        return $this->player;
    }

    public function setPlayer(?Player $player): self
    {
        $this->player = $player;

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

    public function getBreed(): ?Breed
    {
        return $this->breed;
    }

    public function setBreed(?Breed $breed): self
    {
        $this->breed = $breed;

        return $this;
    }

    public function __toString(): string
    {
        return ($this->getHorseName());
    }

}

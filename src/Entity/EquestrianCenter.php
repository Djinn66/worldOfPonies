<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Infrastructure", mappedBy="equestriancenter")
     */
    private $infrastructures;

    /**
     * @var \Player
     *
     * @ORM\ManyToOne(targetEntity="Player", inversedBy="equestrianCenters")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="owner", referencedColumnName="player_id", nullable=false)
     * })
     */
    private $owner;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AutomaticTask", mappedBy="equestriancenter", orphanRemoval=true)
     */
    private $automaticTasks;

    public function __construct()
    {
        $this->infrastructures = new ArrayCollection();
        $this->automaticTasks = new ArrayCollection();
    }

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

    /**
     * @return Collection|Infrastructure[]
     */
    public function getInfrastructures(): Collection
    {
        return $this->infrastructures;
    }

    public function addInfrastructure(Infrastructure $infrastructure): self
    {
        if (!$this->infrastructures->contains($infrastructure)) {
            $this->infrastructures[] = $infrastructure;
            $infrastructure->setEquestriancenter($this);
        }

        return $this;
    }

    public function removeInfrastructure(Infrastructure $infrastructure): self
    {
        if ($this->infrastructures->contains($infrastructure)) {
            $this->infrastructures->removeElement($infrastructure);
            // set the owning side to null (unless already changed)
            if ($infrastructure->getEquestriancenter() === $this) {
                $infrastructure->setEquestriancenter(null);
            }
        }

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

    /**
     * @return Collection|AutomaticTask[]
     */
    public function getAutomaticTasks(): Collection
    {
        return $this->automaticTasks;
    }

    public function addAutomaticTask(AutomaticTask $automaticTask): self
    {
        if (!$this->automaticTasks->contains($automaticTask)) {
            $this->automaticTasks[] = $automaticTask;
            $automaticTask->setEquestriancenter($this);
        }

        return $this;
    }

    public function removeAutomaticTask(AutomaticTask $automaticTask): self
    {
        if ($this->automaticTasks->contains($automaticTask)) {
            $this->automaticTasks->removeElement($automaticTask);
            // set the owning side to null (unless already changed)
            if ($automaticTask->getEquestriancenter() === $this) {
                $automaticTask->setEquestriancenter(null);
            }
        }

        return $this;
    }


}

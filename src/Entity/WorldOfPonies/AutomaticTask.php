<?php

namespace App\Entity\WorldOfPonies;

use Doctrine\ORM\Mapping as ORM;

/**
 * AutomaticTask
 *
 * @ORM\Table(name="automatic_task", indexes={@ORM\Index(name="IDX_9DFEADD61F1B251E", columns={"item"}), @ORM\Index(name="IDX_9DFEADD698197A65", columns={"player"}), @ORM\Index(name="IDX_9DFEADD644BD63D0", columns={"equestriancenter"})})
 * @ORM\Entity
 */
class AutomaticTask
{
    /**
     * @var int
     *
     * @ORM\Column(name="task_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $taskId;

    /**
     * @var string
     *
     * @ORM\Column(name="task_to_do", type="string", length=35, nullable=false)
     */
    private $taskToDo;

    /**
     * @var int
     *
     * @ORM\Column(name="task_frequency", type="integer", nullable=false)
     */
    private $taskFrequency;

    /**
     * @var \Item
     *
     * @ORM\ManyToOne(targetEntity="Item")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="item", referencedColumnName="item_id")
     * })
     */
    private $item;

    /**
     * @var \EquestrianCenter
     *
     * @ORM\ManyToOne(targetEntity="EquestrianCenter")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="equestriancenter", referencedColumnName="equestrian_center_id")
     * })
     */
    private $equestriancenter;

    /**
     * @var \Player
     *
     * @ORM\ManyToOne(targetEntity="Player")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="player", referencedColumnName="player_id")
     * })
     */
    private $player;

    public function getTaskId(): ?int
    {
        return $this->taskId;
    }

    public function getTaskToDo(): ?string
    {
        return $this->taskToDo;
    }

    public function setTaskToDo(string $taskToDo): self
    {
        $this->taskToDo = $taskToDo;

        return $this;
    }

    public function getTaskFrequency(): ?int
    {
        return $this->taskFrequency;
    }

    public function setTaskFrequency(int $taskFrequency): self
    {
        $this->taskFrequency = $taskFrequency;

        return $this;
    }

    public function getItem(): ?Item
    {
        return $this->item;
    }

    public function setItem(?Item $item): self
    {
        $this->item = $item;

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

    public function getPlayer(): ?Player
    {
        return $this->player;
    }

    public function setPlayer(?Player $player): self
    {
        $this->player = $player;

        return $this;
    }


}

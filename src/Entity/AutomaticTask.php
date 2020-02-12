<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AutomaticTask
 *
 * @ORM\Table(name="automatic_task")
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


}

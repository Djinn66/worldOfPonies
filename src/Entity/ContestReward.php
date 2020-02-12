<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ContestReward
 *
 * @ORM\Table(name="contest_reward")
 * @ORM\Entity
 */
class ContestReward
{
    /**
     * @var int
     *
     * @ORM\Column(name="contest_reward_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $contestRewardId;

    /**
     * @var int
     *
     * @ORM\Column(name="priority", type="integer", nullable=false)
     */
    private $priority;

    public function getContestRewardId(): ?int
    {
        return $this->contestRewardId;
    }

    public function getPriority(): ?int
    {
        return $this->priority;
    }

    public function setPriority(int $priority): self
    {
        $this->priority = $priority;

        return $this;
    }


}

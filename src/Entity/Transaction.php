<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Transaction
 *
 * @ORM\Table(name="transaction")
 * @ORM\Entity
 */
class Transaction
{
    /**
     * @var int
     *
     * @ORM\Column(name="transaction_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $transactionId;

    /**
     * @var int
     *
     * @ORM\Column(name="transaction_amount", type="integer", nullable=false)
     */
    private $transactionAmount;

    /**
     * @var string
     *
     * @ORM\Column(name="transaction_label", type="string", length=35, nullable=false)
     */
    private $transactionLabel;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Player", inversedBy="transactions")
     * @ORM\JoinColumn(name="player", referencedColumnName="player_id", nullable=false)
     */
    private $player;

    public function getTransactionId(): ?int
    {
        return $this->transactionId;
    }

    public function getTransactionAmount(): ?int
    {
        return $this->transactionAmount;
    }

    public function setTransactionAmount(int $transactionAmount): self
    {
        $this->transactionAmount = $transactionAmount;

        return $this;
    }

    public function getTransactionLabel(): ?string
    {
        return $this->transactionLabel;
    }

    public function setTransactionLabel(string $transactionLabel): self
    {
        $this->transactionLabel = $transactionLabel;

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

<?php

namespace App\Entity\WorldOfPonies;

use Doctrine\ORM\Mapping as ORM;

/**
 * Transaction
 *
 * @ORM\Table(name="transaction", indexes={@ORM\Index(name="IDX_723705D198197A65", columns={"player"})})
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
     * @var Player
     *
     * @ORM\ManyToOne(targetEntity="Player")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="player", referencedColumnName="player_id")
     * })
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

    public function getPlayer(): Player
    {
        return $this->player;
    }

    public function setPlayer(Player $player): self
    {
        $this->player = $player;

        return $this;
    }


}

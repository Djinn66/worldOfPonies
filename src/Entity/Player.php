<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Player
 *
 * @ORM\Table(name="player", uniqueConstraints={@ORM\UniqueConstraint(name="player_index", columns={"player_username", "player_email"})})
 * @ORM\Entity
 */
class Player
{
    /**
     * @var int
     *
     * @ORM\Column(name="player_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $playerId;

    /**
     * @var string
     *
     * @ORM\Column(name="player_username", type="string", length=31, nullable=false)
     */
    private $playerUsername;

    /**
     * @var string
     *
     * @ORM\Column(name="player_email", type="string", length=31, nullable=false)
     */
    private $playerEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="player_pwd", type="string", length=31, nullable=false)
     */
    private $playerPwd;

    /**
     * @var string
     *
     * @ORM\Column(name="player_firstname", type="string", length=31, nullable=false)
     */
    private $playerFirstname;

    /**
     * @var string
     *
     * @ORM\Column(name="player_lastname", type="string", length=31, nullable=false)
     */
    private $playerLastname;

    /**
     * @var string|null
     *
     * @ORM\Column(name="player_gender", type="string", length=1, nullable=true, options={"fixed"=true})
     */
    private $playerGender;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="player_birthdate", type="date", nullable=true)
     */
    private $playerBirthdate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="player_phonenumber", type="string", length=11, nullable=true)
     */
    private $playerPhonenumber;

    /**
     * @var string|null
     *
     * @ORM\Column(name="player_address", type="string", length=255, nullable=true)
     */
    private $playerAddress;

    /**
     * @var string|null
     *
     * @ORM\Column(name="player_avatar", type="blob", length=65535, nullable=true)
     */
    private $playerAvatar;

    /**
     * @var string|null
     *
     * @ORM\Column(name="player_description", type="string", length=144, nullable=true)
     */
    private $playerDescription;

    /**
     * @var string|null
     *
     * @ORM\Column(name="player_website", type="string", length=31, nullable=true)
     */
    private $playerWebsite;

    /**
     * @var string|null
     *
     * @ORM\Column(name="player_funds", type="string", length=31, nullable=true)
     */
    private $playerFunds;

    /**
     * @var int
     *
     * @ORM\Column(name="player_ip", type="integer", nullable=false)
     */
    private $playerIp;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="player_inscription", type="date", nullable=false)
     */
    private $playerInscription;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="player_lastconnection", type="date", nullable=false)
     */
    private $playerLastconnection;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Contest", inversedBy="players")
     * @ORM\JoinTable(name="contest_player_list",
     *   joinColumns={
     *     @ORM\JoinColumn(name="Players", referencedColumnName="player_id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="Contests", referencedColumnName="contest_id")
     *   }
     * )
     */
    private $contests;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->contests = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getPlayerId(): ?int
    {
        return $this->playerId;
    }

    public function getPlayerUsername(): ?string
    {
        return $this->playerUsername;
    }

    public function setPlayerUsername(string $playerUsername): self
    {
        $this->playerUsername = $playerUsername;

        return $this;
    }

    public function getPlayerEmail(): ?string
    {
        return $this->playerEmail;
    }

    public function setPlayerEmail(string $playerEmail): self
    {
        $this->playerEmail = $playerEmail;

        return $this;
    }

    public function getPlayerPwd(): ?string
    {
        return $this->playerPwd;
    }

    public function setPlayerPwd(string $playerPwd): self
    {
        $this->playerPwd = $playerPwd;

        return $this;
    }

    public function getPlayerFirstname(): ?string
    {
        return $this->playerFirstname;
    }

    public function setPlayerFirstname(string $playerFirstname): self
    {
        $this->playerFirstname = $playerFirstname;

        return $this;
    }

    public function getPlayerLastname(): ?string
    {
        return $this->playerLastname;
    }

    public function setPlayerLastname(string $playerLastname): self
    {
        $this->playerLastname = $playerLastname;

        return $this;
    }

    public function getPlayerGender(): ?string
    {
        return $this->playerGender;
    }

    public function setPlayerGender(?string $playerGender): self
    {
        $this->playerGender = $playerGender;

        return $this;
    }

    public function getPlayerBirthdate(): ?\DateTimeInterface
    {
        return $this->playerBirthdate;
    }

    public function setPlayerBirthdate(?\DateTimeInterface $playerBirthdate): self
    {
        $this->playerBirthdate = $playerBirthdate;

        return $this;
    }

    public function getPlayerPhonenumber(): ?string
    {
        return $this->playerPhonenumber;
    }

    public function setPlayerPhonenumber(?string $playerPhonenumber): self
    {
        $this->playerPhonenumber = $playerPhonenumber;

        return $this;
    }

    public function getPlayerAddress(): ?string
    {
        return $this->playerAddress;
    }

    public function setPlayerAddress(?string $playerAddress): self
    {
        $this->playerAddress = $playerAddress;

        return $this;
    }

    public function getPlayerAvatar()
    {
        return $this->playerAvatar;
    }

    public function setPlayerAvatar($playerAvatar): self
    {
        $this->playerAvatar = $playerAvatar;

        return $this;
    }

    public function getPlayerDescription(): ?string
    {
        return $this->playerDescription;
    }

    public function setPlayerDescription(?string $playerDescription): self
    {
        $this->playerDescription = $playerDescription;

        return $this;
    }

    public function getPlayerWebsite(): ?string
    {
        return $this->playerWebsite;
    }

    public function setPlayerWebsite(?string $playerWebsite): self
    {
        $this->playerWebsite = $playerWebsite;

        return $this;
    }

    public function getPlayerFunds(): ?string
    {
        return $this->playerFunds;
    }

    public function setPlayerFunds(?string $playerFunds): self
    {
        $this->playerFunds = $playerFunds;

        return $this;
    }

    public function getPlayerIp(): ?int
    {
        return $this->playerIp;
    }

    public function setPlayerIp(int $playerIp): self
    {
        $this->playerIp = $playerIp;

        return $this;
    }

    public function getPlayerInscription(): ?\DateTimeInterface
    {
        return $this->playerInscription;
    }

    public function setPlayerInscription(\DateTimeInterface $playerInscription): self
    {
        $this->playerInscription = $playerInscription;

        return $this;
    }

    public function getPlayerLastconnection(): ?\DateTimeInterface
    {
        return $this->playerLastconnection;
    }

    public function setPlayerLastconnection(\DateTimeInterface $playerLastconnection): self
    {
        $this->playerLastconnection = $playerLastconnection;

        return $this;
    }

    /**
     * @return Collection|Contest[]
     */
    public function getContests(): Collection
    {
        return $this->contests;
    }

    public function addContest(Contest $contest): self
    {
        if (!$this->contests->contains($contest)) {
            $this->contests[] = $contest;
        }

        return $this;
    }

    public function removeContest(Contest $contest): self
    {
        if ($this->contests->contains($contest)) {
            $this->contests->removeElement($contest);
        }

        return $this;
    }

}

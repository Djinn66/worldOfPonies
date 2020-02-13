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
     * @ORM\Column(name="player_birth_date", type="date", nullable=true)
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
     * @ORM\Column(name="player_inscription_date", type="date", nullable=false)
     */
    private $playerInscription;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="player_lastconnection_date", type="date", nullable=false)
     */
    private $playerLastconnection;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Contest", inversedBy="players")
     * @ORM\JoinTable(name="contest_player_list",
     *   joinColumns={
     *     @ORM\JoinColumn(name="players", referencedColumnName="player_id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="contests", referencedColumnName="contest_id")
     *   }
     * )
     */
    private $contests;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="HorseClub", inversedBy="members")
     * @ORM\JoinTable(name="horse_club_member_list",
     *   joinColumns={
     *     @ORM\JoinColumn(name="members", referencedColumnName="player_id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="horseclubs", referencedColumnName="horse_club_id")
     *   }
     * )
     */
    private $horseclubs;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\EquestrianCenter", mappedBy="owner", orphanRemoval=true)
     */
    private $equestrianCenters;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\HorseClub", mappedBy="manager", orphanRemoval=true)
     */
    private $horseClubsToManage;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AutomaticTask", mappedBy="player", orphanRemoval=true)
     */
    private $automaticTasks;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Newspaper", mappedBy="player", orphanRemoval=true)
     */
    private $newspapers;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->contests = new \Doctrine\Common\Collections\ArrayCollection();
        $this->horseclubs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->equestrianCenters = new ArrayCollection();
        $this->horseClubsToManage = new ArrayCollection();
        $this->automaticTasks = new ArrayCollection();
        $this->newspapers = new ArrayCollection();
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

    /**
     * @return Collection|HorseClub[]
     */
    public function getHorseclubs(): Collection
    {
        return $this->horseclubs;
    }

    public function addHorseclub(HorseClub $horseclub): self
    {
        if (!$this->horseclubs->contains($horseclub)) {
            $this->horseclubs[] = $horseclub;
            $horseclub->addMember($this);
        }

        return $this;
    }

    public function removeHorseclub(HorseClub $horseclub): self
    {
        if ($this->horseclubs->contains($horseclub)) {
            $this->horseclubs->removeElement($horseclub);
            $horseclub->removeMember($this);
        }

        return $this;
    }

    /**
     * @return Collection|EquestrianCenter[]
     */
    public function getEquestrianCenters(): Collection
    {
        return $this->equestrianCenters;
    }

    public function addEquestrianCenter(EquestrianCenter $equestrianCenter): self
    {
        if (!$this->equestrianCenters->contains($equestrianCenter)) {
            $this->equestrianCenters[] = $equestrianCenter;
            $equestrianCenter->setOwner($this);
        }

        return $this;
    }

    public function removeEquestrianCenter(EquestrianCenter $equestrianCenter): self
    {
        if ($this->equestrianCenters->contains($equestrianCenter)) {
            $this->equestrianCenters->removeElement($equestrianCenter);
            // set the owning side to null (unless already changed)
            if ($equestrianCenter->getOwner() === $this) {
                $equestrianCenter->setOwner(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|HorseClub[]
     */
    public function getHorseClubsToManage(): Collection
    {
        return $this->horseClubsToManage;
    }

    public function addHorseClubsToManage(HorseClub $horseClubsToManage): self
    {
        if (!$this->horseClubsToManage->contains($horseClubsToManage)) {
            $this->horseClubsToManage[] = $horseClubsToManage;
            $horseClubsToManage->setManager($this);
        }

        return $this;
    }

    public function removeHorseClubsToManage(HorseClub $horseClubsToManage): self
    {
        if ($this->horseClubsToManage->contains($horseClubsToManage)) {
            $this->horseClubsToManage->removeElement($horseClubsToManage);
            // set the owning side to null (unless already changed)
            if ($horseClubsToManage->getManager() === $this) {
                $horseClubsToManage->setManager(null);
            }
        }

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
            $automaticTask->setPlayer($this);
        }

        return $this;
    }

    public function removeAutomaticTask(AutomaticTask $automaticTask): self
    {
        if ($this->automaticTasks->contains($automaticTask)) {
            $this->automaticTasks->removeElement($automaticTask);
            // set the owning side to null (unless already changed)
            if ($automaticTask->getPlayer() === $this) {
                $automaticTask->setPlayer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Newspaper[]
     */
    public function getNewspapers(): Collection
    {
        return $this->newspapers;
    }

    public function addNewspaper(Newspaper $newspaper): self
    {
        if (!$this->newspapers->contains($newspaper)) {
            $this->newspapers[] = $newspaper;
            $newspaper->setPlayer($this);
        }

        return $this;
    }

    public function removeNewspaper(Newspaper $newspaper): self
    {
        if ($this->newspapers->contains($newspaper)) {
            $this->newspapers->removeElement($newspaper);
            // set the owning side to null (unless already changed)
            if ($newspaper->getPlayer() === $this) {
                $newspaper->setPlayer(null);
            }
        }

        return $this;
    }

}

<?php

namespace App\Entity\Mysql;

use Doctrine\ORM\Mapping as ORM;

/**
 * Event
 *
 * @ORM\Table(name="event")
 * @ORM\Entity
 */
class Event
{
    /**
     * @var string
     *
     * @ORM\Column(name="db", type="string", length=64, nullable=false, options={"fixed"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $db = '';

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=64, nullable=false, options={"fixed"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $name = '';

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="blob", length=0, nullable=false)
     */
    private $body;

    /**
     * @var string
     *
     * @ORM\Column(name="definer", type="string", length=141, nullable=false, options={"fixed"=true})
     */
    private $definer = '';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="execute_at", type="datetime", nullable=true)
     */
    private $executeAt;

    /**
     * @var int|null
     *
     * @ORM\Column(name="interval_value", type="integer", nullable=true)
     */
    private $intervalValue;

    /**
     * @var string|null
     *
     * @ORM\Column(name="interval_field", type="string", length=0, nullable=true)
     */
    private $intervalField;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $created = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="modified", type="datetime", nullable=false, options={"default"="0000-00-00 00:00:00"})
     */
    private $modified = '0000-00-00 00:00:00';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="last_executed", type="datetime", nullable=true)
     */
    private $lastExecuted;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="starts", type="datetime", nullable=true)
     */
    private $starts;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="ends", type="datetime", nullable=true)
     */
    private $ends;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=0, nullable=false, options={"default"="ENABLED"})
     */
    private $status = 'ENABLED';

    /**
     * @var string
     *
     * @ORM\Column(name="on_completion", type="string", length=0, nullable=false, options={"default"="DROP"})
     */
    private $onCompletion = 'DROP';

    /**
     * @var string
     *
     * @ORM\Column(name="sql_mode", type="string", length=0, nullable=false)
     */
    private $sqlMode = '';

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="string", length=64, nullable=false, options={"fixed"=true})
     */
    private $comment = '';

    /**
     * @var int
     *
     * @ORM\Column(name="originator", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $originator;

    /**
     * @var string
     *
     * @ORM\Column(name="time_zone", type="string", length=64, nullable=false, options={"default"="SYSTEM","fixed"=true})
     */
    private $timeZone = 'SYSTEM';

    /**
     * @var string|null
     *
     * @ORM\Column(name="character_set_client", type="string", length=32, nullable=true, options={"fixed"=true})
     */
    private $characterSetClient;

    /**
     * @var string|null
     *
     * @ORM\Column(name="collation_connection", type="string", length=32, nullable=true, options={"fixed"=true})
     */
    private $collationConnection;

    /**
     * @var string|null
     *
     * @ORM\Column(name="db_collation", type="string", length=32, nullable=true, options={"fixed"=true})
     */
    private $dbCollation;

    /**
     * @var string|null
     *
     * @ORM\Column(name="body_utf8", type="blob", length=0, nullable=true)
     */
    private $bodyUtf8;

    public function getDb(): ?string
    {
        return $this->db;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function setBody($body): self
    {
        $this->body = $body;

        return $this;
    }

    public function getDefiner(): ?string
    {
        return $this->definer;
    }

    public function setDefiner(string $definer): self
    {
        $this->definer = $definer;

        return $this;
    }

    public function getExecuteAt(): ?\DateTimeInterface
    {
        return $this->executeAt;
    }

    public function setExecuteAt(?\DateTimeInterface $executeAt): self
    {
        $this->executeAt = $executeAt;

        return $this;
    }

    public function getIntervalValue(): ?int
    {
        return $this->intervalValue;
    }

    public function setIntervalValue(?int $intervalValue): self
    {
        $this->intervalValue = $intervalValue;

        return $this;
    }

    public function getIntervalField(): ?string
    {
        return $this->intervalField;
    }

    public function setIntervalField(?string $intervalField): self
    {
        $this->intervalField = $intervalField;

        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }

    public function getModified(): ?\DateTimeInterface
    {
        return $this->modified;
    }

    public function setModified(\DateTimeInterface $modified): self
    {
        $this->modified = $modified;

        return $this;
    }

    public function getLastExecuted(): ?\DateTimeInterface
    {
        return $this->lastExecuted;
    }

    public function setLastExecuted(?\DateTimeInterface $lastExecuted): self
    {
        $this->lastExecuted = $lastExecuted;

        return $this;
    }

    public function getStarts(): ?\DateTimeInterface
    {
        return $this->starts;
    }

    public function setStarts(?\DateTimeInterface $starts): self
    {
        $this->starts = $starts;

        return $this;
    }

    public function getEnds(): ?\DateTimeInterface
    {
        return $this->ends;
    }

    public function setEnds(?\DateTimeInterface $ends): self
    {
        $this->ends = $ends;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getOnCompletion(): ?string
    {
        return $this->onCompletion;
    }

    public function setOnCompletion(string $onCompletion): self
    {
        $this->onCompletion = $onCompletion;

        return $this;
    }

    public function getSqlMode(): ?string
    {
        return $this->sqlMode;
    }

    public function setSqlMode(string $sqlMode): self
    {
        $this->sqlMode = $sqlMode;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getOriginator(): ?int
    {
        return $this->originator;
    }

    public function setOriginator(int $originator): self
    {
        $this->originator = $originator;

        return $this;
    }

    public function getTimeZone(): ?string
    {
        return $this->timeZone;
    }

    public function setTimeZone(string $timeZone): self
    {
        $this->timeZone = $timeZone;

        return $this;
    }

    public function getCharacterSetClient(): ?string
    {
        return $this->characterSetClient;
    }

    public function setCharacterSetClient(?string $characterSetClient): self
    {
        $this->characterSetClient = $characterSetClient;

        return $this;
    }

    public function getCollationConnection(): ?string
    {
        return $this->collationConnection;
    }

    public function setCollationConnection(?string $collationConnection): self
    {
        $this->collationConnection = $collationConnection;

        return $this;
    }

    public function getDbCollation(): ?string
    {
        return $this->dbCollation;
    }

    public function setDbCollation(?string $dbCollation): self
    {
        $this->dbCollation = $dbCollation;

        return $this;
    }

    public function getBodyUtf8()
    {
        return $this->bodyUtf8;
    }

    public function setBodyUtf8($bodyUtf8): self
    {
        $this->bodyUtf8 = $bodyUtf8;

        return $this;
    }


}

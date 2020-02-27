<?php

namespace App\Entity\Mysql;

use Doctrine\ORM\Mapping as ORM;

/**
 * Proc
 *
 * @ORM\Table(name="proc")
 * @ORM\Entity
 */
class Proc
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
     * @ORM\Column(name="type", type="string", length=0, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="specific_name", type="string", length=64, nullable=false, options={"fixed"=true})
     */
    private $specificName = '';

    /**
     * @var string
     *
     * @ORM\Column(name="language", type="string", length=0, nullable=false, options={"default"="SQL"})
     */
    private $language = 'SQL';

    /**
     * @var string
     *
     * @ORM\Column(name="sql_data_access", type="string", length=0, nullable=false, options={"default"="CONTAINS_SQL"})
     */
    private $sqlDataAccess = 'CONTAINS_SQL';

    /**
     * @var string
     *
     * @ORM\Column(name="is_deterministic", type="string", length=0, nullable=false, options={"default"="NO"})
     */
    private $isDeterministic = 'NO';

    /**
     * @var string
     *
     * @ORM\Column(name="security_type", type="string", length=0, nullable=false, options={"default"="DEFINER"})
     */
    private $securityType = 'DEFINER';

    /**
     * @var string
     *
     * @ORM\Column(name="param_list", type="blob", length=65535, nullable=false)
     */
    private $paramList;

    /**
     * @var string
     *
     * @ORM\Column(name="returns", type="blob", length=0, nullable=false)
     */
    private $returns;

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
     * @var string
     *
     * @ORM\Column(name="sql_mode", type="string", length=0, nullable=false)
     */
    private $sqlMode = '';

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="text", length=65535, nullable=false)
     */
    private $comment;

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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function getSpecificName(): ?string
    {
        return $this->specificName;
    }

    public function setSpecificName(string $specificName): self
    {
        $this->specificName = $specificName;

        return $this;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setLanguage(string $language): self
    {
        $this->language = $language;

        return $this;
    }

    public function getSqlDataAccess(): ?string
    {
        return $this->sqlDataAccess;
    }

    public function setSqlDataAccess(string $sqlDataAccess): self
    {
        $this->sqlDataAccess = $sqlDataAccess;

        return $this;
    }

    public function getIsDeterministic(): ?string
    {
        return $this->isDeterministic;
    }

    public function setIsDeterministic(string $isDeterministic): self
    {
        $this->isDeterministic = $isDeterministic;

        return $this;
    }

    public function getSecurityType(): ?string
    {
        return $this->securityType;
    }

    public function setSecurityType(string $securityType): self
    {
        $this->securityType = $securityType;

        return $this;
    }

    public function getParamList()
    {
        return $this->paramList;
    }

    public function setParamList($paramList): self
    {
        $this->paramList = $paramList;

        return $this;
    }

    public function getReturns()
    {
        return $this->returns;
    }

    public function setReturns($returns): self
    {
        $this->returns = $returns;

        return $this;
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

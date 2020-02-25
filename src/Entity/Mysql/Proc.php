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


}

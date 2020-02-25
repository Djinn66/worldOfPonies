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


}

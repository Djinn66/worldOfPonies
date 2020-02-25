<?php

namespace App\Entity\Mysql;

use Doctrine\ORM\Mapping as ORM;

/**
 * Servers
 *
 * @ORM\Table(name="servers")
 * @ORM\Entity
 */
class Servers
{
    /**
     * @var string
     *
     * @ORM\Column(name="Server_name", type="string", length=64, nullable=false, options={"fixed"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $serverName = '';

    /**
     * @var string
     *
     * @ORM\Column(name="Host", type="string", length=64, nullable=false, options={"fixed"=true})
     */
    private $host = '';

    /**
     * @var string
     *
     * @ORM\Column(name="Db", type="string", length=64, nullable=false, options={"fixed"=true})
     */
    private $db = '';

    /**
     * @var string
     *
     * @ORM\Column(name="Username", type="string", length=80, nullable=false, options={"fixed"=true})
     */
    private $username = '';

    /**
     * @var string
     *
     * @ORM\Column(name="Password", type="string", length=64, nullable=false, options={"fixed"=true})
     */
    private $password = '';

    /**
     * @var int
     *
     * @ORM\Column(name="Port", type="integer", nullable=false)
     */
    private $port = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="Socket", type="string", length=64, nullable=false, options={"fixed"=true})
     */
    private $socket = '';

    /**
     * @var string
     *
     * @ORM\Column(name="Wrapper", type="string", length=64, nullable=false, options={"fixed"=true})
     */
    private $wrapper = '';

    /**
     * @var string
     *
     * @ORM\Column(name="Owner", type="string", length=64, nullable=false, options={"fixed"=true})
     */
    private $owner = '';


}

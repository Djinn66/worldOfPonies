<?php

namespace App\Entity\Mysql;

use Doctrine\ORM\Mapping as ORM;

/**
 * Plugin
 *
 * @ORM\Table(name="plugin")
 * @ORM\Entity
 */
class Plugin
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=64, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $name = '';

    /**
     * @var string
     *
     * @ORM\Column(name="dl", type="string", length=128, nullable=false)
     */
    private $dl = '';

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getDl(): ?string
    {
        return $this->dl;
    }

    public function setDl(string $dl): self
    {
        $this->dl = $dl;

        return $this;
    }


}

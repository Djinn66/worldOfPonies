<?php

namespace App\Entity\Mysql;

use Doctrine\ORM\Mapping as ORM;

/**
 * Func
 *
 * @ORM\Table(name="func")
 * @ORM\Entity
 */
class Func
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=64, nullable=false, options={"fixed"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $name = '';

    /**
     * @var bool
     *
     * @ORM\Column(name="ret", type="boolean", nullable=false)
     */
    private $ret = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="dl", type="string", length=128, nullable=false, options={"fixed"=true})
     */
    private $dl = '';

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=0, nullable=false)
     */
    private $type;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getRet(): ?bool
    {
        return $this->ret;
    }

    public function setRet(bool $ret): self
    {
        $this->ret = $ret;

        return $this;
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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }


}

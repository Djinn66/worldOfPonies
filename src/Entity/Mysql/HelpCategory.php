<?php

namespace App\Entity\Mysql;

use Doctrine\ORM\Mapping as ORM;

/**
 * HelpCategory
 *
 * @ORM\Table(name="help_category", uniqueConstraints={@ORM\UniqueConstraint(name="name", columns={"name"})})
 * @ORM\Entity
 */
class HelpCategory
{
    /**
     * @var int
     *
     * @ORM\Column(name="help_category_id", type="smallint", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $helpCategoryId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=64, nullable=false, options={"fixed"=true})
     */
    private $name;

    /**
     * @var int|null
     *
     * @ORM\Column(name="parent_category_id", type="smallint", nullable=true, options={"unsigned"=true})
     */
    private $parentCategoryId;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="text", length=65535, nullable=false)
     */
    private $url;


}

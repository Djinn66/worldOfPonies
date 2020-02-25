<?php

namespace App\Entity\Mysql;

use Doctrine\ORM\Mapping as ORM;

/**
 * HelpTopic
 *
 * @ORM\Table(name="help_topic", uniqueConstraints={@ORM\UniqueConstraint(name="name", columns={"name"})})
 * @ORM\Entity
 */
class HelpTopic
{
    /**
     * @var int
     *
     * @ORM\Column(name="help_topic_id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $helpTopicId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=64, nullable=false, options={"fixed"=true})
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="help_category_id", type="smallint", nullable=false, options={"unsigned"=true})
     */
    private $helpCategoryId;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="example", type="text", length=65535, nullable=false)
     */
    private $example;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="text", length=65535, nullable=false)
     */
    private $url;


}

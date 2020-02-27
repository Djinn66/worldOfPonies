<?php

namespace App\Entity\Mysql;

use Doctrine\ORM\Mapping as ORM;

/**
 * HelpRelation
 *
 * @ORM\Table(name="help_relation")
 * @ORM\Entity
 */
class HelpRelation
{
    /**
     * @var int
     *
     * @ORM\Column(name="help_topic_id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $helpTopicId;

    /**
     * @var int
     *
     * @ORM\Column(name="help_keyword_id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $helpKeywordId;

    public function getHelpTopicId(): ?int
    {
        return $this->helpTopicId;
    }

    public function getHelpKeywordId(): ?int
    {
        return $this->helpKeywordId;
    }


}

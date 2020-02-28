<?php

namespace App\Entity\WorldOfPonies;

use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 *
 * @ORM\Table(name="article", indexes={@ORM\Index(name="IDX_23A0E66C6E2E686", columns={"newspaper"})})
 * @ORM\Entity
 */
class Article
{
    /**
     * @var int
     *
     * @ORM\Column(name="article_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $articleId;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=31, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="blob", length=65535, nullable=false)
     */
    private $image;

    /**
     * @var \Newspaper
     *
     * @ORM\ManyToOne(targetEntity="Newspaper")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="newspaper", referencedColumnName="newspaper_id")
     * })
     */
    private $newspaper;

    public function getArticleId(): ?int
    {
        return $this->articleId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getNewspaper(): ?Newspaper
    {
        return $this->newspaper;
    }

    public function setNewspaper(?Newspaper $newspaper): self
    {
        $this->newspaper = $newspaper;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getDescription();
    }

}

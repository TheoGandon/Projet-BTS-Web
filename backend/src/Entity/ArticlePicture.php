<?php

namespace App\Entity;

use App\Repository\ArticlePictureRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticlePictureRepository::class)]
class ArticlePicture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $picture_link = null;

    #[ORM\ManyToOne(inversedBy: 'array_pictures')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Articles $article_id = null;

    #[ORM\ManyToOne(inversedBy: 'articlePictures')]
    #[ORM\JoinColumn(nullable: false)]
    private ?color $color = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPictureLink(): ?string
    {
        return $this->picture_link;
    }

    public function setPictureLink(string $picture_link): static
    {
        $this->picture_link = $picture_link;

        return $this;
    }

    public function getArticleId(): ?Articles
    {
        return $this->article_id;
    }

    public function setArticleId(?Articles $article_id): static
    {
        $this->article_id = $article_id;

        return $this;
    }

    public function getColor(): ?color
    {
        return $this->color;
    }

    public function setColor(?color $color): static
    {
        $this->color = $color;

        return $this;
    }

}

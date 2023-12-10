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

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Color $color_id = null;

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

    public function getColorId(): ?Color
    {
        return $this->color_id;
    }

    public function setColorId(?Color $color_id): static
    {
        $this->color_id = $color_id;

        return $this;
    }
}

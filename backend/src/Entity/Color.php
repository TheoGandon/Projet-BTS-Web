<?php

namespace App\Entity;

use App\Repository\ColorRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ColorRepository::class)]
class Color
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $color_label = null;

    #[ORM\ManyToOne(inversedBy: 'color_id')]
    private ?Articles $array_articles = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getColorLabel(): ?string
    {
        return $this->color_label;
    }

    public function setColorLabel(string $color_label): static
    {
        $this->color_label = $color_label;

        return $this;
    }

    public function getArrayArticles(): ?Articles
    {
        return $this->array_articles;
    }

    public function setArrayArticles(?Articles $array_articles): static
    {
        $this->array_articles = $array_articles;

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\SizesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SizesRepository::class)]
class Sizes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $size_label = null;

    #[ORM\ManyToMany(targetEntity: Articles::class, mappedBy: 'array_sizes')]
    private Collection $array_articles;

    public function __construct()
    {
        $this->array_articles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSizeLabel(): ?string
    {
        return $this->size_label;
    }

    public function setSizeLabel(string $size_label): static
    {
        $this->size_label = $size_label;

        return $this;
    }

    /**
     * @return Collection<int, Articles>
     */
    public function getArticleId(): Collection
    {
        return $this->array_articles;
    }

    public function addArticleId(Articles $articleId): static
    {
        if (!$this->array_articles->contains($articleId)) {
            $this->array_articles->add($articleId);
            $articleId->addCategoryId($this);
        }

        return $this;
    }

    public function removeArticleId(Articles $articleId): static
    {
        if ($this->array_articles->removeElement($articleId)) {
            $articleId->removeCategoryId($this);
        }

        return $this;
    }
}

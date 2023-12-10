<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $category_name = null;

    #[ORM\OneToMany(mappedBy: 'category_id', targetEntity: Articles::class)]
    private Collection $array_articles;

    public function __construct()
    {
        $this->array_articles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategoryName(): ?string
    {
        return $this->category_name;
    }

    public function setCategoryName(string $category_name): static
    {
        $this->category_name = $category_name;

        return $this;
    }

    /**
     * @return Collection<int, Articles>
     */
    public function getArrayArticles(): Collection
    {
        return $this->array_articles;
    }

    public function addArrayArticle(Articles $arrayArticle): static
    {
        if (!$this->array_articles->contains($arrayArticle)) {
            $this->array_articles->add($arrayArticle);
            $arrayArticle->setCategoryId($this);
        }

        return $this;
    }

    public function removeArrayArticle(Articles $arrayArticle): static
    {
        if ($this->array_articles->removeElement($arrayArticle)) {
            // set the owning side to null (unless already changed)
            if ($arrayArticle->getCategoryId() === $this) {
                $arrayArticle->setCategoryId(null);
            }
        }

        return $this;
    }
}

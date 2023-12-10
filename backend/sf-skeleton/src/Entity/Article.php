<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $article_title = null;

    #[ORM\Column(length: 1000)]
    private ?string $article_description = null;

    #[ORM\Column]
    private ?float $article_selling_price = null;

    #[ORM\Column(nullable: true)]
    private ?float $article_selling_price_promo = null;

    #[ORM\ManyToOne(inversedBy: 'array_articles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category_id = null;

    #[ORM\ManyToMany(targetEntity: Sizes::class, inversedBy: 'array_articles')]
    private Collection $array_sizes;


    public function __construct()
    {
        $this->array_sizes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArticleTitle(): ?string
    {
        return $this->article_title;
    }

    public function setArticleTitle(string $article_title): static
    {
        $this->article_title = $article_title;

        return $this;
    }

    public function getArticleDescription(): ?string
    {
        return $this->article_description;
    }

    public function setArticleDescription(string $article_description): static
    {
        $this->article_description = $article_description;

        return $this;
    }

    public function getArticleSellingPrice(): ?float
    {
        return $this->article_selling_price;
    }

    public function setArticleSellingPrice(float $article_selling_price): static
    {
        $this->article_selling_price = $article_selling_price;

        return $this;
    }

    public function getArticleSellingPricePromo(): ?float
    {
        return $this->article_selling_price_promo;
    }

    public function setArticleSellingPricePromo(?float $article_selling_price_promo): static
    {
        $this->article_selling_price_promo = $article_selling_price_promo;

        return $this;
    }

    public function getCategoryId(): ?Category
    {
        return $this->category_id;
    }

    public function setCategoryId(?Category $category_id): static
    {
        $this->category_id = $category_id;

        return $this;
    }

    /**
     * @return Collection<int, Sizes>
     */
    public function getArraySizes(): Collection
    {
        return $this->array_sizes;
    }

    public function addArraySize(Sizes $arraySize): static
    {
        if (!$this->array_sizes->contains($arraySize)) {
            $this->array_sizes->add($arraySize);
        }

        return $this;
    }

    public function removeArraySize(Sizes $arraySize): static
    {
        $this->array_sizes->removeElement($arraySize);

        return $this;
    }

}

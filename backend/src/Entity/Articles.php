<?php

namespace App\Entity;

use App\Repository\ArticlesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticlesRepository::class)]
class Articles
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $article_title = null;

    #[ORM\Column(length: 1024)]
    private ?string $article_description = null;

    #[ORM\Column]
    private ?float $article_selling_price = null;

    #[ORM\Column]
    private ?float $article_selling_price_promotion = null;

    #[ORM\ManyToMany(targetEntity: Sizes::class, inversedBy: 'array_articles')]
    private Collection $array_sizes;

    #[ORM\ManyToOne(inversedBy: 'array_articles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category_id = null;

    #[ORM\ManyToMany(targetEntity: Order::class, mappedBy: 'order_content')]
    private Collection $array_orders;

    #[ORM\OneToMany(mappedBy: 'article_id', targetEntity: ArticlePicture::class)]
    private Collection $array_pictures;

    #[ORM\OneToMany(mappedBy: 'array_articles', targetEntity: Color::class)]
    private Collection $color_id;

    public function __construct()
    {
        $this->array_sizes = new ArrayCollection();
        $this->array_orders = new ArrayCollection();
        $this->array_pictures = new ArrayCollection();
        $this->color_id = new ArrayCollection();
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

    public function getArticleSellingPricePromotion(): ?float
    {
        return $this->article_selling_price_promotion;
    }

    public function setArticleSellingPricePromotion(float $article_selling_price_promotion): static
    {
        $this->article_selling_price_promotion = $article_selling_price_promotion;

        return $this;
    }

    /**
     * @return Collection<int, Sizes>
     */
    public function getCategoryId(): Collection
    {
        return $this->array_sizes;
    }

    public function addCategoryId(Sizes $categoryId): static
    {
        if (!$this->array_sizes->contains($categoryId)) {
            $this->array_sizes->add($categoryId);
        }

        return $this;
    }

    public function removeCategoryId(Sizes $categoryId): static
    {
        $this->array_sizes->removeElement($categoryId);

        return $this;
    }

    public function setCategoryId(?Category $category_id): static
    {
        $this->category_id = $category_id;

        return $this;
    }

    /**
     * @return Collection<int, Order>
     */
    public function getArrayOrders(): Collection
    {
        return $this->array_orders;
    }

    public function addArrayOrder(Order $arrayOrder): static
    {
        if (!$this->array_orders->contains($arrayOrder)) {
            $this->array_orders->add($arrayOrder);
            $arrayOrder->addOrderContent($this);
        }

        return $this;
    }

    public function removeArrayOrder(Order $arrayOrder): static
    {
        if ($this->array_orders->removeElement($arrayOrder)) {
            $arrayOrder->removeOrderContent($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, ArticlePicture>
     */
    public function getArrayPictures(): Collection
    {
        return $this->array_pictures;
    }

    public function addArrayPicture(ArticlePicture $arrayPicture): static
    {
        if (!$this->array_pictures->contains($arrayPicture)) {
            $this->array_pictures->add($arrayPicture);
            $arrayPicture->setArticleId($this);
        }

        return $this;
    }

    public function removeArrayPicture(ArticlePicture $arrayPicture): static
    {
        if ($this->array_pictures->removeElement($arrayPicture)) {
            // set the owning side to null (unless already changed)
            if ($arrayPicture->getArticleId() === $this) {
                $arrayPicture->setArticleId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Color>
     */
    public function getColorId(): Collection
    {
        return $this->color_id;
    }

    public function addColorId(Color $colorId): static
    {
        if (!$this->color_id->contains($colorId)) {
            $this->color_id->add($colorId);
            $colorId->setArrayArticles($this);
        }

        return $this;
    }

    public function removeColorId(Color $colorId): static
    {
        if ($this->color_id->removeElement($colorId)) {
            // set the owning side to null (unless already changed)
            if ($colorId->getArrayArticles() === $this) {
                $colorId->setArrayArticles(null);
            }
        }

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'articles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    #[ORM\Column(length: 255)]
    private ?string $article_title = null;

    #[ORM\Column(length: 1024)]
    private ?string $article_description = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 8, scale: 2)]
    private ?string $selling_price = null;

    #[ORM\ManyToMany(targetEntity: Order::class, inversedBy: 'articles')]
    private Collection $orders;

    #[ORM\ManyToMany(targetEntity: Client::class, inversedBy: 'favourite_articles')]
    private Collection $clients_favourites;

    #[ORM\OneToMany(mappedBy: 'article', targetEntity: ArticlePicture::class)]
    private Collection $articlePictures;

    #[ORM\OneToMany(mappedBy: 'Article', targetEntity: Stock::class)]
    private Collection $stocks;



    public function __construct()
    {
        $this->orders = new ArrayCollection();
        $this->clients_favourites = new ArrayCollection();
        $this->articlePictures = new ArrayCollection();
        $this->stocks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
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

    public function getSellingPrice(): ?string
    {
        return $this->selling_price;
    }

    public function setSellingPrice(string $selling_price): static
    {
        $this->selling_price = $selling_price;

        return $this;
    }

    /**
     * @return Collection<int, Order>
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Order $order): static
    {
        if (!$this->orders->contains($order)) {
            $this->orders->add($order);
        }

        return $this;
    }

    public function removeOrder(Order $order): static
    {
        $this->orders->removeElement($order);

        return $this;
    }

    /**
     * @return Collection<int, Client>
     */
    public function getClientsFavourites(): Collection
    {
        return $this->clients_favourites;
    }

    public function addClientsFavourites(Client $clientsFavourites): static
    {
        if (!$this->clients_favourites->contains($clientsFavourites)) {
            $this->clients_favourites->add($clientsFavourites);
        }

        return $this;
    }

    public function removeClientsFavourites(Client $clientsFavourites): static
    {
        $this->clients_favourites->removeElement($clientsFavourites);

        return $this;
    }

    /**
     * @return Collection<int, ArticlePicture>
     */
    public function getArticlePictures(): Collection
    {
        return $this->articlePictures;
    }

    public function addArticlePicture(ArticlePicture $articlePicture): static
    {
        if (!$this->articlePictures->contains($articlePicture)) {
            $this->articlePictures->add($articlePicture);
            $articlePicture->setArticle($this);
        }

        return $this;
    }

    public function removeArticlePicture(ArticlePicture $articlePicture): static
    {
        if ($this->articlePictures->removeElement($articlePicture)) {
            // set the owning side to null (unless already changed)
            if ($articlePicture->getArticle() === $this) {
                $articlePicture->setArticle(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Stock>
     */
    public function getStocks(): Collection
    {
        return $this->stocks;
    }

    public function addStock(Stock $stock): static
    {
        if (!$this->stocks->contains($stock)) {
            $this->stocks->add($stock);
            $stock->setArticle($this);
        }

        return $this;
    }

    public function removeStock(Stock $stock): static
    {
        if ($this->stocks->removeElement($stock)) {
            // set the owning side to null (unless already changed)
            if ($stock->getArticle() === $this) {
                $stock->setArticle(null);
            }
        }

        return $this;
    }
}

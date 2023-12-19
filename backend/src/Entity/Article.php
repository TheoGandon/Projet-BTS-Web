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

    #[ORM\ManyToMany(targetEntity: Stock::class, inversedBy: 'articles')]
    private Collection $stock;

    #[ORM\Column(length: 255)]
    private ?string $article_title = null;

    #[ORM\Column(length: 1024)]
    private ?string $article_description = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 8, scale: 2)]
    private ?string $selling_price = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 8, scale: 2)]
    private ?string $selling_price_promo = null;

    #[ORM\ManyToMany(targetEntity: articlePicture::class, inversedBy: 'articles')]
    private Collection $pictures;

    #[ORM\ManyToMany(targetEntity: Order::class, inversedBy: 'articles')]
    private Collection $orders;

    #[ORM\ManyToMany(targetEntity: Client::class, inversedBy: 'cart_articles')]
    private Collection $clients_cart;


    public function __construct()
    {
        $this->stock = new ArrayCollection();
        $this->pictures = new ArrayCollection();
        $this->orders = new ArrayCollection();
        $this->clients_cart = new ArrayCollection();
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

    /**
     * @return Collection<int, Stock>
     */
    public function getStock(): Collection
    {
        return $this->stock;
    }

    public function addStock(Stock $stock): static
    {
        if (!$this->stock->contains($stock)) {
            $this->stock->add($stock);
        }

        return $this;
    }

    public function removeStock(Stock $stock): static
    {
        $this->stock->removeElement($stock);

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

    public function getSellingPricePromo(): ?string
    {
        return $this->selling_price_promo;
    }

    public function setSellingPricePromo(string $selling_price_promo): static
    {
        $this->selling_price_promo = $selling_price_promo;

        return $this;
    }

    /**
     * @return Collection<int, articlePicture>
     */
    public function getPictures(): Collection
    {
        return $this->pictures;
    }

    public function addPicture(articlePicture $picture): static
    {
        if (!$this->pictures->contains($picture)) {
            $this->pictures->add($picture);
        }

        return $this;
    }

    public function removePicture(articlePicture $picture): static
    {
        $this->pictures->removeElement($picture);

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
    public function getClientsCart(): Collection
    {
        return $this->clients_cart;
    }

    public function addClientsCart(Client $clientsCart): static
    {
        if (!$this->clients_cart->contains($clientsCart)) {
            $this->clients_cart->add($clientsCart);
        }

        return $this;
    }

    public function removeClientsCart(Client $clientsCart): static
    {
        $this->clients_cart->removeElement($clientsCart);

        return $this;
    }
}

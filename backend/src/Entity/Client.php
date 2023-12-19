<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $client_first_name = null;

    #[ORM\Column(length: 255)]
    private ?string $client_last_name = null;

    #[ORM\Column(length: 255)]
    private ?string $client_email = null;

    #[ORM\Column(length: 512)]
    private ?string $client_password = null;

    #[ORM\OneToMany(mappedBy: 'client_id', targetEntity: Address::class, orphanRemoval: true)]
    private Collection $array_adresses;

    #[ORM\OneToMany(mappedBy: 'client_id', targetEntity: Order::class)]
    private Collection $array_orders;

    #[ORM\ManyToMany(targetEntity: Article::class, mappedBy: 'clients_cart')]
    private Collection $cart_articles;

    public function __construct()
    {
        $this->array_adresses = new ArrayCollection();
        $this->array_orders = new ArrayCollection();
        $this->cart_articles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClientFirstName(): ?string
    {
        return $this->client_first_name;
    }

    public function setClientFirstName(string $client_first_name): static
    {
        $this->client_first_name = $client_first_name;

        return $this;
    }

    public function getClientLastName(): ?string
    {
        return $this->client_last_name;
    }

    public function setClientLastName(string $client_last_name): static
    {
        $this->client_last_name = $client_last_name;

        return $this;
    }

    public function getClientEmail(): ?string
    {
        return $this->client_email;
    }

    public function setClientEmail(string $client_email): static
    {
        $this->client_email = $client_email;

        return $this;
    }

    public function getClientPassword(): ?string
    {
        return $this->client_password;
    }

    public function setClientPassword(string $client_password): static
    {
        $this->client_password = $client_password;

        return $this;
    }

    /**
     * @return Collection<int, Address>
     */
    public function getArrayAdresses(): Collection
    {
        return $this->array_adresses;
    }

    public function addArrayAdress(Address $arrayAdress): static
    {
        if (!$this->array_adresses->contains($arrayAdress)) {
            $this->array_adresses->add($arrayAdress);
            $arrayAdress->setClientId($this);
        }

        return $this;
    }

    public function removeArrayAdress(Address $arrayAdress): static
    {
        if ($this->array_adresses->removeElement($arrayAdress)) {
            // set the owning side to null (unless already changed)
            if ($arrayAdress->getClientId() === $this) {
                $arrayAdress->setClientId(null);
            }
        }

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
            $arrayOrder->setClientId($this);
        }

        return $this;
    }

    public function removeArrayOrder(Order $arrayOrder): static
    {
        if ($this->array_orders->removeElement($arrayOrder)) {
            // set the owning side to null (unless already changed)
            if ($arrayOrder->getClientId() === $this) {
                $arrayOrder->setClientId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Article>
     */
    public function getCartArticles(): Collection
    {
        return $this->cart_articles;
    }

    public function addCartArticle(Article $cartArticle): static
    {
        if (!$this->cart_articles->contains($cartArticle)) {
            $this->cart_articles->add($cartArticle);
            $cartArticle->addClientsCart($this);
        }

        return $this;
    }

    public function removeCartArticle(Article $cartArticle): static
    {
        if ($this->cart_articles->removeElement($cartArticle)) {
            $cartArticle->removeClientsCart($this);
        }

        return $this;
    }

}

<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $first_name = null;

    #[ORM\Column(length: 255)]
    private ?string $last_name = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    #[ORM\Column]
    private ?string $password = null;

    #[ORM\OneToMany(mappedBy: 'client', targetEntity: Address::class, orphanRemoval: true)]
    private Collection $adresses;

    #[ORM\OneToMany(mappedBy: 'client_id', targetEntity: Order::class)]
    private Collection $orders;

    #[ORM\ManyToMany(targetEntity: Article::class, mappedBy: 'clients_favourites')]
    private Collection $favourite_articles;

    public function __construct()
    {
        $this->adresses = new ArrayCollection();
        $this->orders = new ArrayCollection();
        $this->favourite_articles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): static
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): static
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection<int, Address>
     */
    public function getAdresses(): Collection
    {
        return $this->adresses;
    }

    public function addAdress(Address $Adress): static
    {
        if (!$this->adresses->contains($Adress)) {
            $this->adresses->add($Adress);
            $Adress->setClientId($this);
        }

        return $this;
    }

    public function removeAdress(Address $Adress): static
    {
        if ($this->adresses->removeElement($Adress)) {
            // set the owning side to null (unless already changed)
            if ($Adress->getClientId() === $this) {
                $Adress->setClientId(null);
            }
        }

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
            $order->setClientId($this);
        }

        return $this;
    }

    public function removeOrder(Order $Order): static
    {
        if ($this->orders->removeElement($Order)) {
            // set the owning side to null (unless already changed)
            if ($Order->getClientId() === $this) {
                $Order->setClientId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Article>
     */
    public function getFavouriteArticles(): Collection
    {
        return $this->favourite_articles;
    }

    public function addFavouriteArticle(Article $favouriteArticle): static
    {
        if (!$this->favourite_articles->contains($favouriteArticle)) {
            $this->favourite_articles->add($favouriteArticle);
            $favouriteArticle->addClientsFavourites($this);
        }

        return $this;
    }

    public function removeFavouriteArticle(Article $favouriteArticle): static
    {
        if ($this->favourite_articles->removeElement($favouriteArticle)) {
            $favouriteArticle->removeClientsFavourites($this);
        }

        return $this;
    }

}

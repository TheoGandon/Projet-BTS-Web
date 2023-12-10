<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $order_datetime = null;

    #[ORM\Column]
    private ?int $order_status = null;

    #[ORM\ManyToOne(inversedBy: 'array_orders')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Client $client_id = null;

    #[ORM\OneToMany(mappedBy: 'order_id', targetEntity: Payment::class)]
    private Collection $array_payments;

    #[ORM\ManyToMany(targetEntity: Articles::class, inversedBy: 'array_orders')]
    private Collection $order_content;

    #[ORM\OneToMany(mappedBy: 'order_id', targetEntity: Shipping::class)]
    private Collection $array_shippings;

    public function __construct()
    {
        $this->array_payments = new ArrayCollection();
        $this->order_content = new ArrayCollection();
        $this->array_shippings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderDatetime(): ?\DateTimeInterface
    {
        return $this->order_datetime;
    }

    public function setOrderDatetime(\DateTimeInterface $order_datetime): static
    {
        $this->order_datetime = $order_datetime;

        return $this;
    }

    public function getOrderStatus(): ?int
    {
        return $this->order_status;
    }

    public function setOrderStatus(int $order_status): static
    {
        $this->order_status = $order_status;

        return $this;
    }

    public function getClientId(): ?Client
    {
        return $this->client_id;
    }

    public function setClientId(?Client $client_id): static
    {
        $this->client_id = $client_id;

        return $this;
    }

    /**
     * @return Collection<int, Payment>
     */
    public function getArrayPayments(): Collection
    {
        return $this->array_payments;
    }

    public function addArrayPayment(Payment $arrayPayment): static
    {
        if (!$this->array_payments->contains($arrayPayment)) {
            $this->array_payments->add($arrayPayment);
            $arrayPayment->setOrderId($this);
        }

        return $this;
    }

    public function removeArrayPayment(Payment $arrayPayment): static
    {
        if ($this->array_payments->removeElement($arrayPayment)) {
            // set the owning side to null (unless already changed)
            if ($arrayPayment->getOrderId() === $this) {
                $arrayPayment->setOrderId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Articles>
     */
    public function getOrderContent(): Collection
    {
        return $this->order_content;
    }

    public function addOrderContent(Articles $orderContent): static
    {
        if (!$this->order_content->contains($orderContent)) {
            $this->order_content->add($orderContent);
        }

        return $this;
    }

    public function removeOrderContent(Articles $orderContent): static
    {
        $this->order_content->removeElement($orderContent);

        return $this;
    }

    /**
     * @return Collection<int, Shipping>
     */
    public function getArrayShippings(): Collection
    {
        return $this->array_shippings;
    }

    public function addArrayShipping(Shipping $arrayShipping): static
    {
        if (!$this->array_shippings->contains($arrayShipping)) {
            $this->array_shippings->add($arrayShipping);
            $arrayShipping->setOrderId($this);
        }

        return $this;
    }

    public function removeArrayShipping(Shipping $arrayShipping): static
    {
        if ($this->array_shippings->removeElement($arrayShipping)) {
            // set the owning side to null (unless already changed)
            if ($arrayShipping->getOrderId() === $this) {
                $arrayShipping->setOrderId(null);
            }
        }

        return $this;
    }
}

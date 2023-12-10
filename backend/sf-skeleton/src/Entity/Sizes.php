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

    #[ORM\Column]
    private ?float $size_value_eu = null;

    #[ORM\Column]
    private ?float $size_value_uk = null;

    #[ORM\Column]
    private ?float $size_value_us = null;

    #[ORM\Column(length: 3)]
    private ?string $size_gender = null;

    #[ORM\ManyToMany(targetEntity: Article::class, mappedBy: 'array_sizes')]
    private Collection $array_articles;

    public function __construct()
    {
        $this->array_articles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSizeValueEu(): ?float
    {
        return $this->size_value_eu;
    }

    public function setSizeValueEu(float $size_value_eu): static
    {
        $this->size_value_eu = $size_value_eu;

        return $this;
    }

    public function getSizeValueUk(): ?float
    {
        return $this->size_value_uk;
    }

    public function setSizeValueUk(float $size_value_uk): static
    {
        $this->size_value_uk = $size_value_uk;

        return $this;
    }

    public function getSizeValueUs(): ?float
    {
        return $this->size_value_us;
    }

    public function setSizeValueUs(float $size_value_us): static
    {
        $this->size_value_us = $size_value_us;

        return $this;
    }

    public function getSizeGender(): ?string
    {
        return $this->size_gender;
    }

    public function setSizeGender(string $size_gender): static
    {
        $this->size_gender = $size_gender;

        return $this;
    }

    /**
     * @return Collection<int, Article>
     */
    public function getArrayArticles(): Collection
    {
        return $this->array_articles;
    }

    public function addArrayArticle(Article $arrayArticle): static
    {
        if (!$this->array_articles->contains($arrayArticle)) {
            $this->array_articles->add($arrayArticle);
            $arrayArticle->addArraySize($this);
        }

        return $this;
    }

    public function removeArrayArticle(Article $arrayArticle): static
    {
        if ($this->array_articles->removeElement($arrayArticle)) {
            $arrayArticle->removeArraySize($this);
        }

        return $this;
    }
}

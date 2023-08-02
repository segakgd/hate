<?php

namespace App\Entity\Ecommerce;

use App\Repository\OrderEntityRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: OrderEntityRepository::class)]
class OrderEntity
{
    #[Groups(['administrator'])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(['administrator'])]
    #[ORM\Column(nullable: true)]
    private array $products = [];

    /** @deprecated временно не смотрим на этот код */
    #[Groups(['administrator'])]
    #[ORM\Column(nullable: true)]
    private array $shipping = [];

    /** @deprecated временно не смотрим на этот код */
    #[Groups(['administrator'])]
    #[ORM\Column(nullable: true)]
    private array $promotions = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProducts(): array
    {
        return $this->products;
    }

    public function setProducts(?array $products): static
    {
        $this->products = $products;

        return $this;
    }

    /** @deprecated временно не смотрим на этот код */
    public function getShipping(): array
    {
        return $this->shipping;
    }

    /** @deprecated временно не смотрим на этот код */
    public function setShipping(?array $shipping): static
    {
        $this->shipping = $shipping;

        return $this;
    }

    /** @deprecated временно не смотрим на этот код */
    public function getPromotions(): array
    {
        return $this->promotions;
    }

    /** @deprecated временно не смотрим на этот код */
    public function setPromotions(?array $promotions): static
    {
        $this->promotions = $promotions;

        return $this;
    }
}

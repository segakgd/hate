<?php

namespace App\Entity\Ecommerce;

use App\Repository\OrderEntityRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderEntityRepository::class)]
class OrderEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private array $products = [];

    #[ORM\Column(nullable: true)]
    private array $shipping = [];

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

    public function getShipping(): array
    {
        return $this->shipping;
    }

    public function setShipping(?array $shipping): static
    {
        $this->shipping = $shipping;

        return $this;
    }

    public function getPromotions(): array
    {
        return $this->promotions;
    }

    public function setPromotions(?array $promotions): static
    {
        $this->promotions = $promotions;

        return $this;
    }
}

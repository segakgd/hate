<?php

namespace App\Entity\Lead;

use App\Dto\Ecommerce\_deprecated\PromotionDto;
use App\Dto\Ecommerce\_deprecated\ShippingDto;
use App\Dto\Ecommerce\ProductDto;
use App\Repository\Lead\OrderEntityRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: OrderEntityRepository::class)]
class Order
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

    #[ORM\Column]
    private ?int $totalAmount = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

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

    public function addProduct(?ProductDto $products): static
    {
        $this->products[] = $products;

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

    /** @deprecated временно не смотрим на этот код */
    public function addPromotion(PromotionDto $promotions): static
    {
        $this->promotions[] = $promotions;

        return $this;
    }

    public function getTotalAmount(): ?int
    {
        return $this->totalAmount;
    }

    public function setTotalAmount(int $totalAmount): static
    {
        $this->totalAmount = $totalAmount;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}

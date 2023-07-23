<?php

namespace App\Dto\Ecommerce;

class OrderDto
{
    /** @var array<ProductDto>|null */
    private ?array $products = null;

    public function getProducts(): ?array
    {
        return $this->products;
    }

    public function setProducts(?array $products): self
    {
        $this->products = $products;

        return $this;
    }

    public function addProducts(?ProductDto $product): self
    {
        $this->products[] = $product;

        return $this;
    }

    private ?ShippingDto $shipping = null;

    public function getShipping(): ?ShippingDto
    {
        return $this->shipping;
    }

    public function setShipping(?ShippingDto $shipping): self
    {
        $this->shipping = $shipping;

        return $this;
    }

    /** @var array<PromotionDto>|null */
    private ?array $promotions = null;

    public function getPromotions(): ?array
    {
        return $this->promotions;
    }

    public function setPromotions(?array $promotions): self
    {
        $this->promotions = $promotions;

        return $this;
    }

    public function addPromotion(?PromotionDto $promotion): self
    {
        $this->promotions[] = $promotion;

        return $this;
    }
}

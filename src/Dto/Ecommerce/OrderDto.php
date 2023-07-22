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
}

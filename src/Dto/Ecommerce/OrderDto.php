<?php

namespace App\Dto\Ecommerce;

class OrderDto implements OrderInterface
{
    /** @var array<ProductInterface>|null */
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

    public function addProducts(?ProductInterface $product): self
    {
        $this->products[] = $product;

        return $this;
    }
}

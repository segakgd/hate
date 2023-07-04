<?php

namespace App\Dto\Ecommerce;

class OrderDto implements OrderInterface
{
    private ?ProductInterface $product = null;

    public function getProduct(): ?ProductInterface
    {
        return $this->product;
    }

    public function setProduct(?ProductInterface $product): self
    {
        $this->product = $product;

        return $this;
    }
}

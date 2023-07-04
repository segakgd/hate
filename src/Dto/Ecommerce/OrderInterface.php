<?php

namespace App\Dto\Ecommerce;

interface OrderInterface
{
    public function getProducts(): ?array;

    public function setProducts(?array $products): self;

    public function addProducts(?ProductInterface $product): self;
}

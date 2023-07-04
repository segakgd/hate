<?php

namespace App\Dto\Ecommerce;

interface OrderInterface
{
    public function getProduct(): ?ProductInterface;

    public function setProduct(?ProductInterface $product): self;
}

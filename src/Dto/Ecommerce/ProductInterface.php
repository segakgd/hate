<?php

namespace App\Dto\Ecommerce;

interface ProductInterface
{
    public function getName(): string;

    public function getValue(): string;

    public function getPrice(): PriceInterface;
}
<?php

namespace App\Dto\Ecommerce;

interface PriceInterface
{
    public function getValue(): int;

    public function getValueFraction(): string;
}
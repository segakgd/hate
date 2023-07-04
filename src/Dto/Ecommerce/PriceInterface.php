<?php

namespace App\Dto\Ecommerce;

interface PriceInterface
{
    public function getValue(): ?int;

    public function setValue(?int $value): self;

    public function getValueFraction(): ?string;

    public function setValueFraction(?string $valueFraction): self;
}

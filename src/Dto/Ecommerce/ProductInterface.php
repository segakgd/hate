<?php

namespace App\Dto\Ecommerce;

interface ProductInterface
{
    public function getName(): ?string;

    public function setName(?string $name): self;

    public function getValue(): ?string;

    public function setValue(?string $value): self;

    public function getPrice(): ?PriceInterface;

    public function setPrice(?PriceInterface $price): self;
}

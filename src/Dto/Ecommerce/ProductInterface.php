<?php

namespace App\Dto\Ecommerce;

interface ProductInterface
{
    public function getName(): ?string;

    public function setName(?string $name): self;

    public function getImage(): ?string;

    public function setImage(?string $image): self;

    public function getPrice(): ?PriceInterface;

    public function setPrice(?PriceInterface $price): self;
}

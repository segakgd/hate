<?php

namespace App\Dto\Ecommerce;

class ShippingDto
{
    private ?string $name = null;

    private ?PriceDto $price = null;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?PriceDto
    {
        return $this->price;
    }

    public function setPrice(?PriceDto $price): self
    {
        $this->price = $price;

        return $this;
    }
}
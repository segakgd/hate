<?php

namespace App\Dto\Ecommerce;

class ProductDto
{
    private ?string $name = null;

    private ?string $image = null; // todo ImageCollection

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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

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

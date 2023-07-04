<?php

namespace App\Dto\Ecommerce;

class ProductDto implements ProductInterface
{
    private ?string $name = null;

    private ?string $image = null; // todo ImageCollection

    private ?PriceInterface $price = null;

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

    public function getPrice(): ?PriceInterface
    {
        return $this->price;
    }

    public function setPrice(?PriceInterface $price): self
    {
        $this->price = $price;

        return $this;
    }
}

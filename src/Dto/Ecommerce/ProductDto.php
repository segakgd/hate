<?php

namespace App\Dto\Ecommerce;

class ProductDto implements ProductInterface
{
    private ?string $name = null;

    private ?string $value = null;

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

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(?string $value): self
    {
        $this->value = $value;

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

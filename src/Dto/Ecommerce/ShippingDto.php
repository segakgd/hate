<?php

namespace App\Dto\Ecommerce;

use Symfony\Component\Validator\Constraints as Assert;

class ShippingDto
{
    private ?string $name = null;

    private ?PriceDto $price = null;

    #[Assert\Choice(['courier', 'pickup'])]
    private ?string $type = null;

    // todo count, article, from, to, active, cratedAt

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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }
}
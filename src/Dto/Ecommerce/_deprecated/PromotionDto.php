<?php

namespace App\Dto\Ecommerce\_deprecated;

use App\Dto\Ecommerce\PriceDto;
use Symfony\Component\Validator\Constraints as Assert;

/** @deprecated временно не смотрим на этот код */
class PromotionDto
{
    private ?string $name = null;

    #[Assert\Choice(['code', 'discount'])]
    private ?string $type = null;

    private ?PriceDto $price = null;

    // todo from, to code, active, cratedAt

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

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

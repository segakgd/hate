<?php

namespace App\Dto\Ecommerce\_deprecated;

/** @deprecated временно не смотрим на этот код */
class ProductCategoryDto
{
    private ?string $name = null;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }
}

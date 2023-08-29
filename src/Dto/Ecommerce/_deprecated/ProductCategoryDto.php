<?php

namespace App\Dto\Ecommerce\_deprecated;

/** @deprecated временно не смотрим на этот код */
class ProductCategoryDto
{
    private ?int $id = null;

    private ?string $name = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

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

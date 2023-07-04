<?php

namespace App\Dto\Ecommerce;

interface FieldInterface
{
    public function getName(): ?string;

    public function setName(?string $name): self;

    public function getValue(): ?string;

    public function setValue(?string $value): self;
}

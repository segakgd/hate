<?php

namespace App\Dto\Ecommerce;

interface FieldsInterface
{
    public function getValue(): ?FieldInterface;

    public function setValue(?FieldInterface $value): self;
}

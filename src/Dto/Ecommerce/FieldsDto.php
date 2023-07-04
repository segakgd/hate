<?php

namespace App\Dto\Ecommerce;

class FieldsDto implements FieldsInterface
{
    private ?FieldInterface $value = null;

    public function getValue(): ?FieldInterface
    {
        return $this->value;
    }

    public function setValue(?FieldInterface $value): self
    {
        $this->value = $value;

        return $this;
    }
}

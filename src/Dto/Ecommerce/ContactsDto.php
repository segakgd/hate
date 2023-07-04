<?php

namespace App\Dto\Ecommerce;

class ContactsDto implements ContactsInterface
{
    private ?FieldInterface $field = null;

    public function getField(): ?FieldInterface
    {
        return $this->field;
    }
}

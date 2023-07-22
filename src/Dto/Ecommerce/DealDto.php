<?php

namespace App\Dto\Ecommerce;

class DealDto
{
    private ?ContactsDto $contacts = null;

    private ?FieldDto $field = null;

    private ?OrderDto $order = null;

    public function getContacts(): ?ContactsDto
    {
        return $this->contacts;
    }

    public function setContacts(?ContactsDto $contacts): self
    {
        $this->contacts = $contacts;

        return $this;
    }

    public function getField(): ?FieldDto
    {
        return $this->field;
    }

    public function setField(?FieldDto $field): self
    {
        $this->field = $field;

        return $this;
    }

    public function getOrder(): ?OrderDto
    {
        return $this->order;
    }

    public function setOrder(?OrderDto $order): self
    {
        $this->order = $order;

        return $this;
    }
}

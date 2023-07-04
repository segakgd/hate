<?php

namespace App\Dto\Ecommerce;

class DealDto implements DealInterface
{
    private ?ContactsInterface $contacts = null;

    private ?FieldsInterface $fields = null;

    private ?OrderInterface $order = null;

    public function getContacts(): ?ContactsInterface
    {
        return $this->contacts;
    }

    public function setContacts(?ContactsInterface $contacts): self
    {
        $this->contacts = $contacts;

        return $this;
    }

    public function getFields(): ?FieldsInterface
    {
        return $this->fields;
    }

    public function setFields(?FieldsInterface $fields): self
    {
        $this->fields = $fields;

        return $this;
    }

    public function getOrder(): ?OrderInterface
    {
        return $this->order;
    }

    public function setOrder(?OrderInterface $order): self
    {
        $this->order = $order;

        return $this;
    }
}

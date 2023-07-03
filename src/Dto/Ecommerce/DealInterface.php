<?php

namespace App\Dto\Ecommerce;

interface DealInterface
{
    public function getContacts(): ContactsInterface; // todo надо подумать, точно ли именно котакты.

    public function setContacts(): self;

    public function getFields(): FieldsInterface;

    public function setFields(): self;

    public function getOrder(): OrderInterface;

    public function setOrder(): self;
}
<?php

namespace App\Dto\Ecommerce;

interface FieldInterface
{
    public function getName(): string;

    public function getValue(): string;
}
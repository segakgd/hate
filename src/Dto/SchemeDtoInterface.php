<?php

namespace App\Dto;

interface SchemeDtoInterface
{
    public function getFormat(): string;

    public function target(): string;

    public function content(): string;
}
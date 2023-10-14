<?php

namespace App\Service\Common\Client\Http\Response;

interface ResponseInterface
{

    public function getCode(): int;

    public function setCode(int $code): void;

    public function getDescription(): string;

    public function setDescription(string $description): void;
}